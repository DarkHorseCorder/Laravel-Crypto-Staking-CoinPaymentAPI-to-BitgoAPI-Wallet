<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeoSettingRequest;
use App\Http\Resources\SeoSettingResource;
use App\Models\SeoSetting;

class SeoSettingController extends Controller{

    public function __construct(SeoSettingResource $resource)
    {
        $this->resource = $resource;
    }

    public function index()
    {
       $seosetting = SeoSetting::first();
       return view('admin.seo.index',compact('seosetting'));
    }


    public function update(SeoSettingRequest $request , SeoSetting $seoSetting)
    {
       $this->resource->update($request->all(),$seoSetting);
       return response()->json(__('Data Update Successfully'));
    }

}