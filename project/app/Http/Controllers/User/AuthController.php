<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\User;
use ReflectionClass;
use App\Models\Wallet;
use App\Models\Country;
use App\Models\Currency;
use App\Models\LoginLogs;
use Illuminate\Http\Request;
use App\Models\Generalsetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\User\AuthRequest;

class AuthController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
        
    }

    public function registerForm()
    {
      $gs = Generalsetting::first();
      if($gs->registration == 0){
        return back()->with('error','Registration is currently off.');
      }
      $countries = Country::get();
      $info = @loginIp();
      return view('user.auth.register',compact('countries','info'));
    }

    public function register(Request $request)
    {
      $gs = Generalsetting::first();
      if($gs->registration == 0){
        return back()->with('error','Registration is currently off.');
      }

      $countries = Country::query();
      $name = $countries->pluck('name')->toArray();
      $data = $request->validate([
        'name' => 'required',
        'email' => ['required','email','unique:users',$gs->allowed_email != null ? 'email_domain:'.$request->email:''],
        'dial_code' => 'required',
        'phone' => 'required',
        'country' => 'required|in:'.implode(',',$name),
        'address' => 'required',
        'password' => 'required|min:6|confirmed',
        'g-recaptcha-response' => [$gs->recaptcha ? 'required':'']
      ],
       [
        'email.email_domain'=>'Allowed emails are only within : '.$gs->allowed_email,
        'g-recaptcha-response.required'=>'Please verify that you are not a robot.'
       ]);

      $data['username'] = 'USER'.randNum(6);
      $data['phone'] = $request->dial_code.$request->phone;
      $data['password'] = bcrypt($request->password);
      $data['email_verified	'] = $gs->is_verify == 1 ? 0:1;
      $user = User::create($data);

      session()->flush('success','Registration successful');
      Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);

      if($gs->is_verify == 1){
        $user->verify_code = randNum();
        $user->save();

        @email([
          'email'   => $user->email,
          'name'    => $user->name,
          'subject' => translate('Email Verification Code'),
          'message' => translate('Email Verification Code is : '). $user->verify_code,
        ]);
      }

      $currencies = Currency::where('type',2)->get();
      foreach ($currencies as $curr) {
        Wallet::create([
          'user_id' => $user->id,
          'crypto_id' => $curr->id,
          'balance' => 0
        ]);
      }

      return redirect(route('user.dashboard'));
    }

   

    public function showLoginForm()
    {
      if(substr(url()->previous(), 0, strpos(url()->previous(), "?")) == url('offer-lists')){
         session()->put('previous',url()->previous());
      }
      return view('user.auth.login');
    }

    public function login(AuthRequest $request)
    {
      if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        if(auth()->user()->status == 0){
          Auth::guard('web')->logout();
          return back()->with('error', 'Ypu are temporarily banned from the system.');
        }
        LoginLogs::create([
            'user_id' => auth()->id(),
            'ip' => @loginIp()->geoplugin_request,
            'country' => @loginIp()->geoplugin_countryName,
            'city' => @loginIp()->geoplugin_city,
        ]);

        $currencies = Currency::where('type',2)->get(['id','code']);
        foreach($currencies as $curr){
            $exist = auth()->user()->wallets()->where('crypto_id',$curr->id)->first();
            if(!$exist){
              Wallet::create([
                'user_id' => auth()->id(),
                'crypto_id' => $curr->id,
                'balance' => 0
              ]);
            }
        }
       
      }else{
          return back()->with('error','Credentials Doesn\'t Match !')->withInput();   
      }
      if($prev = session('previous')){
        session()->forget('previous');
        return redirect($prev);
      }
      return redirect(route('user.dashboard'));

    }

    public function logout()
    {
        $auth = Auth::guard('web');
        if($auth->user()->two_fa_status == 1){
          $auth->user()->two_fa = 1;
          $auth->user()->save();
        }
        Auth::guard('web')->logout();
        return redirect('/user/login');
    }

    public function forgotPassword()
    {
      return view('user.auth.forgot_password');
    }

    public function forgotPasswordSubmit(Request $request)
    {
        $request->validate(['email'=>'required|email']);
        $exist = User::where('email',$request->email)->first();
        if(!$exist){
          return back()->with('error','Sorry! Email doesn\'t exist');
        }

        $exist->verify_code = randNum();
        $exist->save();

        @email([
          'email'   => $exist->email,
          'name'    => $exist->name,
          'subject' => __('Password Reset Code'),
          'message' => __('Password reset code is : ').$exist->verify_code,
        ]);
        session()->put('email',$exist->email);
        return redirect(route('user.verify.code'))->with('success','A password reset code has been sent to your email.');
    }

    public function verifyCode()
    {
      return view('user.auth.verify_code');
    }

    public function verifyCodeSubmit(Request $request)
    {
        $request->validate(['code' => 'required|integer']);
        $user = User::where('email',session('email'))->first();
        if(!$user){
            return back()->with('error','User doesn\'t exist');
        }

        if($user->verify_code != $request->code){
            return back()->with('error','Invalid verification code.');
        }
        return redirect(route('user.reset.password'));
    }

    public function resetPassword()
    {
        return view('user.auth.reset_password');
    }

    public function resetPasswordSubmit(Request $request)
    {
        $request->validate(['password'=>'required|confirmed|min:6']);
        $user = User::where('email',session('email'))->first();
        $user->password = bcrypt($request->password);
        $user->update();
        return redirect(route('user.auth.login'))->with('success','Password reset successful.');
    }
 

}
