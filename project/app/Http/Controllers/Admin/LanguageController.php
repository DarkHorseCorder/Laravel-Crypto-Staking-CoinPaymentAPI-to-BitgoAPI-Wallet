<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Http\Requests\Admin\LanguageRequest;

class LanguageController extends Controller
{

    public function index()
    {
        $languages = Language::orderBy('is_default','DESC')->paginate(12);
        return view('admin.language.index',compact('languages'));
    }
   
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:25|unique:languages,language','code' => 'required|unique:languages']);
        $mydata = json_decode(json_encode(file_get_contents(resource_path ('/lang/default.json'))));
        $data = new Language();
        $data->language = $request->name;
        $data->code = $request->code;
        $data->file = $request->code.'.json';
        $data->save();

        @file_put_contents(resource_path('/lang/'.$data->file),$mydata);  
        return back()->with('success','Language added successfully');
    }

    public function edit(Language $language)
    {
        $data_results = file_get_contents(resource_path('/lang/'.$language->file));
        $lang = json_decode($data_results, true);
        return view('admin.language.edit',compact('language','lang'));
    }


    public function update(Request $request, Language $language)
    {
        $request->validate(['name' => 'required|max:25|unique:languages,language,'.$language->id]);
        $language->language = $request->name;
        $language->save();
        return back()->with('success','Language updated successfully');
    }

    public function storeTranslate(Request $request,$id)
    {
        $request->validate([ 'key' => 'required', 'value' => 'required']);
        
        $lang = Language::findOrFail($id);
        $oldData = json_decode(file_get_contents(resource_path('lang/') . $lang->file),true);

        if (array_key_exists(trim($request->key),$oldData)) {
            return back()->with('error', trim($request->key)." already exist");
        } else {
            $newData[trim($request->key)] = trim($request->value);
            $mergeData  = array_merge($oldData, $newData);
            file_put_contents(resource_path('lang/') . $lang->file, json_encode($mergeData));
            return back()->with('success', "New translation has been added");
        }
    }

    public function updateTranslate(Request $request,$id)
    {
        $request->validate(['key' => 'required', 'value' => 'required']);
        $lang     = Language::findOrFail($id);
        $oldData  = json_decode(file_get_contents(resource_path('lang/') . $lang->file), true);
        $oldData[trim($request->key)] = $request->value;
        file_put_contents(resource_path('lang/'). $lang->file, json_encode($oldData));
        return back()->with('success', 'Translation updated successfully');
    }

    public function removeTranslate(Request $request)
    {
        $request->validate(['key' => 'required']);
        $lang = Language::findOrFail($request->language);
        $oldData = json_decode(file_get_contents(resource_path('lang/') . $lang->file),true);
        unset($oldData[trim($request->key)]);
        file_put_contents(resource_path('lang/'). $lang->code . '.json', json_encode($oldData));
        return back()->with('success', "Translation key has been removed");
    }

    public function statusUpdate(Request $request)
    {
        Language::where('is_default',1)->update(['is_default' => 0]); 
        $lang = Language::findOrFail($request->id);
        $lang->is_default = 1;
        $lang->update();
        return response()->json(['success' => __('Default language has been changed.')]);      
    }

    public function destroy(Request $request)
    {
        $lang = Language::findOrFail($request->id);
        $path = resource_path('lang/') . $lang->code;
        file_exists($path) && is_file($path) ? @unlink($path) : false;
        $lang->delete();
        return back()->with('success', 'Language deleted successfully');
    }
}
