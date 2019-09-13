<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order ;
class OrderController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $orders=Order::where(function ($query) use ($request){
        
      if($request->has('search')){

          $query->whereHas('client',function ($client) use($request){
              $client->where('name','like','%'.$request->search.'%');
                          
          });
          $query->orWhereHas('restaurant',function ($restaurant) use($request){
            $restaurant->where('name','like','%'.$request->search.'%');
                        
        });
       

          $query->orWhere(function ($query) use($request){
            $query->where('status','like','%'.$request->search.'%')
                  ->orWhere('payment','like','%'.$request->search.'%')
                  ->orWhere('phone','like','%'.$request->search.'%')
                  ->orWhere('address','like','%'.$request->search.'%')
                  ->orWhere('total','<=',$request->search);
        });
      }
    })->latest()->paginate(25);
    return view('dashboard.orders.index',compact('orders'));
  
  }

  

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Order $order)
  {

    $products =$order->products()->paginate();
    return view('dashboard.orders.show',compact('products','order'));
  }

 

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Order $order)
  {
    $order->delete();
    flash()->error($order->client->name.' order has been deleted ');
    return back();
  }
  
}

?>