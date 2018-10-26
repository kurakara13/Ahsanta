<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){

      $category = Category::all();

      return view('admin.category',['category' => $category]);
    }

    public function category_add(Request $request){

      $category = new Category;
      $category->name = $request->name;
      $category->status = $request->status;

      $category->save();

      alert()->success('Success Add New Category', 'Successfully');
      return redirect('admin/category');
    }

    public function category_edit(Request $request){

      $category = Category::find($request->id);
      $category->name = $request->name;
      $category->status = $request->status;

      $category->save();
      Alert::success('Success Change Category', 'Success Message');
      return redirect('admin/category');
    }

    public function category_delete(Request $request){

      $category = Category::find($request->id);
      $category->delete();

      Alert::success('Success Delete Category', 'Success Message');
      return redirect('admin/category');
    }

}
