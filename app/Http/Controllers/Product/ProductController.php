<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Tags;
use App\Sizes;
use App\Colors;
use App\Promotion;
use App\Product;
use App\ProductImages;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
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

      if(isset($request->tags)){
        $tags = json_encode($request->tags);
      }else {
        $tags = null;
      }

      if(isset($request->category)){
        $category = json_encode($request->category);
      }else {
        $category = null;
      }

      if(isset($request->color)){
        $color = json_encode($request->color);
      }else {
        $color = null;
      }

      if(isset($request->size)){
        $size = json_encode($request->size);
      }else {
        $size = null;
      }

      $product = Product::find($request->id);
      $product->name = $request->name;
      $product->price = $request->price;
      $product->id_promotion = $promo;
      $product->weight = $request->weight;
      $product->stock = $request->stok;
      $product->category = $category;
      $product->tags = $tags;
      $product->color = $color;
      $product->size = $size;
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
        if($product->tags != null){
          foreach (json_decode($product->tags) as $keyTags) {
            $cek = false;
            if($keyTags == $key->id){
              $cek = true;
              break;
            }else {
              $cek = false;
            }
          }
        }else {
          $cek = false;
        }
        if($cek == true){
          $tagsSelect[] = array('id' => $key->id, 'text' => $key->name, 'selected' => true);
        }else {
          $tagsSelect[] = array('id' => $key->id, 'text' => $key->name);
        }
        $i++;
      }

      foreach ($category as $key) {
        if($product->category != null){
          foreach (json_decode($product->category) as $keyCategory) {
            $cek = false;
            if($keyCategory == $key->id){
              $cek = true;
              break;
            }else {
              $cek = false;
            }
          }
        }else {
          $cek = false;
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

}
