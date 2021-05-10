<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'slug',
        'details',
        'meta_tag',
        'meta_description',
    ];
}
