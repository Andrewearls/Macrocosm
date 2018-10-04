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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//shopping items
Route::get('/shopping/item/{id}', 'ShoppingController@inventoryDescription')->name('itemDescription');
//shopping add to cart
Route::post('shopping/add-to-cart', 'ShoppingController@addToCart')->name('addToCart');
Route::post('shopping/remove-from-cart', 'ShoppingController@removeFromCart')->name('removeFromCart');
Route::post('shopping/checkout', 'ShoppingController@checkout')->name('checkout');
Route::get('/shopping/cart', 'ShoppingController@cart')->name('cart');
Route::get('shopping/checkout', 'ShoppingController@checkout')->name('checkout');
//shopping page navigation
Route::get('/shopping/', 'ShoppingController@index');
Route::get('/shopping/{page}', 'ShoppingController@index');
Route::get('/shopping/page/{page}', 'ShoppingController@index')->name('shopping');


//training 
Route::get('/training/', 'TrainingController@index')->name('training');