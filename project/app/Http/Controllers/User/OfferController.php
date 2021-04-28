<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferValidation;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Offer;
use App\Models\PaymentGateway;
use App\Models\TradeDuration;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('user_id',auth()->id())->with(['gateway','crypto','fiat','duration'])->latest()->paginate(15);
        return view('user.offer.index',compact('offers'));
    }

    public function create()
    {
        $currencies     = Currency::where('type',2)->get();
        $paymentMethods = PaymentGateway::where('status',1)->get();
        $tradeSpeeds    = TradeDuration::get();
        return view('user.offer.create',compact('currencies','paymentMethods','tradeSpeeds'));
    }

    public function store(OfferValidation $request)
    {
        if(!kycOfferLimit()){
            return back()->with('error','Please submit your KYC info to create further offer');
        }
        if(!offerLimit()){
            return back()->with('error','Sorry!! You must complete more trade to create further offer');
        }
        $data = $request->except('_token');
        if($request->margin && $request->margin < 0){
            $data['margin']     = abs($request->margin);
            $data['neg_margin'] = 1;
        }
        $data['user_id']  = auth()->id();
        $data['offer_id'] = str_rand();
        Offer::create($data);
        return back()->with('success','Offer has been created');
    }

    public function edit($id)
    {
        $offer          = Offer::where('offer_id',$id)->where('user_id',auth()->id())->firstOrFail();
        $currencies     = Currency::where('type',2)->get();
        $paymentMethods = PaymentGateway::where('status',1)->get();
        $tradeSpeeds    = TradeDuration::get();
        return view('user.offer.edit',compact('offer','currencies','paymentMethods','tradeSpeeds'));
    }

    public function update(OfferValidation $request)
    {
        $data = $request->except('_token');
        if($request->margin && $request->margin < 0){
            $data['margin']     = abs($request->margin);
            $data['neg_margin'] = 1;
        }
        Offer::findOrFail($request->id)->update($data);
        return back()->with('success','Offer has been updated');
    }

    public function changeStatus(Request $request)
    {
        $offer = Offer::findOrFail($request->id);
        if($offer->status == 1){
            $offer->status = 0;
            $msg = 'Offer deactivated';
        } 
        else{
            $offer->status = 1;
            $msg = 'Offer activated';
        } 
        $offer->save();
        return back()->with('success',$msg);

    }
}
