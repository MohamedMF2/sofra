<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City ;
use App\District ;

class CityDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $city_id)
    {
        $city = City::find($city_id);
        $districts =$city->districts()->paginate(10);
        return view ('dashboard.districts.index',compact('city_id','districts','city'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($city_id)
    {
        $city = City::find($city_id);
        
        return view('dashboard.districts.create',compact('city_id','city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($city_id ,Request $request )
    {
       $district = District::create($request->all() + ['city_id' => $city_id]);
        flash()->success(' A new District '. $district->name .' has been created successfully ');
        return redirect(route('city.district.index', $city_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($city_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $city_id ,District $district )
    {
        return view('dashboard.districts.edit', compact('city_id', 'district'));  
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $city_id,Request $request,District $district )
    {
        $district->update($request->all());
        return redirect(route('city.district.index', $city_id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($city_id,District $district)
    {
        $district->delete();
        flash()->error('the district '. $district->name .' has been deleted ');
        return redirect(route('city.district.index',$city_id));
    }
}
