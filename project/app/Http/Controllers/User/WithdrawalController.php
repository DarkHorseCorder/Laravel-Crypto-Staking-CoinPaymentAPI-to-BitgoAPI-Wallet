<?php

namespace App\Http\Controllers\User;

use App\Models\Wallet;
use App\Models\Withdraw;
use App\Models\Withdrawals;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Support\Facades\Artisan;

class WithdrawalController extends Controller
{
    public function withdrawWallets()
    {
        $wallets = Wallet::where('user_id',auth()->id())->with('curr')->get();
        return view('user.wallets',[
            'wallets' => $wallets
        ]);
       
    }
    public function withdrawForm($code)
    {
        $curr = Currency::where('code',$code)->firstOrFail();
        $wallet = Wallet::where('user_id',auth()->id())->where('crypto_id',$curr->id)->firstOrfail();
        return view('user.withdraw.withdraw_form',compact('wallet','curr'));
    }

    public function withdrawSubmit(Request $request)
    {
        $request->validate([
            'amount'      => 'required|numeric|gt:0',
            'currency_id' => 'required',
            'wallet_id'   => 'required',
            'wallet_address'   => 'required'
        ]);

        $wallet = Wallet::where('id',$request->wallet_id)->where('user_id',auth()->id())->firstOrFail();
        $curr   = Currency::findOrFail($request->currency_id);

        if($request->amount < @$curr->charges->withdraw_limit_min || $request->amount > @$curr->charges->withdraw_limit_max){
            return back()->with('error','Please follow the limit')->withInput();
        }

        $charge      = ($request->amount * $curr->charges->withdraw_charge / 100);
        $finalAmount = numFormat($request->amount + $charge);
     
        if($wallet->balance < $finalAmount){
            return back()->with('error','Insufficient balance')->withInput();
        }

        $wallet->balance -=  $finalAmount;
        $wallet->save();
        
        $withdraw              = new Withdrawals();
        $withdraw->trx         = str_rand();
        $withdraw->user_id     = auth()->id();
        $withdraw->amount      = $request->amount;
        $withdraw->charge      = $charge;
        $withdraw->total_amount = $finalAmount;
        $withdraw->wallet_address  = $request->wallet_address;
        $withdraw->currency_id   = $curr->id;
        $withdraw->save();

        return back()->with('success','Withdraw request has been submitted successfully.');
    }

    public function history()
    {
        $withdrawals = Withdrawals::where('user_id',auth()->id())->latest()->paginate(15);
        return view('user.withdraw.history',compact('withdrawals'));
    }
}
