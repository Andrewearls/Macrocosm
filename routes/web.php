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
Route::post('shopping/clear-item', 'ShoppingController@clearItem')->name('clearItem');
Route::post('shopping/checkout', 'ShoppingController@checkout')->name('checkout');
Route::get('/shopping/cart', 'ShoppingController@cart')->name('cart');
Route::get('shopping/checkout', 'ShoppingController@checkout')->name('checkout');
//shopping page navigation
Route::get('/shopping/', 'ShoppingController@index');
Route::get('/shopping/{page}', 'ShoppingController@index');
Route::get('/shopping/page/{page}', 'ShoppingController@index')->name('shopping');


//training 
Route::get('/training/', 'TrainingController@index')->name('training');
Route::get('/training/class/{id}', 'TrainingController@classDescription')->name('classDescription');

//Badges
Route::get('/badges/', 'BadgesController@index')->name('badges');
Route::get('/badge/{id}', 'BadgesController@badgeDescription')->name('badgeDescription');

//Expeditions
Route::get('/expeditions/', 'ExpeditionsController@index')->name('expeditions');
Route::get('/expedition/{id}', 'ExpeditionsController@expeditionDescription')->name('expeditionDescription');


//CMS
Route::middleware(['position:developer'])->group(function() {
	Route::get('/cms', 'DeveloperController@index')->name('cms');
	Route::post('/cms/new', 'DeveloperController@formSubmit')->name('cmsNew');
	Route::post('/cms/update/{id}')->name('cmsUpdate');

	//Shopping CMS
	Route::get('/cms/new/shopping/item', 'ShoppingController@newItem')->name('newShoppingItem');
	Route::post('/cms/new/shopping/item', 'ShoppingController@createItem');
	Route::get('/cms/edit/shopping/item/{id}', 'ShoppingController@editItem')->name('editShoppingItem');
	Route::post('/cms/edit/shopping/item/{id}', 'ShoppingController@updateItem');
	Route::get('/cms/delete/shopping/item/{id}', 'ShoppingController@deleteItem')->name('deleteShoppingItem');

	//Training CMS
	Route::get('/cms/new/class/item', 'TrainingController@newItem')->name('newClassItem');
	Route::post('/cms/new/class/item', 'TrainingController@createItem');
	Route::get('/cms/edit/class/item/{id}', 'TrainingController@editItem')->name('editClassItem');
	Route::post('/cms/edit/class/item/{id}', 'TrainingController@updateItem');
	Route::get('/cms/delete/class/item/{id}', 'TrainingController@deleteItem')->name('deleteClassItem');

	//Badges CMS
	Route::get('/cms/new/badge', 'BadgesController@newBadge')->name('newBadge');
	Route::post('/cms/new/badge', 'BadgesController@createBadge');
	Route::get('/cms/edit/badge/{id}', 'BadgesController@editBadge')->name('editBadge');
	Route::post('/cms/edit/badge/{id}', 'BadgesController@updateBadge');
	Route::get('/cms/delete/badge/{id}', 'BadgesController@deleteBadge')->name('deleteBadge');

	//Expeditions CMS
	Route::get('/cms/new/expedition', 'ExpeditionsController@newExpedition')->name('newExpedition');
	Route::post('/cms/new/expedition', 'ExpeditionsController@createExpedition');
	Route::get('/cms/edit/expedition/{id}', 'ExpeditionsController@editExpedition')->name('editExpedition');
	Route::post('/cms/edit/expedition/{id}', 'ExpeditionsController@updateExpedition');
	Route::get('/cms/delete/expedition/{id}', 'ExpeditionsController@deleteExpedition')->name('deleteExpedition');

});