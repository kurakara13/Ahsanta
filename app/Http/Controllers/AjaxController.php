<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use App\Category;
use App\Tags;
use App\Promotion;
use Session;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_cart(Request $request)
    {
      $product = Product::select('weight', 'stock', 'id_promotion')->find($request->id);
      if($product->id_promotion != null){
        $promotion = Promotion::find($product->id_promotion);
        $minOrder = $promotion->minimum_order;
        $minPrice = $promotion->minimum_price;
        $promo = $promotion->id;
        $promoType = $promotion->type;
      }else {
        $minOrder = null;
        $minPrice = null;
        $promo = null;
        $promoType = null;
      }
      $session = array('weight' => $product->weight,
                       'stock' => $product->stock,
                       'product' => $request->id,
                       'promo' => $promo,
                       'promo_type' => $promoType,
                       'min_qty' => $minOrder,
                       'min_price' => $minPrice,
                       'old_price' => null,
                       'price' => null,
                       'qty' => 1,
                       'color' => null,
                       'size' => null,
                       'img' => null
                     );
      if(Session::has('cart')){
        foreach(Session::get('cart') as $key){
          $cek = false;
          if($key['product'] == $request->id){
            $cek = true;
            break;
          }else {
            $cek = false;
          }
        }
        if($cek == true){
          return ['message' => 'Produk Sudah Ada di Cart', 'type' => 'warning'];
        }else {
          Session::push('cart', $session);
          return ['message' => 'Produk Sudah di Tambahkan ke Cart', 'type' => 'success'];
        }
      }else {
        Session::put('cart', [$session]);
        return ['message' => 'Produk Sudah di Tambahkan ke Cart', 'type' => 'success'];
      }
    }

    public function empty_cart(){
      Session::forget('cart');
      return ['message' => 'Cart Sudah di Kosongkan', 'type' => 'warning'];
    }

    public function empty_cart_item(){

    }
}
