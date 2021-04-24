<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trade;
use App\Models\Wallet;
use App\Models\TradeChat;
use App\Helpers\MediaHelper;
use Illuminate\Http\Request;
use App\Models\TradeDuration;
use App\Http\Controllers\Controller;

class ManageTradeController extends Controller
{
    public function tradeDurations()
    {
        $durations = TradeDuration::paginate(18);
        return view('admin.trade.durations',compact('durations'));
    }

    public function addTradeDuration(Request $request)
    {
        $request->validate(['duration'=>'required|integer|gt:0|unique:trade_durations']);
        $duration = new TradeDuration();
        $duration->duration = $request->duration;
        $duration->save();
        return back()->with('success','Trade duration added');
    }

    public function updateTradeDuration(Request $request)
    {
        $request->validate(['duration'=>'required|integer|gt:0|unique:trade_durations,duration,'.$request->id]);
        $duration = TradeDuration::findOrFail($request->id);
        $duration->duration = $request->duration;
        $duration->update();
        return back()->with('success','Trade duration updated');
    }

    public function removeTradeDuration(Request $request)
    {
        TradeDuration::findOrFail($request->id)->delete();
        return back()->with('success','Trade duration has been removed');
    }

    public function trades($type = null)
    {    
        if($type == 'disputed') $status = 4;
        elseif($type == 'completed') $status = 3;
        else $status = null;
        $trades =  Trade::when(request('search'), function($q){
            return $q->where('trade_code',request('search'));
        })
        ->when($status, function($q) use($status){
            return $q->where('status',$status);
        })
       
        ->with(['crypto','fiat','trader'])->latest()->paginate(15);
        return view('admin.trade.trades',compact('trades'));
    }

    public function tradeDetails($tradeCode)
    {
        $trade = Trade::whereTradeCode($tradeCode)->with(['offer'])->firstOrFail();
        $messages = TradeChat::where('trade_id',$trade->id)->with(['user','trade'])->get();
        return view('admin.trade.trade_details',compact('trade','messages'));
    }

    public function submitChat(Request $request)
    {
        $data = $request->validate([
            'trade_id' => 'required',
            'message'  => 'required_without:file',
            'file'     => 'image|mimes:jpg,png,JPG,jpeg,PNG|max:2048'
        ]);
        $data['admin_id'] = admin()->id;
        if($request->file){
            $data['file'] = MediaHelper::handleMakeImage($request->file);
        }
        TradeChat::create($data);
        return back()->with('success','Message sent');
    }

    public function tradeRelease(Request $request)
    {
        $request->validate(['trade_code' => 'required']);
     
        $trade = Trade::where('trade_code',$request->trade_code)->firstOrFail();

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
            
        return back()->with('success','Trade Complete.');
    }

    public function tradeRefund(Request $request)
    {
        $request->validate(['trade_code' => 'required']);
     
        $trade = Trade::where('trade_code',$request->trade_code)->firstOrFail();

        $trade->status = 5; //refunded
        $trade->update();
      
        $wallet = Wallet::where('user_id', $trade->offer_user_id)->where('crypto_id',$trade->crypto_id)->first();
       
        $wallet->balance += $trade->crypto_amount;
        $wallet->update();
            
        return back()->with('success','Trade Has Been Refunded.');
    }


}
