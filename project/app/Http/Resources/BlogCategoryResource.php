<?php

namespace App\Http\Resources;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryResource {
    
    // blog category insert
    public function store($input)
    {
       $data = new BlogCategory();
       $input['slug'] = Str::slug($input['name']);
       $data->create($input);
    }

    // blog category update
    public function update($input,$bategory)
    {
        $bategory->update($input);
    }

    // blog category delete
    public function destroy($data)
    {
        $data->delete();
    }
}


