<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tags;
use App\Sizes;
use App\Colors;
use App\Promotion;
use App\Product;
use App\ProductImages;
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

    // Begin Product

    public function product(){

      $product = Product::all();

      return view('admin.product',['product' => $product]);
    }

    public function product_add_form(){

      $promotion = Promotion::where('status', 'active')->get();
      $category = Category::where('status', 'active')->get();
      $tag = Tags::where('status', 'active')->get();
      $size = Sizes::where('status', 'active')->get();
      $color = Colors::where('status', 'active')->get();

      return view('admin.product-add',['promotion' => $promotion, 'category' => $category, 'tag' => $tag, 'size' => $size, 'color' => $color]);
    }

    public function product_add(Request $request){
      if($request->promo == "null"){
        $promo = null;
      }else {
        $promo = $request->promo;
      }
      $product = new Product;
      $product->name = $request->name;
      $product->price = $request->price;
      $product->id_promotion = $promo;
      $product->weight = $request->weight;
      $product->stock = $request->stok;
      $product->color = json_encode($request->color);
      $product->size = json_encode($request->size);
      $product->description = $request->description;
      $product->status = "Show";

      $product->save();
      // dd($promo);

      if($request->userprofile_picture != null){
        $imageCount = count($request->userprofile_picture);
        for ($i=0; $i < $imageCount; $i++) {
          $filename = time().$i.$request->userprofile_picture[$i]->getClientOriginalName();
          $request->userprofile_picture[$i]->move(public_path('images/product/'), $filename);

          $productImages = new ProductImages;
          $productImages->id_product = $product->id;
          $productImages->name = $filename;
          $productImages->status = 'Show';

          $productImages->save();

        }
      }

      alert()->success('Success Add New Product', 'Successfully');
      return redirect('admin/product');
    }

    public function product_editProduct(Request $request){
      // dd($request);
      if($request->promo == "null"){
        $promo = null;
      }else {
        $promo = $request->promo;
      }
      $product = Product::find($request->id);
      $product->name = $request->name;
      $product->price = $request->price;
      $product->id_promotion = $promo;
      $product->weight = $request->weight;
      $product->stock = $request->stok;
      $product->category = json_encode($request->category);
      $product->tags = json_encode($request->tags);
      $product->color = json_encode($request->color);
      $product->size = json_encode($request->size);
      $product->description = $request->description;
      $product->status = $request->status;

      $product->save();

      alert()->success('Success Edit Detail Product', 'Successfully');
      return redirect('admin/product/edit/'.$request->id);
    }

    public function product_edit($id){
      // dd($request);
      $product = Product::find($id);
      $productImages = ProductImages::where('id_product', $id)->get();
      $promotion = Promotion::where('status', 'active')->get();
      $category = Category::where('status', 'active')->get();
      $tag = Tags::where('status', 'active')->get();
      $size = Sizes::where('status', 'active')->get();
      $color = Colors::where('status', 'active')->get();
      $tagsSelect = array();
      $categorySelect = array();
      $i=0;
      foreach ($tag as $key) {
        foreach (json_decode($product->tags) as $keyTags) {
          $cek = false;
          if($keyTags == $key->id){
            $cek = true;
            break;
          }else {
            $cek = false;
          }
        }
        if($cek == true){
          $tagsSelect[] = array('id' => $key->id, 'text' => $key->name, 'selected' => true);
        }else {
          $tagsSelect[] = array('id' => $key->id, 'text' => $key->name);
        }
        $i++;
      }

      foreach ($category as $key) {
        foreach (json_decode($product->category) as $keyCategory) {
          $cek = false;
          if($keyCategory == $key->id){
            $cek = true;
            break;
          }else {
            $cek = false;
          }
        }
        if($cek == true){
          $categorySelect[] = array('id' => $key->id, 'text' => $key->name, 'selected' => true);
        }else {
          $categorySelect[] = array('id' => $key->id, 'text' => $key->name);
        }
        $i++;
      }
      // dd(json_decode($product->color));


      return view('admin.product-edit',['categorySelect' => $categorySelect, 'tagsSelect' => $tagsSelect, 'product' => $product, 'productImages' => $productImages, 'promotion' => $promotion, 'size' => $size, 'color' => $color]);
    }

    public function product_imageEdit(Request $request){

      // dd($request);
      $productImages = ProductImages::find($request->id);

      if($request->userprofile_picture != null){
      $i = substr($request->img_change,10,1);
      unlink(public_path('images\product\\'.$request->img_change));
      $filename = time().$i.$request->userprofile_picture->getClientOriginalName();
      $request->userprofile_picture->move(public_path('images/product/'), $filename);

      $productImages->name = $filename;
      }
      $productImages->status = $request->status;

      $productImages->save();

      alert()->success('Success Change Image', 'Successfully');
      return redirect('admin/product/edit/'.$request->id_product);
    }

    public function product_cover(Request $request){

      $productImagesData = ProductImages::where('id_product', $request->id_product)->get();
      // dd($productImagesData);


      foreach ($productImagesData as $key) {
        $productImages = ProductImages::find($key->id);

        if($key->id == $request->id){
          $productImages->cover = 1;
        }else {
          $productImages->cover = 0;
        }
        $productImages->save();
      }

      Alert::success('Success Change Product Image Cover', 'Success Message');
      return redirect('admin/product/edit/image/'.$request->id_product);
    }

    // End Proudct

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

    // Begin Color

    public function color(){

      $color = Colors::all();

      return view('admin.color',['color' => $color]);
    }

    public function color_add($request){
      // dd($request);

      $color = new Colors;
      $color->name = $request->name;
      $color->status = $request->status;

      $color->save();

      alert()->success('Success Add New Color', 'Successfully');
      return redirect('admin/color');
    }

    public function color_edit($request){
      // dd($request);

      $color = Colors::find($request->id);
      $color->name = $request->name;
      $color->status = $request->status;

      $color->save();

      alert()->success('Success Change Color', 'Successfully');
      return redirect('admin/color');
    }

    public function color_delete($request){
      // dd($request);

      $color = Colors::find($request->id);
      $color->delete();

      alert()->success('Success Delete Color', 'Successfully');
      return redirect('admin/color');
    }

    // End Color

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

    public function promotion_edit($request){
      // dd($request);

      $promotion = Promotion::find($request->id);
      $promotion->name = $request->name;
      $promotion->type = $request->type;
      $promotion->ammount = $request->ammount;
      $promotion->minimum_order = $request->minimum_order;
      $promotion->minimum_price = $request->minimum_price;
      $promotion->status = $request->status;

      $promotion->save();

      alert()->success('Success Change Promotion', 'Successfully');
      return redirect('admin/promotion');
    }

    public function promotion_delete($request){

      $promotion = Promotion::find($request->id);
      if($promotion->product_use != 0){
        alert()->warning('Promotion Contain '.$promotion->product_use.' Product', 'Warning');
      }else {
        $promotion->delete();
        alert()->success('Success Delete Promotion', 'Successfully');
      }

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
