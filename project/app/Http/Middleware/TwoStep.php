<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Generalsetting;

class TwoStep
{

    public function handle(Request $request, Closure $next)
    {
        $two_fa = Generalsetting::value('two_fa');
        if($two_fa){ 
            $user = auth()->user();
            $pref = 'user';

            if($user->two_fa_status == 1 && $user->two_fa == 1){
                $code = randNum();
                $user->two_fa_code = $code;
                $user->update();
                sendSMS($user->phone,'Xnet - Your Two Step Authentication Code: '.$code,Generalsetting::value('contact_no'));
                return redirect(route($pref.'.two.step.verification'));
            }
            return $next($request);
        }
        return $next($request);
    }

    protected $except = [
        'merchant/resend/two-step/verify-code',
        'user/resend/two-step/verify-code'
    ];
}
