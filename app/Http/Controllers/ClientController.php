<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client ;
class ClientController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
  $clients=Client::where(function ($query) use ($request){
        
    if($request->has('search')){

        $query->orWhereHas('district',function ($district) use($request){
          $district->where('name','like','%'.$request->search.'%')
                   ->orWhereHas('city',function ($city) use($request){
                       $city->where('name','like','%'.$request->search.'%');
        });
      });
     

        $query->orWhere(function ($query) use($request){
          $query->where('name','like','%'.$request->search.'%')
                // ->orWhere('image','like','%'.$request->search.'%')
                ->orWhere('phone','like','%'.$request->search.'%')
                ->orWhere('email','like','%'.$request->search.'%');
      });
    }
  })->latest()->paginate(25);
  return view('dashboard.clients.index',compact('clients'));

}

  

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Client $client)
  {
    $client ->delete();
    flash()->error('Client '.$client->name.' is deleted');
    return back();
  }
  public function activate($id)
  {
      $client = Client::findOrFail($id);
      $client->activated = 1;
      $client->save();
      flash()->success('تم التفعيل');
      return back();
  }
  public function deActivate($id)
  {
      $client = Client::findOrFail($id);
      $client->activated = 0;
      $client->save();
      flash()->success('تم الإيقاف');
      return back();
  }

  
}

?>