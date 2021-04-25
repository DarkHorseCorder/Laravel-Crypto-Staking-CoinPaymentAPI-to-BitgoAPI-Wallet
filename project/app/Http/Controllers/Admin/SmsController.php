<?php

namespace App\Http\Controllers\Admin;

use App\Models\SmsGateway;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    public function index()
    {
        $gateways = SmsGateway::orderBy('status','desc')->get();
        return view('admin.sms.gateways',compact('gateways'));
    }

    public function edit($id)
    {
        $gateway = SmsGateway::findOrFail($id);
        return view('admin.sms.edit',compact('gateway'));
    }

    public function update(Request $request,$id)
    {
        $rules = [];
        foreach ($request->except('_token') as $key => $val) {
            $rules[$key] = 'required';
        }
        $request->validate($rules);

        $activeGateway = SmsGateway::where('status',1)->first();

        $gateway = SmsGateway::findOrFail($id);
        $gateway->config = $request->except(['status','_token']);
       
        if($request->status && $activeGateway->id != $gateway->id){
            $gateway->status = 1;
            $activeGateway->status = 0;
            $activeGateway->update();
        }
        $gateway->update();
        return back()->with('success','Configuration updated');
    }

    public function templates(){
        $templates = EmailTemplate::orderBy('id','desc')->paginate(15);
        return view('admin.sms.templates',compact('templates'));
    }

    public function editTemplate($id)
    {
        $data = EmailTemplate::findOrFail($id);
        return view('admin.sms.edit_template',compact('data'));
    }

    public function updateTemplate(Request $request,$id)
    {
        $data = EmailTemplate::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Redirect Section          
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);    
    }
}
