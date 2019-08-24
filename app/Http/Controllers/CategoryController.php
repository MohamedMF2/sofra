<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category ;
class CategoryController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $categories =Category::all();
    return view('dashboard.categories.index',compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('dashboard.categories.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    Category::create($request->all());
    flash()->success('A New Category has been created successfully');
    return redirect(route('category.index'));

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
  public function edit(Category $category)
  {
    return view ('dashboard.categories.edit',compact('category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request , Category $category)
  {
    $category->update($request->all());
    flash()->success(' the category '.$category->name.' has been updated successfully ');
    return redirect(route('category.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Category $category)
  {
    $category ->delete();
    flash()->error('this category '. $category->name .' has been deleted');
    return redirect(route('category.index'));
  }
  
}

?>