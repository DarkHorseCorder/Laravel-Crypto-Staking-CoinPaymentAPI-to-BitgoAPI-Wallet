<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $casts = [
        'charges' => 'object'
    ];
    protected $guarded = [];

    public function deposits()
    {
        return $this->hasMany(Deposit::class,'currency_id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawals::class,'currency_id');
    }
}
