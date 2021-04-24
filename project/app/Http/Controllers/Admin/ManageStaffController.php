<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class ManageStaffController extends Controller
{
    public function index()
    {
        $roles = Role::all()->pluck('name');
    
        $search = request('search');
        $status = null;
        if(request('status') == 'active')  $status = 1;
        if(request('status') == 'banned')  $status = 2;
      
        $staffs =  Admin::when($status,function($q) use($status) {
            return $q->where('status',$status);
        })->when($search,function($q) use($search) {
            return $q->where('email','like',"%$search%");
        })->where('role','!=','super-admin')->latest()->paginate(15);

        return view('admin.staff.index',compact('staffs','roles'));
    }

    public function addStaff(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:6',
            'role'      => 'required',
        ]);

        $staff = new Admin;
        $staff->name     = $request->name;
        $staff->email    = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->role     = $request->role;
        $staff->save();

        $staff->assignRole($request->role);

        return back()->with('success','Staff added successfully');
    }

    public function updateStaff(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => $request->password ? 'confirmed|min:6':'',
            'role'      => 'required',
            'status'      => 'required',
        ]);

        $staff = Admin::findOrFail($id);
        $staff->name     = $request->name;
        $staff->email    = $request->email;
        if($request->password) $staff->password = bcrypt($request->password);
        $staff->role     = $request->role;
        $staff->status     = $request->status;
        $staff->update();
        if(!in_array($request->role,$staff->getRoleNames()->toArray())){
            $staff->syncRoles([$request->role]);
        }

        return back()->with('success','Staff updated successfully');
    }
}
