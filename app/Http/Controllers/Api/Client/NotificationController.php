<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Token;
use App\Client;
use App\Notification;

class NotificationController extends Controller
{
    /*============== Register Token ============*/
    public function register_token(Request $request){
        $validator =Validator::make($request->all(),[
            'platform' => 'required|in:android,ios',
            'token' =>    'required'
        ]);

        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors() );
        }

       // Token::where('token',$request->token)->delete();

        $data = $request->user()->tokens()->create($request->all()) ;

        return responseJson(1,'تم التسجيل بنجاح',$data);
     }

    /*============== remove Token ============*/


    public function remove_token(Request $request){
        $validator = Validator::make($request->all(),[
            'token' =>'required'
        ]) ;

        if ($validator->fails()){
            return responseJson( 0 , $validator()->errors()->firt(),$validator->errors());
        }
       // Token::where('token',$request->token)->delete();
       $token= $request->user()->tokens()->where('token',$request->token)->delete();
        return responseJson(1 , 'token removed and logged out ');
    }


    /*============== Notifications ============*/

    public function notifications(Request $request){
        $notifications = $request->user()->notifications()->get();
        if(!$notifications){
            return responseJson(0,' failed , no notification for this client');
        }
        return responseJson(1,'success , here is your notifications ',$notifications);

        
        ;
    }
    /*============== Count ============*/

    public function count(Request $request){
        $count=$request->user()->notifications()->where('is_read',0)->count() ;

        if(!$count){
            return responseJson(0,'failed');
        }

        return responseJson(1,'success',[
            'notifications_count' => $count
        ]);
    }

    /*============== is_read ============*/

    public function is_read(Request $request){
        $notification =Notification::where(['id'=>$request->notification_id,'is_read'=>0])->first();

        if(!$notification){
            return responseJson(0 ,'failed' );
        }

        $notification->update([
            'is_read' => 1
            ]);
            return responseJson(1,'success',$notification);
        }
    }

