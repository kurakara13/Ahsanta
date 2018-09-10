<?php

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

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('dashboard');
