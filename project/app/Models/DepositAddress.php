<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function curr()
    {
        return $this->belongsTo(Currency::class,'currency_id')->withDefault(['code'=>'BTC']);
    }
}
