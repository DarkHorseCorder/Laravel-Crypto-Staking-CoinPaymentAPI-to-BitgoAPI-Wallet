<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OfferController;
use App\Http\Controllers\User\TradeController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\User\WithdrawalController;
use App\Http\Controllers\User\AuthorizationController;


Route::prefix('user')->name('user.')->middleware('maintenance')->group(function () {
    Route::get('register',   [AuthController::class, 'registerForm'])->name('register');
    Route::post('register',  [AuthController::class, 'register']);
    Route::get('login',      [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',     [AuthController::class, 'login'])->name('login');
    Route::get('logout',     [AuthController::class, 'logout'])->name('logout');

    Route::get('forgot-password',                  [AuthController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('forgot-password',                 [AuthController::class, 'forgotPasswordSubmit']);
    Route::get('forgot-password/verify-code',      [AuthController::class, 'verifyCode'])->name('verify.code');
    Route::post('forgot-password/verify-code',     [AuthController::class, 'verifyCodeSubmit']);

    Route::get('reset-password',      [AuthController::class, 'resetPassword'])->name('reset.password');
    Route::post('reset-password',     [AuthController::class, 'resetPasswordSubmit']);

    Route::middleware('auth')->group(function () {
        Route::get('resend/verify-email/code',  [AuthorizationController::class, 'verifyEmailResendCode'])->name('verify.email.resend');
        Route::get('verify-email',               [AuthorizationController::class, 'verifyEmail'])->name('verify.email');
        Route::post('verify-email',              [AuthorizationController::class, 'verifyEmailSubmit']);

        Route::get('two-step/verification',      [AuthorizationController::class, 'twoStep'])->name('two.step.verification');

        Route::post('two-step/verification',     [AuthorizationController::class, 'twoStepVerify']);

        Route::get('resend/two-step/verify-code',[AuthorizationController::class, 'twoStepResendCode'])->name('two.step.resend');

        Route::middleware(['email_verify', 'twostep'])->group(function () {
          
            Route::get('/',                        [UserController::class, 'index'])->name('dashboard');
            Route::get('profile',                  [UserController::class, 'profile'])->name('profile');
            Route::post('profile',                 [UserController::class, 'profileSubmit']);
            Route::get('change-password',          [UserController::class, 'changePassForm'])->name('change.pass');
            Route::post('change-password',         [UserController::class, 'changePass']);
            Route::get('transactions',             [UserController::class, 'transactions'])->name('transactions');
            Route::get('transaction/details/{id}', [UserController::class, 'trxDetails'])->name('trx.details');

            //withdraw
            Route::get('withdraw/{code}',   [WithdrawalController::class, 'withdrawForm'])->name('withdraw.form');
            Route::get('withdraw-wallets',  [WithdrawalController::class, 'withdrawWallets'])->name('withdraw.wallets');
            Route::post('withdraw-submit',  [WithdrawalController::class, 'withdrawSubmit'])->name('withdraw.submit');
            Route::get('withdraw-history',  [WithdrawalController::class, 'history'])->name('withdraw.history');

            //deposit
            Route::get('deposit',           [DepositController::class, 'index'])->name('deposit.index');
            Route::get('deposit/histoty',   [DepositController::class, 'dipositHistory'])->name('deposit.history');
            Route::post('generate-address', [DepositController::class, 'generateAddress'])->name('deposit.address');
            Route::get('existing-addresses/{code}', [DepositController::class, 'existingAddresses'])->name('deposit.address.existing');

            //offer
            Route::get('offers',          [OfferController::class, 'index'])->name('offer.index');
            Route::get('create-offer',    [OfferController::class, 'create'])->name('offer.create');
            Route::post('create-offer',   [OfferController::class, 'store']);
            Route::get('edit-offer/{id}', [OfferController::class, 'edit'])->name('offer.edit');
            Route::post('update-offer',   [OfferController::class, 'update'])->name('offer.update');
            Route::post('offer-status',   [OfferController::class, 'changeStatus'])->name('offer.status');

            //trade
            Route::get('trades',                     [TradeController::class, 'trades'])->name('trade.all');
            Route::get('trade-requests',             [TradeController::class, 'tradeRequests'])->name('trade.requests');
            Route::get('create-trade/{offer_id}',    [TradeController::class, 'create'])->name('trade.create');
            Route::post('submit/trade-request',      [TradeController::class, 'store'])->name('trade.submit');
            Route::get('trade-details/{tradeCode}',  [TradeController::class, 'tradeDetails'])->name('trade.details');
            Route::post('cancel-trade',              [TradeController::class, 'cancelTrade'])->name('trade.cancel');
            Route::post('submit-chat',               [TradeController::class, 'submitChat'])->name('submit.trade.chat');
            Route::post('trade/mark-as-paid',        [TradeController::class, 'markAsPaid'])->name('trade.paid');
            Route::post('trade/release',             [TradeController::class, 'tradeRelease'])->name('trade.release');
            Route::post('trade/dispute',             [TradeController::class, 'dispute'])->name('trade.dispute');

            //twostep
            Route::get('/two-step/authentication',  [UserController::class, 'twoStep'])->name('two.step');
            Route::get('/two-step/verify',          [UserController::class, 'twoStepVerifyForm'])->name('two.step.verify');
            Route::post('/two-step/verify',         [UserController::class, 'twoStepVerifySubmit']);
            Route::post('/two-step/authentication', [UserController::class, 'twoStepSendCode']);

            //kyc form
            Route::get('kyc-form',    [UserController::class, 'kycForm'])->name('kyc.form');
            Route::post('kyc-form',   [UserController::class, 'kycFormSubmit']);

            // support ticket
            Route::get('support/tickets',              [SupportTicketController::class, 'index'])->name('ticket.index');
            Route::post('open/support/tickets',        [SupportTicketController::class, 'openTicket'])->name('ticket.open');
            Route::post('reply/ticket/{ticket_num}',   [SupportTicketController::class, 'replyTicket'])->name('ticket.reply');
            Route::get('send/verify-code',             [UserController::class, 'sendVerifyCode'])->name('send.code');
            Route::get('verify/phone-number',          [UserController::class, 'verifyPhone'])->name('verify.phone');
            Route::post('verify/phone-number',         [UserController::class, 'verifyPhoneSubmit']);
        });
    });
});
