<?php

namespace App\Http\Controllers\User;

use App\Models\Trade;
use App\Models\Wallet;
use App\Models\KycForm;
use App\Models\Transaction;
use App\Helpers\MediaHelper;
use Illuminate\Http\Request;
use App\Models\Generalsetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserResource;

class UserController extends Controller{

    public function __construct(UserResource $resource)
    {
        $this->resource = $resource;
    }


    public function index()
    {
        $wallets = Wallet::where('user_id',auth()->id())->get();
        $trades = Trade::where('offer_user_id', auth()->id())->with(['crypto','fiat','trader'])->latest()->take(7)->get();
        return view('user.dashboard',compact('wallets','trades'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile',compact('user'));
    }


    public function profileSubmit(Request $request)
    {
        $user          = auth()->user();
        $request->validate([
            'name' => 'required',
            'phone' => [function ($attribute, $value, $fail) use($user){
                            if ($attribute && $value == null && $user->phone_verified == 0) {
                                $fail('Phone number is required.');
                            }
                        }],
        ]);

        $user->name    = $request->name;
        if ($user->phone_verified == 0) {
            $user->phone   = $request->phone;
        }
        $user->city    = $request->city;
        $user->zip     = $request->zip;
        $user->address = $request->address;
     
        if($request->photo){
            $user->photo = MediaHelper::handleMakeImage($request->photo,[300,300]);
        }
        $user->update();

        return back()->with('success','Profile has been updated');
    } 

    public function changePassForm()
    {
        return view('user.change_password');
    }

    public function changePass(Request $request)
    {
        $request->validate(['old_pass'=>'required','password'=>'required|min:6|confirmed']);
        $user = auth()->user();
        if (Hash::check($request->old_pass, $user->password)) {
            $password = bcrypt($request->password);
            $user->password = $password;
            $user->save();
            return back()->with('success', 'Password has been changed');
        } else {
            return back()->with('error', 'The old password doesn\'t match!');
        }
    }

  
    public function transactions()
    {
        $search = request('search');

        $transactions = Transaction::where('user_id',auth()->id())
        ->when($search,function($q) use($search){
            return $q->where('trnx',$search);
        })
        ->with('currency')->latest()->paginate(15);
    
        return view('user.transactions',compact('transactions','search'));
    }

    public function trxDetails($id)
    {
        
        $transaction = Transaction::where('id',$id)->where('user_id',auth()->id())->first();
        if(!$transaction){
            return response('empty');
        }
        return view('user.trx_details',compact('transaction'));
    }

    public function twoStep()
    {
        return view('user.twostep.two_step');
    }

    public function twoStepSendCode(Request $request)
    {
        $request->validate(['password'=>'required|confirmed']);
        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $code = randNum();
            $user->two_fa_code = $code;
            $user->update();
            sendSMS($user->phone,translate('Your two step authentication OTP is : ').$code,Generalsetting::value('contact_no'));
            return redirect(route('user.two.step.verify'))->with('success','OTP code is sent to your phone.');
        } else {
            return back()->with('error', 'The password doesn\'t match!');
        }

    }
    public function twoStepVerifyForm()
    {
        return view('user.twostep.verify');
    }

    public function twoStepVerifySubmit(Request $request)
    {
        $request->validate(['code'=>'required']);
        $user = auth()->user();
        if($request->code != $user->two_fa_code){
            return back()->with('error','Invalid OTP');
        }
        if($user->two_fa_status == 1){
            $user->two_fa_status = 0;
            $user->two_fa= 0;
            $msg = 'Your two step authentication is de-activated';
        }else{
            $user->two_fa_status = 1;
            $msg = 'Your two step authentication is activated';
        }
        $user->save();
        return redirect(route('user.two.step'))->with('success',$msg);
    }

    public function changeCurrency($id)
    {
        session()->put('currency', $id);
        return redirect()->back();
    }

    public function kycForm()
    {
        if(auth()->user()->kyc_status == 2) return back()->with('error','You have already submitted the KYC data.');
        if(auth()->user()->kyc_status == 1) return back()->with('error','Your KYC data is already verified.');
        $kycForm = KycForm::get();
        return view('user.kyc_form',compact('kycForm'));
    }

    public function kycFormSubmit(Request $request)
    {
        $data = $request->except('_token');
        $kycForm = KycForm::get();
        $rules = [];
        foreach ($kycForm as $value) {
            if($value->required == 1){
                if($value->type == 2){
                    $rules[$value->name] = 'required|image|mimes:png,jpg,jpeg|max:5120';
                }
                $rules[$value->name] = 'required';
            }
            
            if($value->type == 2){
                $rules[$value->name] = 'image|mimes:png,jpg,jpeg|max:5120';
                if(request("$value->name")){
                    $filename = MediaHelper::handleMakeImage(request("$value->name"));
                }
                unset($data[$value->name]);
                $data['image'][$value->name] = $filename;
            }

            if($value->type == 3){
                unset($data[$value->name]);
                $data['details'][$value->name] = request("$value->name");
            }

        }

        $request->validate($rules);
        $user = auth()->user();
        $user->kyc_info = $data;
        $user->kyc_status = 2;
        $user->save();
        return redirect(route('user.dashboard'))->with('success','KYC data has been submitted for review.');
    }

    public function verifyPhone()
    {
        return view('user.verify_phone');
    }

    public function sendVerifyCode()
    {
        try {
            $code = randNum();
            sendSMS(auth()->user()->phone,translate('Your phone verification code is : ').$code,Generalsetting::value('contact_no'));
            session()->put('phone_verify',encrypt($code));
    
            return back()->with('success','Verification code is sent to your phone.');
        } catch (\Throwable $th) {
            return back()->with('error','Can not send the verification code right now.');
        }
    }

    public function verifyPhoneSubmit(Request $request)
    {
        $request->validate(['verification_code' => 'required|numeric']);
        try {
            $code = decrypt(session('phone_verify'));
         
            if($code != $request->verification_code){
              return back()->with('error','Verification code mismatch');  
            }
            auth()->user()->phone_verified = 1;
            auth()->user()->update();

            session()->forget('phone_verify');
            return back()->with('success','Your phone number is successfully verified');
        } catch (\Throwable $th) {
            return back()->with('error','Something went wrong.');
        }
    }

}