<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant ;
use App\Order ;
use App\Product ;
use App\Setting ;
use App\OrderProduct;

class OrderController extends Controller
{ 
    /**========================================================================================================================================= 
                                            Create an Order
* ========================================================================================================================================
*/
    public function new_order(Request $request){
       $validator=Validator::make($request -> all(),[
            'restaurant_id'=>'required|exists:restaurants,id',
            'products.*.product_id'=>'required|exists:products,id',
            'products.*.quantity'=>'required',
            'notes'=>'required',
            'address'=>'required',
       ]);

     if ($validator->fails()){
           return responseJson(0,$validator->errors()->first(),$validator->errors());
       }

       $restaurant =Restaurant::find($request->restaurant_id) ;
     //  dd($restaurant);
       
       if($restaurant->status=="0"){
         return responseJson(0,'this restaurant is closed');
       }

       $order =$request->user()->orders()->create([
            'restaurant_id' => $request->restaurant_id,
            'notes'=>$request->notes,
            'address' =>$request->address,
            'state'=>'pending',
            'payment'=>'cash',
            'phone'=>$request->phone,
       //    

       ]);

       $cost = 0 ;
       $delivery = $restaurant->delivery;
        foreach($request->products as $p){ 
            $product = Product::find($p['product_id']);
            $readyProduct=[
                $p['product_id'] =>[
                    'quantity' => $p['quantity'],
                    'price' => $product->price,
                    'special_order' => $p['special_order'] ,
                ]
            ];


            $order ->products()->attach($readyProduct);
            $cost += $product->price * $p['quantity'];
        } 
        if ($cost >= $restaurant->minimum_charge){      
            $total = $cost + $delivery;
            $setting_commission = Setting::find(1)->commission;
            $commission = $setting_commission * $cost;
            $net =$total - $commission ;

            $update = $order->update([
                'cost'=>$cost,
                'total'=>$total,
               // 'delivery'=>$delivery,
               // 'net' =>$net,
                'commission'=>$commission,

            ]);
        } else{
            return responseJson(0 ,'the order is less than the minimum charge of the restaurant ');
        } 
        // create notification
        $notification =  $restaurant->notifications()->create([
            'title'  => ' Restaurant : New Order ',
            'body'  => ' You have New Order From Client '.$request->user()->name,
            'order_id' =>$order->id ,
        ]);
            

        $tokens = $restaurant ->tokens()->where('token','!=','')->pluck('token')->toArray();
        $title = $notification->title ; 
        $body = $notification->body ;
        $data = [
            'title'  => ' New Order ',
            'body'  => ' You have New Order From Client '.$request->user()->name,
            'order_id' =>$order->id ,
        ];
        $send = notifyByFirebase($title,$body,$tokens,$data);
       

        $model =[
            'order' =>$order->fresh()->load('products')
        ];
        return responseJson(1 ,'تم الطلب بنجاح',$model);
    }
/**========================================================================================================================================= 
                                      order details
* ========================================================================================================================================
*/
    public function order_datails(Request $request){
        $order = $request->user()->orders()->where('status','pending')->with('products')->get();
        return responseJson(1,'order details',$order);
    }
/**========================================================================================================================================= 
                                         List Of Accepted Orders     
* ========================================================================================================================================
*/
   public function accepted_orders (Request $request){
        $order = $request->user()->orders()->where('status','accepted')->get();
        
        if(!$order){
            return resposnseJson(0 , 'failed , there is no orders for this client') ;
        }
        return responseJson(1,' success , the orders of '.$request->user()->name , $order);
   }

   /**========================================================================================================================================= 
                                         Accept an Order     
* ========================================================================================================================================
*/
public function accept (Request $request){
    $order = $request->user()->orders()->find($request->order_id);;
    
    if(!$order){
        return responseJson(0 , 'failed , there is no orders for this client') ;
    }
    $order->update([
        'status' => 'delivered',
    ]);

    // find the restaurant that will receive the notification 

    $restaurant = Restaurant::find($order->restaurant->id);
   // dd($restaurant);
      // create notification 
      $notification =  $restaurant->notifications()->create([
        'title'  => ' Restaurant : Delivered Order   ',
        'body'  => ' Your Order has been delivered and accepted by  '.$request->user()->name,
        'order_id' =>$order->id ,
    ]);
        
    // notification parameters
    $tokens = $restaurant ->tokens()->where('token','!=','')->pluck('token')->toArray();
    $title = $notification->title ; 
    $body = $notification->body ;
    $data = [
        'title'  => ' Restaurant : Delivered Order   ',
        'body'  => ' Your Order has been delivered and accepted by  '.$request->user()->name,
        'order_id' =>$order->id ,
    ];
    $send = notifyByFirebase($title,$body,$tokens,$data);
    return responseJson (1,' Success, delivered Order ',[
        'Order status' => 'delivered',
        'Notification status' => 'Restaurant',
        'ORDER'=>$order   
    ]);               
    }
/**========================================================================================================================================= 
                                         decline an Order     
* ========================================================================================================================================
*/
    public function decline (Request $request){
        $order = $request->user()->orders()->find($request->order_id);
        
        if(!$order){
            return responseJson(0 , 'failed , there is no orders for this client') ;
        }
        $order->update([
            'status' => 'declined',
        ]);

        // find the restaurant that will receive the notification 

        $restaurant = Restaurant::find($order->restaurant->id);
    // dd($restaurant);
        // create notification 
        $notification =  $restaurant->notifications()->create([
            'title'  => ' Restaurant : declined Order   ',
            'body'  => ' Your Order has been declined by  '.$request->user()->name,
            'order_id' =>$order->id ,
        ]);
            
        // notification parameters
        $tokens = $restaurant ->tokens()->where('token','!=','')->pluck('token')->toArray();
        $title = $notification->title ; 
        $body = $notification->body ;
        $data = [
            'title'  => ' Restaurant : declined Order   ',
            'body'  => ' Your Order has been declined by  '.$request->user()->name,
            'order_id' =>$order->id ,
        ];
        $send = notifyByFirebase($title,$body,$tokens,$data);
        return responseJson (1,' Success, declined Order ',[
            'Order status' => 'declined',
            'Notification status' => 'Restaurant',
            'ORDER'=>$order   
        ]);               
        }

/**========================================================================================================================================= 
                                            List of Previous orders   
* ========================================================================================================================================
*/
        
        public function previous_orders(Request $request){
            $order = $request->user()->orders()->where('status','delivered')->get();
       //     dd($order);
            if(!$order){
                return responseJson(0 , 'failed , there is no previous orders for this client') ;
            }
            return responseJson (1,' Success, client  Previous Orders ',[
                ' Order status ' => 'previous delivered',
                ' ORDER '=>$order   
            ]);   
        }


}

