<?php

namespace App\Http\Resources;
use App\Models\AdminLanguage;
use Illuminate\Support\Str;

class AdminLanguageResource {
    
    // language category insert
    public function store($input)
    {
       
        $mydata = json_decode(json_encode(file_get_contents(resource_path ('/lang/default.json'))));
       
        $data = new AdminLanguage();
        $data->language = $input['name'];
        $data->file = 'admin_'.Str::slug($input['name'],'_').'.json';
        $data->save();
        file_put_contents(resource_path('/lang/'.$data->file),$mydata);  
    }

    // language category update
    public function update($request,$language)
    {
        $input = $request->all();

        $data['language'] = $input['name'];
        $data['rtl'] = $input['rtl'];   
        ;
        $language->update($data);
        
  
        $keys = $request->keys;
        $values = $request->values;
        $new = null;
        foreach(array_combine($keys,$values) as $key => $value)
        {
            $n = str_replace("_"," ",$key);
            $new[$n] = $value;
        }        
        $mydata = json_encode($new);
        file_put_contents(resource_path('lang/'.$language->file), $mydata); 
    }



    // language category delete
    public function destroy($language)
    {
        if($language->id == 1)
        {
            return "You don't have access to remove this language";
        }
        if($language->is_default == 1)
        {
            return "You can not remove default language.";            
        }
        if (file_exists(resource_path('/lang/'.$language->file))) {
            unlink(resource_path('/lang/'.$language->file));
        }
        $language->delete();
    }
}


