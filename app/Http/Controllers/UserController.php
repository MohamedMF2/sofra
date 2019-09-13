<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        $users = User::paginate(10);
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('dashboard.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
         request()->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
        ]);
        //Create user 
        $user = User::create($request->except('roles'));
        
        // if the roles is not empty  attach it to the user     
        if($request->roles <> ''){
            $user->roles()->attach($request->roles);
        }
      
        flash()->success(' New User Has been created successfully');
        return redirect(route('user.index'));



            /* 
             //Validation
         request()->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
            // 'roles' => 'required'
        ]);
        //Create user 
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        // if the users is not empty  attach it to the user     
        if($request->roles <> ''){
            $user->roles()->attach($request->roles);
        }
      
        flash()->success(' New User Has been created successfully');
        return redirect(route('user.index'));
            */


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::get(); 
        return view('dashboard.users.edit', compact('user', 'roles')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);   
        //validation
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);
        
        $input = $request->except('roles');
        $user->fill($input)->save();
        if ($request->roles <> '') {
            $user->roles()->sync($request->roles);        
        }        
        else {
            $user->roles()->detach(); 
        }
        flash()->success('User updated Successfully');
        return redirect(route('user.edit',$user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash()->success($user->name.' deleted successfully');
        return(redirect(route('user.index')));
    }
 
}
