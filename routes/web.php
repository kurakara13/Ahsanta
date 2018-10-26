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

//Ajax
Route::post('/add/cart', 'AjaxController@add_cart')->name('add.cart');
Route::post('/delete/cart', 'AjaxController@empty_cart')->name('empty.cart');



Route::prefix('admin')->group(function() {
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::namespace('Admin')->group(function () {
    Route::get('/', 'AdminController@dashboard')->name('admin.home');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::post('/{previx}/{action}', function($prefix, $action, Request $request){
      $app = app();
      $ctr = $app->make('\App\Http\Controllers\AdminController');
      return $ctr->callAction("{$prefix}_{$action}", [$request]);
    });
  });

  Route::namespace('Product')->group(function () {
    Route::get('/product', 'ProductController@index')->name('admin.product');
    Route::get('/product/add', 'ProductController@product_add_form')->name('admin.product.add.form');
    Route::get('/product/edit/{id}', 'ProductController@product_edit')->name('admin.product.edit');
    Route::get('/product/detail/{id}', 'ProductController@product_detail')->name('admin.product.detail');
  });

  Route::namespace('Category')->group(function () {
    Route::get('/category', 'CategoryController@index')->name('admin. category');
  });

  Route::namespace('Tag')->group(function () {
    Route::get('/tag', 'TagController@index')->name('admin.tag');
  });

  Route::namespace('Size')->group(function () {
    Route::get('/size', 'SizeController@index')->name('admin.size');
  });

  Route::namespace('Color')->group(function () {
    Route::resource('color', 'ColorController');
  });

  Route::namespace('Promotion')->group(function () {
    Route::get('/promotion', 'PromotionController@index')->name('admin.promotion');
  });

  Route::namespace('Transaction')->group(function () {
    Route::get('/transaction', 'TransactionController@index')->name('admin.transaction');
  });

  Route::namespace('Order')->group(function () {
    Route::get('/order', 'OrderController@index')->name('admin.order');
  });

  Route::namespace('Shipping')->group(function () {
    Route::get('/shipping', 'ShippingController@index')->name('admin.shipping');
  });

  Route::namespace('Payment')->group(function () {
    Route::get('/payment', 'PaymentController@index')->name('admin.payment');
  });

  Route::namespace('User')->group(function () {
    Route::get('/user', 'UserController@index')->name('admin.user');
  });

});
