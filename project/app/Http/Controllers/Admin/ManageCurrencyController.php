<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Generalsetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ManageCurrencyController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.currency.index');
    }
    public function manageCurrency(Request $request,$type)
    {
        if($type != 'fiat' && $type != 'crypto') abort(404);
        else $type == 'fiat' ? $flag = 1 : $flag = 2;

        $search = $request->search;
        $currencies = Currency::when($search,function($q) use($search){
            return $q->where('code','like',"%$search%")->orWhere('curr_name','like',"%$search%");
        })->where('type',$flag)->orderBy('default','DESC')->paginate(20);
        return view('admin.currency.'.$type.'_currencies',compact('currencies'));
    }

    public function addCurrency()
    {
        return view('admin.currency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon'               => 'required_if:type,2|image|mimes:png,jpg,PNG,jpeg',
            'curr_name'          => 'required',
            'code'               => 'required|max:4',
            'symbol'             => 'required|unique:currencies',
            'rate'               => 'required|gt:0',
            'type'               => 'required|in:1,2',
            'default'            => 'required_if:type,1|in:1,0',
            'status'             => 'required|in:1,0',
            'deposit_charge'     => 'required_if:type,2|lt:100',
            'withdraw_charge'    => 'required_if:type,2|lt:100',
            'withdraw_limit_min' => 'required_if:type,2|gt:0',
            'withdraw_limit_max' => 'required_if:type,2|gt:0',
        ],
        [
            'curr_name.required'              =>'Currency name is required.',
            'withdraw_limit_min.required_if'  =>'Withdraw minimum limit is required when currency type is crypto.',
            'withdraw_limit_max.required_if'  =>'Withdraw maximum limit is required when currency type is crypto.',
            'icon.required_if'                =>'Icon is required when currency type is crypto.',
        ]);

        $data = $request->only('icon','curr_name','code','symbol','rate','type','default','status');
       
        if($request->default && $request->type != 2){
            $default = Currency::where('default',1)->firstOrFail();
            $default->default = 0;
            $default->save();

            $gs = Generalsetting::first();
            $gs->curr_code = $request->code;
            $gs->curr_sym = $request->symbol;
            Cache::forget('generalsettings');
            $gs->update();
        }else{
            $data['default'] = 0;
            $data['charges'] = [
                'deposit_charge'     => $request->deposit_charge,
                'withdraw_charge'    => $request->withdraw_charge,
                'withdraw_limit_min' => $request->withdraw_limit_min,
                'withdraw_limit_max' => $request->withdraw_limit_max
            ];
        }
        $data['icon'] = $request->icon ? MediaHelper::handleMakeImage($request->icon) : null;
        Currency::create($data);
        return back()->with('success','New currency has been added');
    }

    public function editCurrency($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.currency.edit',compact('currency'));
    }

    public function updateCurrency(Request $request,$id)
    {
        $request->validate([
            'icon'               => 'required_if:type,2|image|mimes:png,jpg,PNG,jpeg',
            'curr_name'          => 'required',
            'code'               => 'required|max:4|unique:currencies,code,'.$id,
            'symbol'             => 'required|unique:currencies,symbol,'.$id,
            'rate'               => 'required|gt:0',
            'type'               => 'required|in:1,2',
            'default'            => 'required_if:type,1|in:1,0',
            'status'             => 'required|in:1,0',
            'deposit_charge'     => 'required_if:type,2|lt:100',
            'withdraw_charge'    => 'required_if:type,2|lt:100',
            'withdraw_limit_min' => 'required_if:type,2|gt:0',
            'withdraw_limit_max' => 'required_if:type,2|gt:0',
        ],
        [
            'curr_name.required'              =>'Currency name is required.',
            'withdraw_limit_min.required_if'  =>'Withdraw minimum limit is required when currency type is crypto.',
            'withdraw_limit_max.required_if'  =>'Withdraw maximum limit is required when currency type is crypto.',
            'icon.required_if'                =>'Icon is required when currency type is crypto.',
        ]);
        
        $data = $request->only('icon','curr_name','code','symbol','rate','type','default','status');
        $curr = Currency::findOrFail($id);
        if($request->default && $request->type != 2){
            $defaultCurr = Currency::where('default',1)->firstOrFail();
            $defaultCurr->default = 0;
            $defaultCurr->save();

            $gs = Generalsetting::first();
            $gs->curr_code = $curr->code;
            $gs->curr_sym = $request->symbol;
            Cache::forget('generalsettings');
            $gs->update();
        }
        $data['charges'] = [
            'deposit_charge'     => $request->deposit_charge,
            'withdraw_charge'    => $request->withdraw_charge,
            'withdraw_limit_min' => $request->withdraw_limit_min,
            'withdraw_limit_max' => $request->withdraw_limit_max
        ];
        $data['icon'] = $request->icon ? MediaHelper::handleUpdateImage($request->icon,$curr->icon) : null;
        $curr->update($data);
        return back()->with('success','Currency has been updated');
    }

    public function updateCurrencyAPI(Request $request)
    {
        $request->validate(['crypto_access_key'=>'required','fiat_access_key'=>'required']);

        $gs = Generalsetting::first();
        $gs->fiat_access_key = $request->fiat_access_key;
        $gs->crypto_access_key = $request->crypto_access_key;
        $gs->update();

        return back()->with('success','Currency API Updated');
    }
    
}
