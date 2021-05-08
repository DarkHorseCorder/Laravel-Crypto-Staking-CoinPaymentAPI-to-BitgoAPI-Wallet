<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use App\Helpers\MediaHelper;
use App\Models\SeoSetting;

class SeoSettingResource {
    
    public function update($input,$data)
    {
        $input['meta_tag'] = tagFormat($input['meta_tag']);
        $images = ['meta_image'];
        foreach($images as $image){
            if(isset($input[$image])){
               $input[$image] = MediaHelper::handleUpdateImage($input[$image],$data[$image]);
            }
        }
        $data->update($input);
    }
}

