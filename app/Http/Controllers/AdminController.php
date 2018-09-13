<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tags;
use App\Sizes;
use App\Promotion;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
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

    public function dashboard(){

      return view('admin.dashboard');
    }

    public function product(){

      return view('admin.product');
    }

    // Begin Category

    public function category(){

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

    // End Category

    // Begin Tag

    public function tag(){

      $tag = Tags::all();

      return view('admin.tag',['tag' => $tag]);
    }

    public function tag_add($request){
      // dd($request);

      $tag = new Tags;
      $tag->name = $request->name;
      $tag->status = $request->status;

      $tag->save();

      alert()->success('Success Add New Tag', 'Successfully');
      return redirect('admin/tag');
    }

    public function tag_edit($request){
      // dd($request);

      $tag = Tags::find($request->id);
      $tag->name = $request->name;
      $tag->status = $request->status;

      $tag->save();

      alert()->success('Success Change Tag', 'Successfully');
      return redirect('admin/tag');
    }

    public function tag_delete(Request $request){

      $tag = Tags::find($request->id);
      $tag->delete();

      Alert::success('Success Delete Tag', 'Success Message');
      return redirect('admin/tag');
    }

    // End Tag

    // Begin Size

    public function size(){

      $size = Sizes::all();

      return view('admin.size',['size' => $size]);
    }

    public function size_add($request){
      // dd($request);

      $size = new Sizes;
      $size->name = $request->name;
      $size->status = $request->status;

      $size->save();

      alert()->success('Success Add New Size', 'Successfully');
      return redirect('admin/size');
    }

    public function size_edit($request){
      // dd($request);

      $size = Sizes::find($request->id);
      $size->name = $request->name;
      $size->status = $request->status;

      $size->save();

      alert()->success('Success Change Size', 'Successfully');
      return redirect('admin/size');
    }

    public function size_delete($request){
      // dd($request);

      $size = Sizes::find($request->id);
      $size->delete();

      alert()->success('Success Delete Size', 'Successfully');
      return redirect('admin/size');
    }

    // End Size

    // Begin Promotion

    public function promotion(){

      $promotion = Promotion::all();

      return view('admin.promotion',['promotion' => $promotion]);
    }

    public function promotion_add($request){
      // dd($request);

      $promotion = new Promotion;
      $promotion->name = $request->name;
      $promotion->type = $request->type;
      $promotion->ammount = $request->ammount;
      $promotion->minimum_order = $request->minimum_order;
      $promotion->minimum_price = $request->minimum_price;
      $promotion->status = $request->status;

      $promotion->save();

      alert()->success('Success Add New Promotion', 'Successfully');
      return redirect('admin/promotion');
    }

    // End Promotion

    public function transaction(){

      return view('admin.transaction');
    }

    public function order(){

      return view('admin.order');
    }

    public function payment(){

      return view('admin.payment');
    }

    public function shipping(){

      return view('admin.shipping');
    }

    public function user(){

      return view('admin.user');
    }
}
