<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Module as Mod;
use Illuminate\Http\Request;

class Module
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
        $key = collect(request()->segments())->last();
        $module = Mod::where('module',$key)->firstOrFail();

        if(merchant()) $pref = 'merchant';
        else $pref = 'user';
        

        if($module->status == 1){
            return $next($request);
        }
        
        return redirect(route($pref.'.module.off',str_replace('-','_',$key)))->with('error',ucwords(str_replace('-',' ',$key)).' module is currently turned off.');
        
    }
}
