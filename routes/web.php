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
//Auth::routes(['verify' => true]);

//Authenticated Users Only
Route::middleware('auth')->group(function() {

	// Route::get('/', 'HomeController@index')->name('welcome');
	Route::get('/home', 'HomeController@index')->name('home');

	//shopping items
	Route::get('/shopping/item/{id}', 'ShoppingController@inventoryDescription')->name('itemDescription');
	//shopping add to cart
	Route::post('shopping/add-to-cart', 'ShoppingController@addToCart')->name('addToCart');
	Route::post('shopping/remove-from-cart', 'ShoppingController@removeFromCart')->name('removeFromCart');
	Route::post('shopping/clear-item', 'ShoppingController@clearItem')->name('clearItem');
	Route::post('shopping/checkout', 'ShoppingController@checkout');
	Route::get('/shopping/cart', 'ShoppingController@cart')->name('cart');
	Route::get('shopping/checkout', 'ShoppingController@checkout')->name('checkout');
	Route::post('/shopping/charge', 'ShoppingController@charge')->name('charge');
	//shopping page navigation
	Route::get('/shopping/', 'ShoppingController@index')->name('shopping');

	Route::get('/payment/method', 'StripeController@index')->name('paymentMethod');


	//training 
	Route::get('/training/', 'TrainingController@index')->name('training');
	Route::get('/training/class/{id}', 'TrainingController@classDescription')->name('classDescription');
	Route::get('/training/class/{id}/enroll', 'TrainingController@enroll')->name('enroll');
	Route::get('/training/class/{id}/unenroll', 'TrainingController@unenroll')->name('unenroll');

	//Badges
	Route::get('/badges/', 'BadgesController@index')->name('badges');
	Route::get('/badge/{id}', 'BadgesController@badgeDescription')->name('badgeDescription');
	Route::get('/badges/test', 'BadgesController@test')->name('badgesTest');
	Route::get('/badge/{id}/claim', 'BadgesController@claim')->name('claimBadge');

	//Expeditions
	Route::get('/expeditions/', 'ExpeditionsController@index')->name('expeditions');
	Route::get('/expedition/{id}', 'ExpeditionsController@expeditionDescription')->name('expeditionDescription');

	//Requirements
	Route::get('/requirements/test', 'RequirementController@test');
	Route::get('/requirements/{id}', 'RequirementController@index')->name('listRequirements');
	Route::post('/requirements/activate', 'RequirementController@activateRequirement')->name('activateRequirement');
	Route::post('/requirements/deactivate', 'RequirementController@deactivateRequirement')->name('deactivateRequirement');


	//Instructors
	Route::middleware(['position:instructor'])->group(function() {
		//Training CMS
		Route::get('/cms/new/class/item', 'TrainingController@newItem')->name('newClassItem');
		Route::post('/cms/new/class/item', 'TrainingController@createItem');
		Route::get('/cms/edit/class/item/{id}', 'TrainingController@editItem')->name('editClassItem');
		Route::post('/cms/edit/class/item/{id}', 'TrainingController@updateItem');
		Route::get('/cms/delete/class/item/{id}', 'TrainingController@deleteItem')->name('deleteClassItem');
		Route::get('/cms/edit/class/{id}/requirements', 'TrainingController@editClassRequirements')->name('editClassRequirements');
		Route::post('/cms/edit/class/{id}/requirements', 'TrainingController@updateClassRequirements');
		Route::get('/cms/edit/class/{id}/enrolled', 'TrainingController@editClassEnrolled')->name('enrolled');
		Route::post('/cms/edit/class/{id}/enrolled', 'TrainingController@updateClassEnrolled');
	});

	//BadgeMaster
	Route::middleware(['position:badgemaster'])->group(function(){
		//Badges CMS
		Route::get('/cms/new/badge', 'BadgesController@newBadge')->name('newBadge');
		Route::post('/cms/new/badge', 'BadgesController@createBadge');
		Route::get('/cms/edit/badge/{id}', 'BadgesController@editBadge')->name('editBadge');
		Route::post('/cms/edit/badge/{id}', 'BadgesController@updateBadge');
		Route::get('/cms/delete/badge/{id}', 'BadgesController@deleteBadge')->name('deleteBadge');
		Route::get('/cms/edit/badge/{id}/requirements', 'BadgesController@editBadgeRequirements')->name('editBadgeRequirements');
		Route::post('/cms/edit/badge/{id}/requirements', 'BadgesController@updateBadgeRequirements');
	});

	//Pathfinder
	Route::middleware(['position:pathfinder'])->group(function(){
		//Expeditions CMS
		Route::get('/cms/new/expedition', 'ExpeditionsController@newExpedition')->name('newExpedition');
		Route::post('/cms/new/expedition', 'ExpeditionsController@createExpedition');
		Route::get('/cms/edit/expedition/{id}', 'ExpeditionsController@editExpedition')->name('editExpedition');
		Route::post('/cms/edit/expedition/{id}', 'ExpeditionsController@updateExpedition');
		Route::get('/cms/delete/expedition/{id}', 'ExpeditionsController@deleteExpedition')->name('deleteExpedition');
	});

	//CMS
	Route::middleware(['position:developer'])->group(function() {
		Route::get('/cms', 'DeveloperController@index')->name('cms');
		Route::post('/cms/new', 'DeveloperController@formSubmit')->name('cmsNew');
		Route::post('/cms/update/{id}')->name('cmsUpdate');

		//Shopping CMS
		Route::get('/cms/new/internal/shopping/item', 'ShoppingController@newInternalItem')->name('newInternalShoppingItem');
		Route::post('/cms/new/internal/shopping/item', 'ShoppingController@createInternalItem');
		
		Route::get('/cms/edit/internal/shopping/item/{id}', 'ShoppingController@editInternalItem')->name('editInternalShoppingItem');
		Route::post('/cms/edit/internal/shopping/item/{id}', 'ShoppingController@updateInternalItem');
		Route::get('/cms/delete/internal/shopping/item/{id}', 'ShoppingController@deleteInternalItem')->name('deleteInternalShoppingItem');

		//external shopping items
		Route::get('/cms/new/external/shopping/item', 'ExternalInventoryController@index')->name('newExternalInventoryItem');
		Route::post('/cms/new/external/shopping/item', 'ExternalInventoryController@createInventoryItem');
		
		Route::get('/cms/edit/external/shopping/item/{id}', 'ShoppingController@editInternalItem')->name('editExternalShoppingItem');
		Route::post('/cms/edit/external/shopping/item/{id}', 'ShoppingController@updateInternalItem');
		Route::get('/cms/delete/external/shopping/item/{id}', 'ExternalInventoryController@deleteInventoryItem')->name('deleteExternalInventoryItem');

		//Positions CMS
		Route::get('/positions', 'PositionsController@listPositions')->name('positions');
		Route::get('/new/position', 'PositionsController@newPosition')->name('newPosition');
		Route::post('/new/position', 'PositionsController@createPosition');
		Route::get('/assign/position/{id}', 'PositionsController@assignPosition')->name('assignPosition');
		Route::post('/assign/position/{id}', 'PositionsController@submitAssignments');
		Route::get('/edit/position/{id}', 'PositionsController@editPosition')->name('editPosition');
		Route::post('/edit/position/{id}', 'PositionsController@updatePosition');
		Route::get('/delete/position/{id}', 'PositionsController@deletePosition')->name('deletePosition');
		Route::get('/my/positions', 'PositionsController@myPositions');

	});
});