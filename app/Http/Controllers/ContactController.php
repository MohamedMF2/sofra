<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact ;
class ContactController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $contacts=Contact::where(function ($query) use ($request){
        
      if($request->has('search')){
            $query->where('name','like','%'.$request->search.'%')
                  ->orWhere('email','like','%'.$request->search.'%')
                  ->orWhere('phone','like','%'.$request->search.'%')
                  ->orWhere('email','like','%'.$request->search.'%')
                  ->orWhere('type','like','%'.$request->search.'%')
                  ->orWhere('message','like','%'.$request->search.'%');
        
      }
    })->latest()->paginate();
    // $contacts = Contact::all();
    return view('dashboard.contacts.index',compact('contacts'));

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
  public function show($id)
  {
    
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
  public function destroy(Contact $contact)
  {
    $contact->delete();
    flash()->error(' A message Has been Deleted ');
    return back();
  }
  
}

?>