<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawals extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id')->withDefault();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function($withdraw)
        {
            Transaction::create([
                'trnx'    => $withdraw->trx,
                'user_id' => $withdraw->user_id,
                'charge'  => $withdraw->charge,
                'amount'  => numFormat($withdraw->total_amount,8),
                'remark'  => 'withdraw',
                'currency_id'  => $withdraw->currency_id,
                'type'    => '-',
                'details' => translate('Withdraw requested.')
            ]);

        });
    }    
  
}
