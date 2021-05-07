<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use App\Helpers\MediaHelper;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogResource {
    
    // blog insert
    public function store($input)
    {
       $data = new Blog();
       $input['slug'] = Str::slug($input['title']);
       $input['description'] = clean($input['description']);
      
       if($input['photo']){
            $status = MediaHelper::ExtensionValidation($input['photo']);
            if(!$status){
                return ['errors' => [0=>'file format not supported']];
            }
            $input['photo'] = MediaHelper::handleMakeImage($input['photo']);
        }

       $data->create($input);
    }


    // blog update
    public function update($input,$data)
    {
      
       $input['slug'] = Str::slug($input['title']);
       $input['description'] = clean($input['description']);
       if(isset($input['photo'])){
            $status = MediaHelper::ExtensionValidation($input['photo']);
            if(!$status){
                return ['errors' => [0=>'file format not supported']];
            }
            $input['photo'] = MediaHelper::handleUpdateImage($input['photo'],$data->photo);
        }
        $data->update($input);
    }

    // blog delete
    public function destroy($data)
    {
        MediaHelper::handleDeleteImage($data->photo);
        $data->delete();
    }
}


