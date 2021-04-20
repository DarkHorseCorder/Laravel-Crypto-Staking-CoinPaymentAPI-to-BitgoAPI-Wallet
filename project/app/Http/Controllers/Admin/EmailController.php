<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\EmailTemplate,
    Models\Generalsetting,
    Models\User
};
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class EmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $templates = EmailTemplate::orderBy('id','desc')->paginate(15);
        return view('admin.email.index',compact('templates'));
    }

    public function config(){
        return view('admin.email.config');
    }


    public function edit($id)
    {
        $data = EmailTemplate::findOrFail($id);
        return view('admin.email.edit',compact('data'));
    }

    public function groupEmail()
    {
        $config = Generalsetting::findOrFail(1);
        return view('admin.email.group_mail',compact('config'));
    }

    public function groupemailpost(Request $request)
    {
        $users = User::whereStatus(1)->where('email_verified',1)->get(['id','name','email']);
        foreach ($users as $user) {
            @email([
                'email'   => $user->email,
                'name'    => $user->name,
                'subject' => $request->subject,
                'message' => clean($request->message),
            ]);
        }
        return back()->with('success','Email sent to all users.');

    }

    public function update(Request $request, $id)
    {
        $data = EmailTemplate::findOrFail($id);
        $input = $request->all();
        $input['email_body'] = clean($input['email_body']);
        $data->update($input);       
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);     
    }

}
