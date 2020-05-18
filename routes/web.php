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

Route::get('/', function () {
	$products = App\Product::with('category')->get();
    return view('index',compact('products','cartCount'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-to-cart', 'CartController@addToCart');
Route::get('checkout', 'CartController@checkout');
Route::get('search', 'CartController@search');
