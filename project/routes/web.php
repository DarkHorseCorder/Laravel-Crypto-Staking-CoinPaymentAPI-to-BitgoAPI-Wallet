<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\User\DepositController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

   Route::get('currency-rate', [FrontendController::class,'currencyRate'])->name('currency.rate');
   Route::middleware(['maintenance'])->group(function () {
       
    // ********************************* FRONTEND SECTION *******************************************//
        Route::get('/',                               [FrontendController::class,'index'])->name('front.index');
        Route::get('/about',                          [FrontendController::class,'about'])->name('about');
        Route::get('/frequently-asked-questions',     [FrontendController::class,'faq'])->name('faq');
        Route::get('/contact',                        [FrontendController::class,'contact'])->name('contact');
        Route::post('/contact',                       [FrontendController::class,'contactSubmit']);
        Route::get('/blogs',                          [FrontendController::class,'blogs'])->name('blogs');
        Route::get('/offer-lists',                    [FrontendController::class,'offerList'])->name('offer.list');
        Route::get('/blog-details/{id}-{slug}',       [FrontendController::class,'blogDetails'])->name('blog.details');
        Route::get('/terms-and-policies/{key}-{slug}',[FrontendController::class,'terms_policies'])->name('terms.details');
        Route::get('/pages/{id}-{slug}',              [FrontendController::class,'pages'])->name('pages');
        Route::get('/change-language/{code}',         [FrontendController::class,'langChange'])->name('lang.change');
        
    });
    Route::get('cookie-deny',                  [FrontendController::class,'cookieDeny'])->name('cookie.deny');
    Route::post('the/genius/ocean/2441139', [FrontendController::class,'subscription']);
    Route::get('finalize',                  [FrontendController::class,'finalize']);

    Route::any('notify/coinpayment',  [DepositController::class,'notify'])->name('coinpayment.notify');
    Route::get('/maintenance',       [FrontendController::class,'maintenance'])->name('front.maintenance');

