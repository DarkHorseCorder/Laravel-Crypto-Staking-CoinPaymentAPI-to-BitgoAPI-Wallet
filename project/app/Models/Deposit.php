<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id')->withDefault(['code'=>'BTC']);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function($deposit)
        {
            Transaction::create([
                'trnx'    => $deposit->tnx,
                'user_id' => $deposit->user_id,
                'charge'  => $deposit->charge,
                'amount'  => numFormat($deposit->total_amount,8),
                'remark'  => 'deposit',
                'currency_id'  => $deposit->currency_id,
                'type'    => '+',
                'details' => translate('Deposit completed.')
            ]);

           try{
            mailSend('deposit_completed', [
                'crypto_amount'   => numFormat($deposit->total_amount,8),
                'cryp_curr'       => $deposit->currency->code,
                'charge'          => numFormat( $deposit->charge,8),
                'tnx'             => $deposit->tnx,
                'cp_tnx'          => $deposit->coinpayment_tnx
             ],$deposit->user);
           }
           catch(\Exception $e){}

           
           
        });
    }    
}
