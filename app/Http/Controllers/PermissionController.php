<?php

namespace App\Http\Controllers;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.permissions.index',compact('permissions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles
        return view('dashboard.permissions.create',compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->route = $request->route;
        $permission->save();
        if ($request->roles <> '') { 
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value); 
                $role->permissions()->attach($permission);
            }
        }
        flash()->success(' New Permission ( '.$permission->name.' ) created successfully');
        return back();
    }
   
    public function edit(Permission $permission)
    {
        return view('dashboard.permissions.edit', compact('permission'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name'=>'required',
            'guard_name'=>'required'
        ]);
        $permission->name=$request->name;
        $permission->route = $request->route;
        $permission->guard_name=$request->guard_name;
        $permission->save();
        flash()->success('permission'.$permission->name.' updated successfully');

        return redirect()->route('permission.index')
            ;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        flash()->error('permission '.$permission->name.' deleted');
        return redirect(route('permission.index'));
            
    }
}
