<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }
    public function crypto()
    {
        return $this->belongsTo(Currency::class,'cryp_id')->withDefault();
    }
    public function fiat()
    {
        return $this->belongsTo(Currency::class,'fiat_id')->withDefault();
    }
    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class,'gateway_id')->withDefault();
    }
    public function duration()
    {
        return $this->belongsTo(TradeDuration::class,'trade_duration')->withDefault();
    }
}
