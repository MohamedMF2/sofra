<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant ;

class RestaurantController extends Controller
{
    /* ================================================ Register =================================================*/

   public function register(Request $request){
    $validator = validator::make($request->all(),[
        'name' =>'required|unique:restaurants,name',
        'email' =>'required|unique:restaurants,email',
        'phone' =>'required|unique:restaurants,phone',
        'password' =>'required|confirmed',
        'district_id' =>'required',
        'category_id' =>'required',
        'minimum_charge' =>'required',
        'delivery' =>'required',
        'whatsapp' =>'required|unique:restaurants,whatsapp',
        'status' =>'required',
        'image' =>'required',

    ]);

    if ($validator->fails()){
        return responseJson(0,$validator->errors()->first(),$validator->errors());
    }
    $request->merge([ 'password' => bcrypt($request->password)]) ;
    $model = Restaurant::create($request->all());
    $model->api_token =str_random(60);
    $model->save();
    return responseJson(1 ,"success",[
        'api_token' =>$model->api_token,
        'client'=>$model
    ]);
}
                                                   
   /* ================================================Login=================================================*/
   public function login(Request $request){
    $validator =validator()->make($request->all() ,[
        'email' =>'required',
        'password'=>'required',
    ] ); 

    if ($validator ->fails()){
        return responseJson ( 0 , $validator->errors()->first() , $validator->errors() );
    }

    $model = Restaurant::where ('email' , $request->email ) ->first();
    if($model){

            if(Hash::check($request->password , $model->password)){
                return responsejson(1 , "successful login",[
                    'api_token'=>$model->api_token ,
                    'client' =>$model
                ]);
            }else{
                return responsejson(0 , "unsuccessful login");
            }

    }else{
        return responseJson(0 , "unsuccessful login ");
    }

}


/*==================================================Reset password==================================================*/
public function reset_password (Request $request){
    $validator =validator()->make($request->all() ,[
        'email' =>'required',
    ]); 

    if ($validator ->fails()){
        return responseJson ( 0 , $validator->errors()->first() , $validator->errors() );
    }

    $model = Restaurant::where ('email' , $request->email ) ->first();
    if($model){
        $code = rand(11111,999999);
        $update = $model -> update ( ['pin_code' => $code] );

        if($update){
            Mail::to($model->email )
                    ->bcc('furious_fouad@yahoo.com')
                    ->send(new ResetPassword($code));   
                    return responseJson ( 1 , " sending you a verification code", ['pin_code_for_test' => $code]  );
        }

    }else{
        return responseJson(0 , "wrong email " ,$request->email);
    }
    
}
                                 
        /*==================================================== New Password ======================================================*/


        public function new_password (Request $request){
            $validator =validator()->make($request->all() ,[
    
                    'pin_code' =>'required',
                    'password' => 'required |confirmed',
            ]);
    
            if($validator ->fails()){
                return responseJson(0, $validator->errors()->first() , $validator->errors());
            }
            $model = Restaurant::where('pin_code',$request->pin_code)->first();
            if($model){
            
                    $model->password =bcrypt( $request->password) ;
                    $model->pin_code = null;
    
                    if  ( $model->save() ){
                        return responseJson(1, 'Your Password Have been changed Successfully',$model->name);
                    }else{
                                return responseJson(0, 'Something went wrong try again');
                    }
    
            }else{
                    return responseJson(0, 'This Pin Code is incorrect');
            }
        }
    
    
/*=================  Profile ==================*/

    public function profile(Request $request){
        
        //profile validation rules
        $validator = validator()->make($request ->all() ,
        [
            // 'email'=> Rule::unique('restaurants')->ignore(auth()->user()->id),
            'email'=> 'unique:restaurants,email,'.$request->user()->id,
            'password'=>'confirmed',
            'phone' => 'unique:restaurants,phone,'.$request->user()->id,
        ]);

        //error messages
        if ($validator ->fails()){
            return responseJson ( 0 , $validator->errors()->first() , $validator->errors() );
        }
        //encrypt password
        $request->merge(['password'=>bcrypt($request->password)]);
        
        //update clients
        $user = request()->user();
        $user ->update($request->all());

        return responseJson(1, 'your profile has been edited successfully',[
            'api_token'=>$user->api_token,
            'restaurant'=>$user
        ]);

    } 
    
   


}
