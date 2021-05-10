<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title','category_id','photo','slug', 'description', 'source', 'views','updated_at', 'status','meta_tag','meta_description','tags'];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class)->withDefault([
            'name' => 'Deleted',
        ]);
    }
}
