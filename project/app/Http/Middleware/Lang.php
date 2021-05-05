<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;
use Illuminate\Http\Request;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $code = 'en';
        if(session()->has('lang')) $code = session('lang');
        else{
            $lang = Language::where('is_default', 1)->first();
            $code = $lang ? $lang->code : 'en';
        }
        session()->put('lang', $code);
        app()->setLocale(session('lang',  $code));
        return $next($request);
    }

}
