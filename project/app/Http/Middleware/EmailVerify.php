<?php

namespace App\Http\Middleware;

use App\Models\Generalsetting;
use Closure;
use Illuminate\Http\Request;

class EmailVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $is_verify = Generalsetting::value('is_verify');
        if($is_verify){
            if (auth()->check()) {
                $user = auth()->user();
                if($user->email_verified == 0){
                    return redirect(route('user.verify.email'));
                }
                return $next($request);
            }
            return redirect(route('user.login'));
        }
        return $next($request);
    }
}
