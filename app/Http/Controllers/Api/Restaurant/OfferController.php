<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;

class OfferController extends Controller
{
    /*================    List of offers   ================= */

    public function index(Request $request){
        $model = $request->user()->offers()->latest()->paginate(10);

        if(!$model){
            return responseJson (0,'there is no offers');
        }
        return responseJson (1,'success',[
            'restaurant' => $request->user()->name,
            'offers' =>$model
        ]);
    }

    /*================    create an offer   ================= */

    public function create(Request $request){

       $validator = Validator::make($request->all(),[
            'name' => 'required|unique:offers,name',
            'description' => 'required',
            'image' => 'required',
            'start' => 'required',
            'end' => 'required',
       ]);
       if($validator->fails()){
           return responseJson(0,$validator->errors()->first(),$validator->errors());
       }
       $model= Offer::create($request->all());
       $model ->restaurant_id = $request->user()->id;
       $model->save();

       return responseJson(1,'successfully new offer created', $model);
    }

    /*================    Edit an Offer   ================= */

    public function edit( Request $request){


        $validator = validator()->make($request ->all() ,
        [
                // 'email'=> Rule::unique('restaurants')->ignore(auth()->user()->id),
            'name' =>'max:100',
            'image' =>'',
            'start' =>'',
            'end' =>'',
            'description' =>'max:255',
            
            ]);
        if ($validator ->fails()){
            return responseJson ( 0 , $validator->errors()->first() , $validator->errors() );
        }
        //update product
        $model =$request->user()->offers()->find($request->offer_id);  
        
        if(!$model){
            return responseJson(0,'failed process , offer already deleted or didn\'t exist in the first place ');
        }
        $model->update($request->all());

    
        return responseJson(1, 'your offer has been edited successfully',[
            'restaurant'=>$model->restaurant->name,
            'offer'=>[$model->name,$model]
        ]);
    }

    /*================    Delete an Offer   ================= */

    public function destroy(Request $request){
        $model = $request->user()->offers()->find($request->offer_id);

        if(!$model){
            return responseJson(0,'failed process , offer already deleted or didn\'t exist in the first place ');
        }

        $model->delete();
        return responseJson(1,'Successful process , Offer deleted ' );
    }
}
