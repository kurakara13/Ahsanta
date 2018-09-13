<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
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

    public function dashboard(){

      return view('admin.dashboard');
    }

    public function product(){

      return view('admin.product');
    }

    public function category(){

      return view('admin.category');
    }

    public function tag(){

      return view('admin.tag');
    }

    public function size(){

      return view('admin.size');
    }

    public function promotion(){

      return view('admin.promotion');
    }

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
