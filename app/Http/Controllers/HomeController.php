<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use App\Category;
use App\Tags;

class HomeController extends Controller
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
    public function index()
    {
        $product = Product::where('status', 'Show')->limit(12)->get();
        return view('home',['product' => $product]);
    }

    public function shop()
    {
        $product = Product::where('status', 'Show')->paginate(12);
        $category = Category::where('status', 'active')->get();
        $tags = Tags::where('status', 'active')->get();
        return view('shop',['product' => $product, 'category' => $category, 'tags' => $tags]);
    }

    public function shop_detail($id)
    {
        $productID = substr($id,0,-10);

        $productRelated = Product::where('status', 'Show')->limit(12)->get();
        $product = Product::find($productID);
        $product->view = $product->view+1;

        // $product->save();

        $productImages = ProductImages::where('id_product', $productID)->where('status', 'Show')->get();

        // dd($size);
        return view('shop-detail', ['product' => $product, 'productImages' => $productImages, 'productRelated' => $productRelated]);
    }

    public function blog()
    {
        return view('blog');
    }

    public function blog_detail()
    {
        return view('blog-detail');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function cart()
    {
        return view('cart');
    }
}
