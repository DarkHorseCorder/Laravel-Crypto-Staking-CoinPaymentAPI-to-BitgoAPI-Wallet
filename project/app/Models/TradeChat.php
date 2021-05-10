<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeChat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function trade()
    {
        return $this->belongsTo(Trade::class,'trade_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id')->withDefault();
    }
}
