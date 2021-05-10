<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLanguage extends Model
{
    public $timestamps = false;
    protected $fillable = ['language','file','rtl','is_default'];
}
