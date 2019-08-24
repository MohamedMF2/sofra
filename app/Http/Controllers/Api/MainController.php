<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant ;
use App\District ;
use App\City ;
use App\Product ;
use App\Contact ;
use App\Setting;
use App\Offer;

class MainController extends Controller
{
    /* ==================== All Restaurants , restaurants in specific city , searching for restaurant   ======================*/ 
   
    public function restaurants (Request $request){
        $model=Restaurant::where( function($query) use($request){
            if($request->has('district_id') ){
                $query->where('district_id' ,'=',$request->district_id);
            }
            if($request->has('search') ){
                $query->where('name' ,'like','%'.$request->search.'%');
            }
    }) ->get();

    return responseJson(1,'success',$model);

    }

     // =========================== all Cities ===============================  ---
    
    public function cities(){
    $model = City::all();
    return  responseJson(1 , 'success' , $model) ;
    }

    // =========================== all districts , All of specific City  ===========================  ---

    public  function  districts ( Request $request ) {
    $model = District::where ( function($query) use($request) {
        if ( $request -> has ('city_id') ){
            $query->where ('city_id' , $request->city_id);
        }
    }) ->get();
    
    return  responseJson(1 , 'success' , $model) ;
    }

 /* ====================  products of specific resturant   =============================*/ 
   
    public function products (Request $request){
    $model =Product::where('restaurant_id',$request->restaurant_id)->get();

    return responseJson(1,'تم بنجاح',$model);

    }
        /*=============================== restaurant info  ==========================*/

   public function restaurant_details(Request $request){
        $model = Restaurant::where('id',$request->restaurant_id)->get();
       
        return responseJson(1,'success',$model);

   }

    /*=============================== contact us  ==========================*/
    public function contact_us(Request $request){
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required' ,
            'message'   => 'required',
            'type'      => 'required|in:complaint,suggestion,enquiry'
        ]);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first() ,$validator->errors());
        }

        $model = Contact::create($request->all());
        return responseJson(1,'success',$model );
    }

    /*=============================== about us  ==========================*/
    public function about(){
        $model= Setting::find(1);
       $record=  $model->about ;
        return responseJson(1,'success',$record);
    }   

    /*=============================== about us  ==========================*/
public function new_offers (){
    $model= Offer::with('restaurant')->get();
   // dd($model);
    return responseJson(1,'success',$model);
}

  
}
