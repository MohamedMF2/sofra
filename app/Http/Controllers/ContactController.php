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

  
  public function destroy(Contact $contact)
  {
    $contact->delete();
    flash()->error(' A message Has been Deleted ');
    return back();
  }
  
}

?>