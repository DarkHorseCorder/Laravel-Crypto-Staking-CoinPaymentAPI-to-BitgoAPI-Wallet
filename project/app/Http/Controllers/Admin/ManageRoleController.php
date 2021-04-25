<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;

class ManageRoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
       
        return view('admin.role.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('admin.role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required','permissions' => 'required'],['permissions.required'=>'At least one permission is required.']);

        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);

        return back()->with('success','Role created successfully with permissions');

    }

    public function edit($id)
    {
        $role = Role::findById($id);
        $perms = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::get();
        return view('admin.role.edit',compact('role','perms','permissions'));
    }

    public function update(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        $perms = $role->permissions->pluck('id')->toArray();
        foreach ($request->permissions as $key => $val) {
            if(in_array($val,$perms)){
                unset($key, $request->permissions);
            }
        }
        $role->syncPermissions($request->permissions);
        return back()->with('success','Permission updated successfully');
    }
}
