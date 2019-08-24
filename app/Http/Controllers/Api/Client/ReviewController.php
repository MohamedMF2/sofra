<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Review ;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**========================================================================================================================================= 
                                           Making Review (Comment - rate)   
* ========================================================================================================================================
*/
    public function make_review(Request $request){
        $validator=Validator::make($request->all(),[
            'rate'=>'required|in:1,2,3,4,5',
            'comment'=>'required',
            'restaurant_id'=>'required',
        ]);
        
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        //create Review 
       $review= $request->user()->reviews()->where('restaurant_id', $request->restaurant_id)->updateOrCreate([
            'restaurant_id' => $request->restaurant_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);
       
       
       
        return responseJson(1,' success , review ',$review);
    }
/**========================================================================================================================================= 
                                           List of  Reviews   
* ========================================================================================================================================
*/
    public function reviews(){

        $reviews = Review::latest()->paginate();

        if(!$reviews){
            return responseJson(0,' Failed , there is no reviews fro this restaurant');
        }
        return responseJson(1,'suceess',$reviews);
    }

}
