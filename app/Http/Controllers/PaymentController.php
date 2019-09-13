<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Payment ;
use App\Restaurant ;
use App\Order ;
class PaymentController extends Controller 
{

  
  public function create()
  {
    $restaurants = Restaurant::all();
    return view ('dashboard.payments.create',compact('restaurants'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $data= request()->validate([
        'restaurant_id'=>'required',
        'paid' =>  'required'
      ]);
      
     $payment = Payment::create($request->all());
return back();
  }

 
}

?>