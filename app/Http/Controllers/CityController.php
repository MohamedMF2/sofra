<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City ;
class CityController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $cities = DB::table('cities')
    ->orderBy('id', 'asc')->paginate();

    return view('dashboard.cities.index',compact('cities'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('dashboard.cities.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $data=request()->validate([
      'name'=>'required|min:3'
    ]);
   
    City::create($data);
    flash()->success('A New City ( '. $request->name.' ) has been added successfully ');
    return redirect(route('city.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(City $city)
  {
    return view ('dashboard.cities.edit',compact('city'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request ,City $city)
  {
      $city ->update($request->all());
      flash()->success('edited successfully');
      return redirect(route('city.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(City $city)
  {
    $city->delete();
    flash()->error('The City ( '. $city->name.' ) has been deleted successfully ');
    return redirect(route('city.index'));
  }
  
}

?>