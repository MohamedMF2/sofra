<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /* ========= List of Products ======  */

    public function index(Request $request){

        $model =$request->user()->products()->latest()->paginate();
        if(count($model)<1){
            return responseJson(0,'this restaurant has no products' );
        }
        return responseJson(1,'success',$model);
     }

    /* ========= create new Product  ======  */

    public function create (Request $request){
        //dd($request);
        $validator = validator::make($request->all(),[
            'name' =>'required',
            'image' =>'required',
            'price' =>'required',
            'discount_price' =>'required',
            'prep_time' =>'required',
            'description' =>'required',
        ]);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $model=Product::create($request->all());
        $model ->restaurant_id = auth()->user()->id;
        $model->save();

        return responseJson(1,'successfully new product created', $model);
        }

        /* ========= edit new Product  ======  */

        
    public function edit( Request $request){
        $validator = validator()->make($request ->all() ,
        [
                // 'email'=> Rule::unique('restaurants')->ignore(auth()->user()->id),
            'name' =>'string|max:100',
            'image' =>'',
            'price' =>'',
            'discount_price' =>'',
            'prep_time' =>'',
            'description' =>'string|max:255',
            
            ]);
        //update product
        $model =$request->user()->products()->find($request->product_id);
       
       //case no products for this restaurant
        if(count($model)<1){
            return responseJson(0,'product doesnot exist');
        }
        //  product
        $model->update($request->all());

    
        return responseJson(1, 'your product has been edited successfully',[
            'restaurant'=>$model->restaurant_id,
            'product'=>$model
        ]);
    }


    /* ========= DELETE A PRODUCT  ======  */

    public function destroy(Request $request){
        $model =$request->user()->products()->find($request->product_id);
        if(!$model){
            return responseJson(0,'product doesnot exist',$model);
        }
        $model ->delete();
        return responseJson(1,'successfuly the product is deleted',[
            'restaurant'=>$request->user()->name,

        ]);
    }
    

    }   
