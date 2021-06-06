<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\KycManageController;
use App\Http\Controllers\Admin\ManageRoleController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Admin\ManageOfferController;
use App\Http\Controllers\Admin\ManageStaffController;
use App\Http\Controllers\Admin\ManageTradeController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\ManageTicketController;
use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\ManageCountryController;
use App\Http\Controllers\Admin\ManageDepositController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ManageCurrencyController;
use App\Http\Controllers\Admin\PaymentGatewayController;

// ************************** ADMIN SECTION START ***************************//

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',            [LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',           [LoginController::class,'login']);
    
    Route::get('/forgot-password',   [LoginController::class,'forgotPasswordForm'])->name('forgot.password');
    Route::post('/forgot-password',   [LoginController::class,'forgotPasswordSubmit']);
    Route::get('forgot-password/verify-code',     [LoginController::class,'verifyCode'])->name('verify.code');
    Route::post('forgot-password/verify-code',     [LoginController::class,'verifyCodeSubmit']);
    Route::get('reset-password',     [LoginController::class,'resetPassword'])->name('reset.password');
    Route::post('reset-password',     [LoginController::class,'resetPasswordSubmit']);

    Route::middleware('auth:admin')->group(function(){
        Route::get('/logout',[LoginController::class,'logout'])->name('logout');

        //------------ ADMIN DASHBOARD & PROFILE SECTION ------------
        Route::get('/',                 [AdminController::class,'index'])->name('dashboard');
        Route::get('/profile',          [AdminController::class,'profile'])->name('profile');
        Route::post('/profile/update',  [AdminController::class,'profileupdate'])->name('profile.update');
        Route::get('/password',         [AdminController::class,'passwordreset'])->name('password');
        Route::post('/password/update', [AdminController::class,'changepass'])->name('password.update');
        //------------ ADMIN DASHBOARD & PROFILE SECTION ENDS ------------



        //transactions
        Route::get('/transaction-report',                 [AdminController::class,'transactions'])->name('transactions')->middleware('permission:transactions');

        //==================================== PAGE SECTION  ==============================================//

        Route::get('page',       [PageController::class,'index'])->name('page.index')->middleware('permission:manage page');
        Route::get('page/create',       [PageController::class,'create'])->name('page.create')->middleware('permission:page create');
        Route::post('page/store',       [PageController::class,'store'])->name('page.store')->middleware('permission:page store');
        Route::get('page/edit/{page}',       [PageController::class,'edit'])->name('page.edit')->middleware('permission:page edit');
        Route::put('page/update/{page}',       [PageController::class,'update'])->name('page.update')->middleware('permission:page update');
        Route::post('page/remove',       [PageController::class,'destroy'])->name('page.remove')->middleware('permission:page remove');

        //==================================== PAGE SECTION END ==============================================//

        //cookie
        Route::get('/manage-cookie',                 [AdminController::class,'cookie'])->name('cookie')->middleware('permission:manage cookie');
        Route::post('/manage-cookie',                 [AdminController::class,'updateCookie'])->name('update.cookie')->middleware('permission:update cookie');

        //manage blogs

        Route::get('blog-category',       [BlogCategoryController::class,'index'])->name('bcategory.index')->middleware('permission:manage blog-category');
     
        Route::post('blog-category/store',       [BlogCategoryController::class,'store'])->name('bcategory.store')->middleware('permission:store blog-category');
      
        Route::put('blog-category/update/{id}',       [BlogCategoryController::class,'update'])->name('bcategory.update')->middleware('permission:update blog-category');

        Route::get('blog',       [BlogController::class,'index'])->name('blog.index')->middleware('permission:manage blog');
        Route::get('blog/create',       [BlogController::class,'create'])->name('blog.create')->middleware('permission:blog create');
        Route::post('blog/store',       [BlogController::class,'store'])->name('blog.store')->middleware('permission:blog store');
        Route::get('blog/edit/{blog}',       [BlogController::class,'edit'])->name('blog.edit')->middleware('permission:blog edit');
        Route::put('blog/update/{blog}',       [BlogController::class,'update'])->name('blog.update')->middleware('permission:blog update');
        Route::delete('blog-delete/{blog}',[BlogController::class,'destroy'])->name('blog.destroy')->middleware('permission:blog destroy');
        //==================================== Manage Currency ==============================================//

        Route::get('/manage-currency',[ManageCurrencyController::class,'index'])->name('currency.index')->middleware('permission:manage currency');
        Route::get('/manage-currency/{type}',[ManageCurrencyController::class,'manageCurrency'])->name('currency.manage')->middleware('permission:manage currency');

        Route::get('/add-currency',[ManageCurrencyController::class,'addCurrency'])->name('currency.add')->middleware('permission:add currency');

        Route::post('/add-currency',[ManageCurrencyController::class,'store'])->middleware('permission:add currency');

        Route::get('/edit-currency/{id}',[ManageCurrencyController::class,'editCurrency'])->name('currency.edit')->middleware('permission:edit currency');

        Route::post('/update-currency/{id}',[ManageCurrencyController::class,'updateCurrency'])->name('currency.update')->middleware('permission:update currency');

        Route::post('/update-currency-api',[ManageCurrencyController::class,'updateCurrencyAPI'])->name('currency.api.update')->middleware('permission:update currency api');


        //manage Country

        Route::get('/manage-country',[ManageCountryController::class,'index'])->name('country.index')->middleware('permission:manage country');

        Route::post('/add-country',[ManageCountryController::class,'store'])->name('country.store')->middleware('permission:add country');

        Route::post('/update-country',[ManageCountryController::class,'update'])->name('country.update')->middleware('permission:update country');


        //offer
        Route::get('/manage-offers',[ManageOfferController::class,'index'])->name('manage.offers')->middleware('permission:manage offer');
        Route::get('/offer/details/{id}',[ManageOfferController::class,'offerDetails'])->name('manage.offers.details');
        Route::post('change/offer/status',[ManageOfferController::class,'changeStatus'])->name('manage.offer.status')->middleware('permission:offer status change');
        Route::get('/manage-offers/limit',[ManageOfferController::class,'offerLimits'])->name('manage.offers.limit')->middleware('permission:offer limit');
        Route::post('/manage-offers/limit',[ManageOfferController::class,'addOfferLimits'])->middleware('permission:offer limit add');
        Route::post('/offer-limit/update',[ManageOfferController::class,'updateOfferLimits'])->name('offer.limit.update')->middleware('permission:offer limit update');
        Route::post('/offer-limit/remove',[ManageOfferController::class,'removeOfferLimit'])->name('offer.limit.remove')->middleware('permission:offer limit remove');

        //manage trade
        Route::get('/trade-durations',[ManageTradeController::class,'tradeDurations'])->name('trade.durations')->middleware('permission:manage trade duration');
        Route::post('/trade-durations',[ManageTradeController::class,'addTradeDuration'])->middleware('permission:trade duration add');
      
        Route::post('update/trade-durations',[ManageTradeController::class,'updateTradeDuration'])->name('trade.duration.update')->middleware('permission:trade duration update');

        Route::post('remove/trade-durations',[ManageTradeController::class,'removeTradeDuration'])->name('trade.duration.remove')->middleware('permission:trade duration remove');

        Route::get('/trades/{type?}',      [ManageTradeController::class,'trades'])->name('trades.all')->middleware('permission:manage trades');
        Route::get('/trade-details/{code}',[ManageTradeController::class,'tradeDetails'])->name('trade.details')->middleware('permission:manage trades');
        Route::post('/trade-chat/submit',  [ManageTradeController::class,'submitChat'])->name('trade.submit.chat')->middleware('permission:manage trades');
        Route::post('/trade-release',      [ManageTradeController::class,'tradeRelease'])->name('trade.release')->middleware('permission:manage trades');
        Route::post('/trade-refund',      [ManageTradeController::class,'tradeRefund'])->name('trade.refund')->middleware('permission:manage trades');

        //api settings
        Route::get('/api-settings',[GeneralSettingController::class,'apiSettings'])->name('api.settings')->middleware('permission:api settings');
        Route::post('/api-settings',[GeneralSettingController::class,'updateApiSettings'])->middleware('permission:api settings');


        //==================================== GENERAL SETTING SECTION ==============================================//


            Route::get('/general-settings',            [GeneralSettingController::class,'siteSettings'])->name('gs.site.settings')->middleware('permission:general setting');

            Route::post('/general-settings/update',     [GeneralSettingController::class,'update'])->name('gs.update')->middleware('permission:general settings update');

            Route::get('/general-settings/logo-favicon',[GeneralSettingController::class,'logo'])->name('gs.logo')->middleware('permission:general settings logo favicon');

            Route::get('/general-settings/menu-builder',  [GeneralSettingController::class,'menu'])->name('front.menu')->middleware('permission:menu builder');

            Route::get('/general-settings/maintenance', [GeneralSettingController::class,'maintenance'])->name('gs.maintenance')->middleware('permission:maintainance');

            Route::get('/general-settings/status/update/{value}', [GeneralSettingController::class,'StatusUpdate'])->name('gs.status')->middleware('permission:general settings status update');


        //==================================== GENERAL SETTING SECTION ==============================================//




        //==================================== EMAIL SETTING SECTION ==============================================//

            Route::get('/email-templates',      [EmailController::class,'index'])->name('mail.index')->middleware('permission:email templates');

            Route::get('/email-templates/{id}', [EmailController::class,'edit'])->name('mail.edit')->middleware('permission:template edit');

            Route::post('/email-templates/{id}',[EmailController::class,'update'])->name('mail.update')->middleware('permission:template update');

            Route::get('/email-config',         [EmailController::class,'config'])->name('mail.config')->middleware('permission:email config');

            Route::get('/group-email',           [EmailController::class,'groupEmail'])->name('mail.group.show')->middleware('permission:group email');

            Route::post('/groupemailpost',      [EmailController::class,'groupemailpost'])->name('group.submit')->middleware('permission:group email');



        //==================================== EMAIL SETTING SECTION END ==============================================//


        //sms settings
        Route::get('/sms-gateways',          [SmsController::class,'index'])->name('sms.index')->middleware('permission:sms gateways');

        Route::get('/sms-gateway/edit/{id}', [SmsController::class,'edit'])->name('sms.edit')->middleware('permission:sms gateway edit');

        Route::post('/sms-gateway/update/{id}', [SmsController::class,'update'])->name('sms.update')->middleware('permission:sms gateway update');

        Route::get('/sms-templates', [SmsController::class,'templates'])->name('sms.templates')->middleware('permission:sms templates');

        Route::get('/sms-template/edit/{id}', [SmsController::class,'editTemplate'])->name('sms.template.edit')->middleware('permission:sms template edit');

        Route::post('/sms-template/update/{id}', [SmsController::class,'updateTemplate'])->name('sms.template.update')->middleware('permission:sms template update');

        //==================================== PAYMENTGATEWAY SETTING SECTION ==============================================//

        Route::get('/deposits',             [ManageDepositController::class,'deposits'])->name('deposit')->middleware('permission:manage deposit');

        Route::post('/approve-deposit',             [ManageDepositController::class,'approve'])->name('approve.deposit')->middleware('permission:approve deposit');

        Route::post('/reject-deposit',             [ManageDepositController::class,'reject'])->name('reject.deposit')->middleware('permission:reject deposit');


        Route::get('/payment-gateways',        [PaymentGatewayController::class,'index'])->name('gateway')->middleware('permission:manage payment gateway');
        
        Route::post('/payment-gateways',        [PaymentGatewayController::class,'store'])->middleware('permission:manage payment gateway');


        Route::post('/payment-gateway/update/{gateway}',        [PaymentGatewayController::class,'update'])->name('gateway.update')->middleware('permission:update payment gateway');

        //==================================== PAYMENTGATEWAY SETTING SECTION END ==============================================//


        //==================================== LANGUAGE SETTING SECTION ==============================================//

        // webiste language
        Route::resource('language', LanguageController::class)->middleware('permission:manage language');

        Route::post('add-translate/{id}', [LanguageController::class,'storeTranslate'])->name('translate.store')->middleware('permission:manage language');

        Route::post('update-translate/{id}', [LanguageController::class,'updateTranslate'])->name('translate.update')->middleware('permission:manage language');

        Route::post('remove-translate', [LanguageController::class,'removeTranslate'])->name('translate.remove')->middleware('permission:manage language');

        Route::post('language/status-update', [LanguageController::class,'statusUpdate'])->name('update-status.language')->middleware('permission:manage language');

        Route::post('language/remove', [LanguageController::class,'destroy'])->name('remove.language')->middleware('permission:manage language');

        // admin language
        Route::get('adminlanguage/status/{id1}/{id2}', [AdminLanguageController::class,'status'])->name('adminlanguage.status')->middleware('permission:manage language');

    
        //==================================== LANGUAGE SETTING SECTION END =============================================//



        //==================================== ADMIN SEO SETTINGS SECTION ====================================
            Route::resource('seo-setting', SeoSettingController::class)->middleware('permission:seo settings');
        //==================================== ADMIN SEO SETTINGS SECTION ENDS ====================================



        //==================================== USER SECTION  ==============================================//

            Route::get('manage-users', [ManageUserController::class,'index'])->name('user.index')->middleware('permission:manage user');

            Route::get('user-details/{id}', [ManageUserController::class,'details'])->name('user.details')->middleware('permission:edit user');

            Route::post('user-profile/update/{id}', [ManageUserController::class,'profileUpdate'])->name('user.profile.update')->middleware('permission:update user');

            Route::post('balance-modify', [ManageUserController::class,'modifyBalance'])->name('user.balance.modify')->middleware('permission:user balance modify');

            Route::get('user-login/{id}', [ManageUserController::class,'login'])->name('user.login')->middleware('permission:user login');

            Route::get('user-login/info/{id}', [ManageUserController::class,'loginInfo'])->name('user.login.info')->middleware('permission:user login logs');
         
            Route::get('user/deposit-history/{id}', [ManageUserController::class,'depositHistory'])->name('user.deposit.history');
            Route::get('user/withdraw-history/{id}', [ManageUserController::class,'withdrawHistory'])->name('user.withdraw.history');


     

        //================= Site Contents ======================

            Route::get('/frontend-sections',[SiteContentController::class,'index'])->name('frontend.index')->middleware('permission:site contents');

            Route::get('/frontend-section/edit/{id}',[SiteContentController::class,'edit'])->name('frontend.edit')->middleware('permission:edit site contents');

            Route::post('/frontend-section/content-update/{id}',[SiteContentController::class,'contentUpdate'])->name('frontend.content.update')->middleware('permission:site content update');

            Route::post('/frontend-section/sub-content-update/{id}',[SiteContentController::class,'subContentUpdate'])->name('frontend.sub-content.update')->middleware('permission:site sub-content update');

            Route::post('/frontend-section/sub-content/update-single',[SiteContentController::class,'subContentUpdateSingle'])->name('frontend.sub-content.single.update')->middleware('permission:site sub-content update');

            Route::post('/frontend-section/sub-content/remove',[SiteContentController::class,'subContentRemove'])->name('frontend.sub-content.remove')->middleware('permission:site sub-content update');

            Route::post('/frontend-section/status-update',[SiteContentController::class,'statusUpdate'])->name('frontend.status.update')->middleware('permission:section status update');


        //withdraw

            Route::get('withdraw/pending',[WithdrawalController::class,'pending'])->name('withdraw.pending')->middleware('permission:pending withdraw');

            Route::get('withdraw/accepted',[WithdrawalController::class,'accepted'])->name('withdraw.accepted')->middleware('permission:accepted withdraw');

            Route::get('withdraw/rejected',[WithdrawalController::class,'rejected'])->name('withdraw.rejected')->middleware('permission:rejected withdraw');

            Route::post('withdraw/accept/{withdraw}',[WithdrawalController::class,'withdrawAccept'])->name('withdraw.accept')->middleware('permission:withdraw accept');

            Route::post('withdraw/reject/{withdraw}',[WithdrawalController::class,'withdrawReject'])->name('withdraw.reject')->middleware('permission:withdraw reject');


             //Manage Kyc

     
             Route::get('/manage-kyc-form',[KycManageController::class,'userKycForm'])->name('manage.kyc.form')->middleware('permission:manage kyc form');
 
             Route::post('/manage-kyc-form/{user}',[KycManageController::class,'kycForm'])->middleware('permission:kyc form add');
 
             Route::post('/kyc-form/update',[KycManageController::class,'kycFormUpdate'])->name('kyc.form.update')->middleware('permission:kyc form update');
 
             Route::post('/kyc-form/delete',[KycManageController::class,'deletedField'])->name('kyc.form.delete')->middleware('permission:kyc form delete');
 
             Route::get('/kyc-info',[KycManageController::class,'kycInfo'])->name('kyc.info')->middleware('permission:kyc info');
           
             Route::get('/kyc-details/{id}',[KycManageController::class,'kycDetails'])->name('kyc.details')->middleware('permission:kyc details');
 
             Route::post('/kyc-reject/{id}',[KycManageController::class,'rejectKyc'])->name('kyc.reject')->middleware('permission:kyc reject');
 
             Route::post('/kyc-approve/{id}',[KycManageController::class,'approveKyc'])->name('kyc.approve')->middleware('permission:kyc approve');

         
          //role manage

              Route::get('manage/role',[ManageRoleController::class,'index'])->name('role.manage')->middleware('permission:manage role');

              Route::get('create/role',[ManageRoleController::class,'create'])->name('role.create')->middleware('permission:create role');

              Route::post('create/role',[ManageRoleController::class,'store'])->middleware('permission:create role');

              Route::get('edit/permissions/{id}',[ManageRoleController::class,'edit'])->name('role.edit')->middleware('permission:edit permissions');

              Route::post('update/permissions/{id}',[ManageRoleController::class,'update'])->name('role.update')->middleware('permission:update permissions');



             //manage staff

              Route::get('manage/staff',[ManageStaffController::class,'index'])->name('staff.manage')->middleware('permission:manage staff');

              Route::post('add/staff',[ManageStaffController::class,'addStaff'])->name('staff.add')->middleware('permission:add staff');

              Route::post('update/staff/{id}',[ManageStaffController::class,'updateStaff'])->name('staff.update')->middleware('permission:update staff');

            //support ticket
              Route::get('manage/tickets',[ManageTicketController::class,'index'])->name('ticket.manage')->middleware('permission:manage ticket');

              Route::post('reply/ticket/{ticket_num}',   [ManageTicketController::class,'replyTicket'])->name('ticket.reply')->middleware('permission:manage ticket')->middleware('permission:reply ticket');

    });




});


    
Route::get('/check/movescript', [AdminController::class,'movescript'])->name('admin-move-script');
Route::get('/generate/backup', [AdminController::class,'generate_bkup'])->name('admin-generate-backup');
Route::get('/activation', [AdminController::class,'activation'])->name('admin-activation-form');
Route::post('/activation', [AdminController::class,'activation'])->name('admin-activate-purchase');
Route::post('/clear/backup', [AdminController::class,'clear_bkup'])->name('admin-clear-backup');

