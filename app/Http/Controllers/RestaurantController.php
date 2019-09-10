<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
class RestaurantController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $restaurants=Restaurant::where(function ($query) use ($request){
        
      if($request->has('search')){

          $query->whereHas('categories',function ($categories) use($request){
              $categories->where('name','like','%'.$request->search.'%');
                          
          });
          $query->orWhereHas('district',function ($district) use($request){
            $district->where('name','like','%'.$request->search.'%')
                     ->orWhereHas('city',function ($city) use($request){
                         $city->where('name','like','%'.$request->search.'%');
          });
        });
       

          $query->orWhere(function ($query) use($request){
            $query->where('name','like','%'.$request->search.'%')
                  ->orWhere('image','like','%'.$request->search.'%')
                  ->orWhere('phone','like','%'.$request->search.'%')
                  ->orWhere('email','like','%'.$request->search.'%');
        });
      }
    })->latest()->paginate(25);
    return view('dashboard.restaurants.index',compact('restaurants'));
  
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Restaurant $restaurant)
  {
    $products = $restaurant->products()->latest()->paginate(1);
    return view('dashboard.restaurants.show',compact('restaurant','products'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Restaurant $restaurant)
  {
    $restaurant->delete();
    flash()->error(' Restaurant ('.$restaurant->name.') has been deleted');
    return back();
  }
  public function activate($id)
    {
        $restaurant = restaurant::findOrFail($id);
        $restaurant->activated = 1;
        $restaurant->save();
        flash()->success('تم التفعيل');
        return back();
    }
    public function deActivate($id)
    {
        $restaurant = restaurant::findOrFail($id);
        $restaurant->activated = 0;
        $restaurant->save();
        flash()->success('تم الإيقاف');
        return back();
    }
  
}

?>