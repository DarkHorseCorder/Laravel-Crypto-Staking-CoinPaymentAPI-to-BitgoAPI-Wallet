<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Trade;
use App\Models\Escrow;


use App\Models\Deposit;
use App\Models\Merchant;
use App\Models\SiteContent;
use App\Models\Withdrawals;
use App\Models\RequestMoney;
use App\Models\SupportTicket;
use App\Models\Generalsetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('*',function($settings){
            $settings->with('gs', cache()->remember('generalsettings', now()->addDay(), function () {
                return Generalsetting::first();
            }));

        });

        view()->composer('admin.partials.sidebar', function ($view) {
            $view->with([
                'pending_withdraw'        =>  Withdrawals::whereStatus(0)->count(),
                'pending_user_ticket'     =>  SupportTicket::whereStatus(0)->whereHas('messages')->count(),
                'pending_deposits'        =>  0,
                'dispute_trades'          =>  Trade::whereStatus(4)->count(),
                'pending_user_kyc'        =>  User::whereStatus(1)->where('kyc_status',2)->count(),
            ]);
        });
        view()->composer('user.partials.sidebar', function ($view) {
            $view->with([
                'trade_requests'        =>  Trade::whereStatus(0)->where('offer_user_id',auth()->id())->count(),
                
            ]);
        });
     
        view()->composer(['frontend.partials.header','frontend.contact'], function ($view) {
            $view->with([
                'contact'  =>  SiteContent::where('slug','contact')->first(),
            ]);
        });


        Validator::extend('email_domain', function($attribute, $value, $parameters, $validator) {
            $gs = Generalsetting::first();
        	$allowedEmailDomains = explode(',',$gs->allowed_email);
        	return in_array(explode('@', $parameters[0])[1] , $allowedEmailDomains);
        });

        Blade::directive('langg', function ($expression) {
            return "<?php echo translate($expression); ?>";
        });

        Cache::clear();
       
    }
}
