<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function edit(){
        $user = User::where('id', auth()->user()->id );
        return view('dashboard.admin.edit',compact('user'));
    }

    public function store(Request $request ){
      $data= request()->validate([
            'password' => 'required|confirmed',
       ]);
     $user = User::where('id',auth()->user()->id)->first();
     $request ->merge( ['password' => bcrypt($request->password) ] );
     $user->update($request->all());
        flash()->success(' password changed successfully');
        return redirect(route('dashboard.admin.edit'));
       
    }
}
