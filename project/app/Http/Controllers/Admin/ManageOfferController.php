<?php

namespace App\Http\Controllers\Admin;
use App\Models\Offer;
use App\Models\OfferLimit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageOfferController extends Controller
{
    public function index(Request $request)
    {
       $type = $request->type;
       $offers = Offer::when($type,function($q) use($type){
         return $q->where('type',$type);
       })->with(['crypto','fiat','gateway','user','duration'])->latest()->paginate(15);
       return view('admin.offer.index',compact('offers'));
    } 
    
    public function offerDetails($id)
    {
        $offer = Offer::where('id',$id)->first();
        if(!$offer) return response('empty');
        return view('admin.offer.offer_details',compact('offer'));
    }

    public function changeStatus(Request $request)
    {
        $offer = Offer::findOrFail($request->id);
        if($offer->status == 1) $offer->status = 0;
        else $offer->status = 1;
        $offer->save();
        return back()->with('success','Offer status has been changed');
    }

    public function offerLimits()
    {
        $limits = OfferLimit::latest()->paginate(15);
        return view('admin.offer.offer_limit',compact('limits'));
    }

    public function addOfferLimits(Request $request)
    {
        $data = $request->validate(['offer_limit'=>'required|numeric|gte:0','trade_complete'=>'required|numeric|gte:0']);
        OfferLimit::create($data);
        return back()->with('success','New limit has been added');
    }
    public function updateOfferLimits(Request $request)
    {
        $data = $request->validate(['offer_limit'=>'required|numeric|gte:0','trade_complete'=>'required|numeric|gte:0']);
        OfferLimit::findOrFail($request->id)->update($data);
        return back()->with('success','limit has been updated');
    }
    public function removeOfferLimit(Request $request)
    {
        OfferLimit::findOrFail($request->id)->delete();
        return back()->with('success','limit has been removed');
    }

}
