<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use App\Role ;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();  // //get all roles
        return view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();  //get all permissions
        return view('dashboard.roles.create',compact('permissions'));
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
            'name'=>'required|unique:roles|max:10',
            'guard_name'=>'required',
            'permissions'=>'required'
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->save();
        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }
        flash()->success('success new Role added  '. $role->name.'successfully');
        return back();
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('dashboard.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);//Get role with the given id
        //Validate name and permission fields
            $this->validate($request, [
                'name'=>'required|max:10|unique:roles,name,'.$id,
                'permissions' =>'required',
            ]);
            $input = $request->except(['permissions']);
            $role->fill($input)->save();
            if($request->permissions <> ''){
                $role->permissions()->sync($request->permissions);
            }
        flash()->success('updated successfully');
        return redirect(route('role.index'));
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role =Role::find($id);
        $role ->delete();
        flash()->error('Role ( '.$role->name.' ) is deleted successfully');
        return redirect(route('role.index'));
    }
}
