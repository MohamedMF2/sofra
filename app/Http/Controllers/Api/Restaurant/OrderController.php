<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order ;
use App\Client ;
use App\Payment ;
use App\Restaurant ;
use App\Setting ;




 
class OrderController extends Controller
{
/*========================================================================================================================================= 
                                             List of Pending Orders    
* ========================================================================================================================================
*/
    public function new_order(Request $request){
        $order=  $request->user()->orders()->where('status','pending')->with('products')->get();

        if(empty($order)){
            return responseJson(0,'failed no orders for this restaurant');
        }    
   
        return responseJson(1,'success',$order);
    }
 /**========================================================================================================================================= 
                                  The Accepting Button Function ( accepting orders )     
* ========================================================================================================================================
*/

    public function accept (Request $request){
        $remaining = $request->user()->payments()->first()->remaining;
       // dd($remaining);
        if($remaining >=500 ){
            return responseJson(0,'Failed , u can\'t accept any orders until the  remainng commissions are paid  ' ,$remaining );
        }
        $order = $request->user()->orders()->find($request->order_id);
        if( !$order ){
            return responseJson(0,'this order doesn\'t exist') ;
        }
        $order ->update([
            'status' => 'accepted',
        ]);
        //finding the client that we will send him a notification 
        $client = Client::find($order->client->id);

        // create notification 
        $notification =  $client->notifications()->create([
            'title'  => ' Client : Accepted Order ',
            'body'  => ' Your Order has been accepted '.$order->client->name.' by '.$request->user()->name,
            'order_id' =>$order->id ,
        ]);
            
        // notification parameters
        $tokens = $client ->tokens()->where('token','!=','')->pluck('token')->toArray();
        $title = $notification->title ; 
        $body = $notification->body ;
        $data = [
            'title'  => ' Client : Accepted Order ',
            'body'  => ' Your Order has been accepted '.$order->client->name.' by '.$request->user()->name,
            'order_id' =>$order->id ,
        ];
        $send = notifyByFirebase($title,$body,$tokens,$data);

        // Response
        return responseJson(1 ,'the order is accepted  ',[
            'status'=>$order->status,
            'client'=>$order->client->name,
            'order'=>$order
        ]);

    }
/**========================================================================================================================================= 
                                   The Rejection Button Function ( Rejected Orders )     
* ========================================================================================================================================
*/
    public function reject (Request $request){
        $remaining = $request->user()->payments()->first()->remaining;
        // dd($remaining);
         if($remaining >=500 ){
             return responseJson(0,'Failed , u can\'t reject any orders until the  remainng commissions are paid  ' ,$remaining );
         }
        $order = $request->user()->orders()->find($request->order_id);
        
        if( !$order ){
            return responseJson(0,'this order doesn\'t exist') ;
        }

        $order->update([
            'status'=>'rejected',
        ]);

        //finding the client that we will send him a notification 
        $client =Client::find($order->client->id);
        
        $notification = $client->notifications()->create([
            'title' => 'Client : Rejected Order ',
            'body' => ' Sorry ' .$order->client->name.' your order has been reject by ' .$request->user()->name ,
            'order_id'=>$order->id,
        ]);
        $body =$notification->body ;
        $title =$notification->title ;
        $tokens= $client->tokens()->where('token','!=','')->pluck('token')->toArray();
        $data = [
            'title'  => ' New mexiko ',
            'body'  => ' body '.$request->user()->name,
            'order_id' =>$order->id ,
        ];
        $send = notifyByFirebase($title,$body,$tokens,$data);
        
        return responseJson (1,' Success, Reject Order ',[
            'Order status' => 'Rejected',
            'Notification status' => 'Client',
            'ORDER'=>$order   
        ]);                                        
    }
    /**========================================================================================================================================= 
                                        List Of  The Accepted Orders 
* ========================================================================================================================================
*/

    public function accepted_orders(Request  $request){
       
        $order=  $request->user()->orders()->where('status','accepted')->get();

        if(!$order){
            return responseJson(0,'failed no orders for this restaurant');
        }    
        return responseJson(1,'success',$order);
    }


      /**========================================================================================================================================= 
                                                Confirm Delivery  
* ========================================================================================================================================
*/
public function confirm_delivery (Request $request){
    $order = $request->user()->orders()->find($request->order_id);
   
    if(!$order){
        return responseJson(0 , 'failed , there is no orders') ;
    }

    $order -> update([
        'status' => 'delivered'
    ]);

    return responseJson(1 , 'success , order is delivered to the client ', [
        'status'=>$order->status,
        'order' =>$order,
    ]);    
}

    /**========================================================================================================================================= 
                                       List of all rejected or delivered orders  
* ========================================================================================================================================
*/

    public function delivered_rejected_orders(Request $request){
        $order =$request->user()->orders()->whereIn('status',['delivered','rejected'])->get();

        if(!$order){
            return responseJson(0 , 'failed , there is no orders') ;
        }

        
        return responseJson(1,'success',$order);

    }

     /**========================================================================================================================================= 
                                       Commissions 
* ========================================================================================================================================
*/
    public function commission(Request $request){

        $restaurant_sales = $request->user()->orders()->where('status','delivered')->sum('cost') ;
        $app_commissions = $request->user()->orders()->where('status','delivered')->sum('commission') ;
        $restaurant_payments = $request->user()->payments()->pluck('paid')->first();
        $rest_of_commissions =   $app_commissions - $restaurant_payments ;

        $setting = Setting::first();
        $commission_statement =  $setting->commission_statement ;
        $elahly_bank =  $setting->elahly_bank ;
        $alrajhi_bank =  $setting->alrajhi_bank ;
        
        return responseJson(1, 'success', compact('restaurant_sales', 'app_commissions', 'restaurant_payments'
        , 'rest_of_commissions', 'commission_statement', 'elahly_bank', 'alrajhi_bank'));

    }

}
