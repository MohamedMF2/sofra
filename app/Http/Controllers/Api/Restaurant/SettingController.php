<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting ;

class SettingController extends Controller
{
    public function commission_statement(){
        $model = Setting::find(1);
        return responseJson(1,'success',$model) ;       
    }
}
