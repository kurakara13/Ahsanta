<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/shop/detail/{id}', 'HomeController@shop_detail')->name('shop_detail');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blog/detail/{id}', 'HomeController@blog_detail')->name('blog_detail');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/cart', 'HomeController@cart')->name('cart');


Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@dashboard')->name('admin.home');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/product', 'AdminController@product')->name('product');
    Route::get('/product/add', 'AdminController@product_add_form')->name('product.add.form');
    Route::get('/category', 'AdminController@category')->name('category');
    Route::get('/tag', 'AdminController@tag')->name('tag');
    Route::get('/size', 'AdminController@size')->name('size');
    Route::get('/color', 'AdminController@color')->name('color');
    Route::get('/promotion', 'AdminController@promotion')->name('promotion');
    Route::get('/transaction', 'AdminController@transaction')->name('transaction');
    Route::get('/order', 'AdminController@order')->name('order');
    Route::get('/payment', 'AdminController@payment')->name('payment');
    Route::get('/shipping', 'AdminController@shipping')->name('shipping');
    Route::get('/user', 'AdminController@user')->name('user');
    Route::post('/{previx}/{action}', function($prefix, $action, Request $request){
      $app = app();
      $ctr = $app->make('\App\Http\Controllers\AdminController');
      return $ctr->callAction("{$prefix}_{$action}", [$request]);
    });
  });
