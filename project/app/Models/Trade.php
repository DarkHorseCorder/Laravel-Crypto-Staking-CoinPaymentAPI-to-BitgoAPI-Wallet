<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id')->withDefault();
    }
    
    public function offerOwner()
    {
        return $this->belongsTo(User::class,'offer_user_id')->withDefault();
    }

    public function trader()
    {
        return $this->belongsTo(User::class,'trader_id')->withDefault();
    }

    public function crypto()
    {
        return $this->belongsTo(Currency::class,'crypto_id')->withDefault();
    }
    
    public function fiat()
    {
        return $this->belongsTo(Currency::class,'fiat_id')->withDefault();
    }

    public function messages()
    {
        return $this->hasMany(TradeChat::class,'trade_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function($trade)
        {
        
           Transaction::create([
               'trnx'    => str_rand(),
               'user_id' => $trade->offer->type == 'sell' ? $trade->offer_user_id : $trade->trader_id,
               'charge'  => $trade->offer->type == 'buy'  ? $trade->trade_fee : 0,
               'amount'  => numFormat($trade->crypto_amount,8),
               'currency_id'  => $trade->crypto_id,
               'remark'  => 'trading',
               'type'    => '-',
               'details' => translate('Holding balance for trading.')
           ]);

           try{
            mailSend('trade_request', [
                'trader'          => $trade->trader->name,
                'amount'          => numFormat($trade->fiat_amount),
                'curr'            => $trade->fiat->code,
                'crypto_amount'   => numFormat($trade->crypto_amount,8),
                'cryp_curr'       => $trade->crypto->code,
                'link'            => route('user.trade.details',$trade->trade_code)
             ],$trade->offerOwner);
           }
           catch(\Exception $e){}
           
        });

        static::updated(function($trade)
        {
            if($trade->status == 1){
                if($trade->offer->type == 'buy'){
                    $user = $trade->trader;
                    $name = $trade->offerOwner->name;
                } 
                else{
                    $user = $trade->offerOwner;
                    $name = $trade->trader->name;
                } 
                
                try{
                    mailSend('trade_paid', [
                        'trader'          => $name,
                        'amount'          => numFormat($trade->fiat_amount),
                        'curr'            => $trade->fiat->code,
                        'crypto_amount'   => numFormat($trade->crypto_amount,8),
                        'cryp_curr'       => $trade->crypto->code,
                        'trade_code'      => $trade->trade_code,
                        'date_time'       => dateFormat($trade->paid_date)
                     ],$user);
                   }
                   catch(\Exception $e){} 
            }

            if($trade->status == 3){
               
                Transaction::create([
                    'trnx'    => str_rand(),
                    'user_id' => $trade->offer->type == 'sell' ? $trade->trader_id : $trade->offer_user_id,
                    'charge'  => 0,
                    'amount'  => numFormat($trade->crypto_amount,8),
                    'remark'  => 'trading completed',
                    'currency_id'  => $trade->crypto_id,
                    'type'    => '+',
                    'details' => translate('Trading has been completed.')
                ]);
               
                if($trade->offer->type == 'buy'){
                    $user = $trade->offerOwner;
                    $name = $trade->trader->name;
                } 
                else{
                    $user = $trade->trader;
                    $name = $trade->offerOwner->name;
                } 

                try{
                 mailSend('trade_completed', [
                     'trader'          => $name,
                     'amount'          => numFormat($trade->fiat_amount),
                     'curr'            => $trade->fiat->code,
                     'crypto_amount'   => numFormat($trade->crypto_amount,8),
                     'cryp_curr'       => $trade->crypto->code,
                     'trade_code'      => $trade->trade_code,
                     'date_time'       => dateFormat($trade->paid_date)
                  ],$user);

                }
                catch(\Exception $e){} 


                if($trade->status == 5){
               
                    Transaction::create([
                        'trnx'    => str_rand(),
                        'user_id' => $trade->offer_user_id,
                        'charge'  => 0,
                        'amount'  => numFormat($trade->crypto_amount,8),
                        'remark'  => 'trading refunded',
                        'currency_id'  => $trade->crypto_id,
                        'type'    => '+',
                        'details' => translate('Trading has been refunded.')
                    ]);
                   
                  
                    $user = $trade->offerOwner;
                    $name = $trade->offerOwner->name;
                  
                    try{
                     mailSend('trade_completed', [
                         'crypto_amount'   => numFormat($trade->crypto_amount,8),
                         'cryp_curr'       => $trade->crypto->code,
                         'trade_code'      => $trade->trade_code,
                      ],$user);
    
                    }
                    catch(\Exception $e){} 
                }

               
            }
        });
    }
}




