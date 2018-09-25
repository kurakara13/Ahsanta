<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use App\Category;
use App\Tags;
use App\Promotion;

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
      }else {
        $minOrder = null;
        $minPrice = null;
      }
      $session = array('weight' => $product->weight,
                       'stock' => $product->stock,
                       'product' => $request->id,
                       'promo' => null,
                       'promo_type' => null,
                       'min_qty' => $minOrder,
                       'min_price' => $minPrice,
                       'old_price' => null,
                       'price' => null,
                       'qty' => 1,
                       'color' => null,
                       'size' => null,
                       'img' => null
                     );
      return $session;
    }

    public function empty_cart(){

    }

    public function empty_cart_item(){

    }
}
