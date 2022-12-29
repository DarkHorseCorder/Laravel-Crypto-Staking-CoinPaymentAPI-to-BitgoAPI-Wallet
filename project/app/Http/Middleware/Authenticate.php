<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (\Request::is('admin') || \Request::is('admin/*')){
                return route('admin.login');
            }
            else if(\Request::is('merchant') || \Request::is('merchant/*')){
                return route('merchant.login');
            }
            else{
                return route('user.login');
            } 
        }
    }
}
