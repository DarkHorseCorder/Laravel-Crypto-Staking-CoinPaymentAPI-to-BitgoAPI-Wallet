<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Offer;
use App\Models\Trade;
use App\Models\Wallet;
use App\Models\TradeChat;
use App\Models\Transaction;
use App\Helpers\MediaHelper;
use Illuminate\Http\Request;
use App\Models\Generalsetting;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{
    public function trades()
    {
        $title = 'My Trades';
        $trades = Trade::where('trader_id', auth()->id())->with(['crypto','fiat','trader'])->latest()->paginate(15);
        return view('user.trade.trades',compact('trades','title'));
    }
    public function tradeRequests()
    {
        $title = 'Trade requests';
        $trades = Trade::where('offer_user_id', auth()->id())->with(['crypto','fiat','trader'])->latest()->paginate(15);
        return view('user.trade.trades',compact('trades','title'));
    }
    public function create($offerId)
    {
        $offer = Offer::where('offer_id',$offerId)->with(['gateway','crypto','fiat','duration','user'])->firstOrFail();
        if($offer->user_id == auth()->id()){
            return back()->with('error','Requesting trade in own offer is not allowed');
        }
        $rate = crypto_rate($offer);
        return view('frontend.create_trade',compact('offer','rate'));
    }

    public function store(Request $request)
    {
        if (!kycTradeLimit()) {
           return back()->with('error','Please submit your KYC info for further trade');
        }
        $data = $request->validate([
            'offer_id'       => 'required',
            'fiat_id'       => 'required',
            'crypto_id'       => 'required',
            'fiat_amount'    => 'required|gt:0',
            'crypto_amount'  => 'required|gt:0'
        ]);

        $offer = Offer::where('status', 1)->where('user_id', '!=', auth()->id())->findOrFail($request->offer_id);

        $cryptoAmount = numFormat($request->fiat_amount / crypto_rate($offer),9);

        if($request->fiat_amount < $offer->minimum || $request->fiat_amount > $offer->maximum){
            return back()->with('error',"Please follow the limit.");
        }

        if($offer->type == 'buy'){
            $data['trade_type'] = 'sell';
            $trade_fee = Generalsetting::value('trade_fee');
          
            $wallet = Wallet::where('user_id',auth()->id())->where('crypto_id',$offer->cryp_id)->first();
          
            if(!$wallet){
                $wallet = Wallet::create([
                    'user_id' => auth()->id(),
                    'crypto_id' => $offer->cryp_id,
                    'balance'  => 0
                ]);
            } 
            if($wallet->balance < $cryptoAmount){
                return back()->with('error',"Insufficient ".$offer->crypto->code." balance");
            }

            $wallet->balance -= ($cryptoAmount + ($cryptoAmount * $trade_fee/100));
            $wallet->update();
            
        }
        elseif($offer->type == 'sell'){
            $data['trade_type'] = 'buy';
            $wallet = Wallet::where('user_id',$offer->user_id)->where('crypto_id',$offer->cryp_id)->first();
          
            if(!$wallet){
                return back()->with('error',"Something went wrong");
            } 
            if($wallet->balance < $cryptoAmount){
                return back()->with('error',"Sorry! Insufficient seller fund");
            }

            $wallet->balance -= $cryptoAmount;
            $wallet->update();

        }else{
            abort(404);
        }

        $data['rate']           = crypto_rate($offer);
        $data['trade_fee']      = @$trade_fee ? ($cryptoAmount * $trade_fee/100) : 0;
        $data['crypto_amount']  = $cryptoAmount;
        $data['trade_code']     = str_rand();
        $data['trade_duration'] = $offer->duration->duration;
        $data['offer_user_id']  = $offer->user_id;
        $data['trader_id']      = auth()->id();
        Trade::create($data);

        return redirect(route('user.trade.details',$data['trade_code']))->with('success','Trading has been started');
    }

    public function tradeDetails($tradeCode)
    {
        $trade = Trade::whereTradeCode($tradeCode)->where(function ($q){
            $q->where('offer_user_id', auth()->id())->orWhere('trader_id', auth()->id());
        })->with(['offer','trader','offerOwner'])->firstOrFail();

        $messages = TradeChat::where('trade_id',$trade->id)->with(['user','trade'])->get();
        return view('user.trade.details',compact('trade','messages'));
    }

    public function cancelTrade(Request $request)
    {
        $trade = Trade::whereTradeCode($request->trade_code)->where(function ($q){
            $q->where('offer_user_id', auth()->id())->orWhere('trader_id', auth()->id());
        })->with(['offer'])->firstOrFail();

        if ($trade->status == 1) {
            return back()->with('error', 'You can not cancel trade now. Buyer has already been paid. Please dispute if needed.');
        }

        if($trade->offer->type == 'sell') {
            $user_id = $trade->offer_user_id;
        }else{
            $user_id = $trade->trader_id;
        }
    
        $wallet = Wallet::where('user_id', $user_id)->where('crypto_id',$trade->crypto_id)->first();

        if (!$wallet) {
            return back()->with('error', 'Something went wrong');
        }

        $wallet->balance += $trade->crypto_amount;
        $wallet->update();

        Transaction::create([
            'trnx'    => str_rand(),
            'user_id' => $user_id,
            'charge'  => 0,
            'amount'  => numFormat($trade->crypto_amount,8),
            'remark'  => 'cancel_trade',
            'type'    => '+',
            'currency_id'  => $trade->crypto_id,
            'details' => translate('Refunding balance for cancel trade.')
        ]);

        $trade->status = 2;
        $trade->update();

         try{
            mailSend('trade_cancel', [
                'trader'          => auth()->user()->name,
                'amount'          => numFormat($trade->fiat_amount),
                'curr'            => $trade->fiat->code,
                'crypto_amount'   => numFormat($trade->crypto_amount,8),
                'cryp_curr'       => $trade->crypto->code,
                'trade_code'      => $trade->trade_code
             ],$trade->offerOwner);
        } catch(\Exception $e){}
        
        return back()->with('success','Trade has been canceled');
    }

    public function submitChat(Request $request)
    {
        $data = $request->validate([
            'trade_id' => 'required',
            'message'  => 'required_without:file',
            'file'     => 'image|mimes:jpg,png,JPG,jpeg,PNG|max:2048'
        ]);
        $trade = Trade::findOrFail($request->trade_id);
        if($trade->status == 3 || $trade->status == 2){
            return back()->with('error','Can not chat in a completed or canceled trade.');
        }
        $data['user_id'] = auth()->id();
        if($request->file){
            $data['file'] = MediaHelper::handleMakeImage($request->file);
        }
        TradeChat::create($data);
        return back()->with('success','Message sent');
    }

    public function markAsPaid(Request $request)
    {
        $request->validate(['trade_code' => 'required']);
        $trade = Trade::where(function($q){
            $q->where('offer_user_id',auth()->id())->orWhere('trader_id',auth()->id());
        })->where('trade_code',$request->trade_code)->firstOrFail();

        $trade->status = 1; //paid
        $trade->paid_date = now();
        $trade->update();

        TradeChat::create([
            'user_id' => auth()->id(),
            'trade_id' => $trade->id,
            'message' => translate('I have paid the desired amount. Please check and let me know.'),
        ]);

        return back()->with('success','Trade has been paid.');
    }

    public function tradeRelease(Request $request)
    {
        $request->validate(['trade_code' => 'required']);
     
        $trade = Trade::where(function($q){
            $q->where('offer_user_id',auth()->id())->orWhere('trader_id',auth()->id());
        })->where('trade_code',$request->trade_code)->firstOrFail();

        $trade->status = 3; //released
        $trade->released_date = now();
        $trade->update();

        if($trade->offer->type == 'sell') $user_id = $trade->trader_id;
        else  $user_id = $trade->offer_user_id;
      
        $wallet = Wallet::where('user_id', $user_id)->where('crypto_id',$trade->crypto_id)->first();
       
        if(!$wallet){
            $wallet = Wallet::create([
                'user_id' => $user_id,
                'crypto_id' => $trade->crypto_id,
                'balance'  => 0
            ]);
        }

        $wallet->balance += $trade->crypto_amount;
        $wallet->update();

        TradeChat::create([
            'user_id' => auth()->id(),
            'trade_id' => $trade->id,
            'message' => translate('I have released the desired ').$trade->crypto->code.translate(' .Please check and let me know.'),
        ]);
            
        return back()->with('success','Trade has been completed.');
    }

    public function dispute(Request $request)
    {
        $request->validate(['trade_code' => 'required']);
     
        $trade = Trade::where(function($q){
            $q->where('offer_user_id',auth()->id())->orWhere('trader_id',auth()->id());
        })->where('trade_code',$request->trade_code)->firstOrFail();

        if ($trade->trader_id == auth()->id() && $trade->status != 1 ) {
            return back()->with('error', 'Dispute is not available now.');
        }
        if($trade->offer_user_id == auth()->id() && ((Carbon::parse($trade->created_at)->addMinutes($trade->trade_duration)) > Carbon::now())) {
            return back()->with('error', 'Dispute is not available now.');
        }

        $trade->status = 4;
        $trade->update();

        TradeChat::create([
            'user_id' => auth()->id(),
            'trade_id' => $trade->id,
            'message' => translate('Dispute created by :') . auth()->user()->username,
        ]);

        return back()->with('success','Dispute opened.');
    }
}
