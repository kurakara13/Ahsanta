<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
        $product = Product::where('status', 'Show')->get();
        return view('home',['product' => $product]);
    }

    public function shop()
    {
        return view('shop');
    }

    public function shop_detail($id)
    {
        return view('shop-detail');
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
