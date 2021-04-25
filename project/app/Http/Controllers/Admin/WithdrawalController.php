<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\Withdrawals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wallet;

class WithdrawalController extends Controller
{
    public function accepted()
    {
        $withdrawlogs = Withdrawals::where('status', 1)->latest()->with(['user','currency'])->paginate(15);
        return view('admin.withdraw.withdraw_all',compact('withdrawlogs'));
    }
    public function pending()
    {
        $withdrawlogs = Withdrawals::where('status', 0)->latest()->with(['user','currency'])->paginate(15);
        return view('admin.withdraw.withdraw_all',compact('withdrawlogs'));
    }
    public function rejected()
    {
        $withdrawlogs = Withdrawals::where('status', 2)->latest()->with(['user','currency'])->paginate(15);
        return view('admin.withdraw.withdraw_all',compact('withdrawlogs'));
    }

    public function withdrawAccept(Withdrawals $withdraw)
    {
        $withdraw->status = 1;
        $withdraw->save();

        $trnx              = new Transaction();
        $trnx->trnx        = str_rand();
        $trnx->user_id     = $withdraw->user_id;
        $trnx->currency_id = $withdraw->currency->id;
        $trnx->amount      = $withdraw->amount;
        $trnx->charge      = $withdraw->charge;
        $trnx->remark      = 'withdraw_money';
        $trnx->type        = '-';
        $trnx->details     = trans('Withdraw money');
        $trnx->save();

      @mailSend('accept_withdraw',['amount'=> numFormat($withdraw->amount,8), 'final_amount'=> numFormat($withdraw->total_amount,8), 'trnx'=> $trnx->trnx,'curr' => $withdraw->currency->code,'charge'=> numFormat($withdraw->charge,8)], $withdraw->user);

        return back()->with('success','Withdraw Accepted Successfully');
    }


    public function withdrawReject(Request $request, Withdrawals $withdraw)
    {
        $request->validate(['reason_of_reject' => 'required']);
    
        $withdraw->status = 2;
        $withdraw->reject_reason = $request->reason_of_reject;
        $withdraw->save();


        $wallet = Wallet::where('user_id',$withdraw->user_id)->where('crypto_id',$withdraw->currency_id)->firstOrFail();

        $wallet->balance += $withdraw->total_amount;
        $wallet->save();

        $trnx              = new Transaction();
        $trnx->trnx        = str_rand();
        $trnx->user_id     = $withdraw->user_id;
        $trnx->currency_id = $withdraw->currency->id;
        $trnx->amount      = $withdraw->amount;
        $trnx->charge      = $withdraw->charge;
        $trnx->remark      = 'withdraw_reject';
        $trnx->type        = '+';
        $trnx->details     = trans('Withdraw request rejected');
        $trnx->save();

       
        @mailSend('reject_withdraw',['amount'=> numFormat($withdraw->amount,8), 'trnx'=> $trnx->trnx,'curr' => $withdraw->currency->code,'reason'=>$withdraw->reject_reason],$withdraw->user);

        return back()->with('success','Withdraw has been Rejected');
    }
}
