<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting ;
class SettingController extends Controller 
{


  public function edit()
  {
    $settings = Setting::first();
    return view ('dashboard.settings.edit',compact('settings'));

  }

  public function store(Request $request ){
    $data = request()->validate([
       'phone' => 'required',
       'email' => 'required',
       'facebook' => 'required',
       'instagram' => 'required',
       'youtube' => 'required',
       'linkedin' => 'required',
       'google' => 'required',
       'whatsapp' => 'required',
       'twitter' => 'required',
       'about' => 'required',
    ]);

    $setting = Setting::where('id',1)->update($data);
    return redirect(route('setting.edit'));
         
     }
  
  
}

?>