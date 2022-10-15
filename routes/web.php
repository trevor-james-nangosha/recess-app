<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Route::get('/participants', 'App\Http\Controllers\ProfileController@showParticipants');
// Route::get('/participants/{id}', 'App\Http\Controllers\ProfileController@showParticipantProfile');



Route::get('/products', 'App\Http\Controllers\ProductsController@showAllProducts');


Route::get('/about/participants', 'App\Http\Controllers\ParticipantsController@browseAllParticipants');
Route::get('/about/participants/{id}', 'App\Http\Controllers\ParticipantsController@browseParticipant');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes([
    'register' => false,
]);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home'); //->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

// -------------- LOGGING IN AND REGISTERING -------------------------------------------------------------
Route::get('/register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegistrationForm')->name('getRegisterAdmin');
Route::get('/register/customer', 'App\Http\Controllers\Auth\RegisterController@showCustomerRegistrationForm')->name('getRegisterCustomer');

Route::post('/register/admin', 'App\Http\Controllers\Auth\RegisterController@register')->name('postRegisterAdmin');
Route::post('/register/customer', 'App\Http\Controllers\Auth\RegisterController@register')->name('postRegisterCustomer');

// -------------- DATA FOR FILLING THE DIFFERENT PAGES -----------------------------------------------------
Route::get('/data/dashboard/charts', 'App\Http\Controllers\DataController@sendDashboardData');
Route::get('/data/dashboard/tables/participants', 'App\Http\Controllers\DataController@sendDashboardParticipantsTable');
Route::get('/data/dashboard/tables/customers', 'App\Http\Controllers\DataController@sendDashboardCustomersTable');

// ------------------------ ADMIN DASHBOARD -------------------------------------------------------------
Route::group(['middleware' => 'admin-only'], function(){
    Route::get('/admin/dashboard', 'App\Http\Controllers\DataController@sendAdminDashboard')->name('adminDashboard');
    Route::get('/admin/tables', 'App\Http\Controllers\DataController@sendAdminTables')->name('adminTables');
});


// ------------------------ ALL THE SHOPPING STUFF ------------------------------------------------------
Route::group(['middleware' => 'customer-only'], function(){
    Route::get('/shop', 'App\Http\Controllers\ShoppingController@showOrderPage');
    Route::post('/checkout', 'App\Http\Controllers\CheckoutController@processCheckout')->name('checkoutpost');
    Route::get('/customer/dashboard', 'App\Http\Controllers\DataController@sendCustomerDashboard');
});

// ---------------------- FOR UNAUTHORISED REQUESTS ------------------------------------------
Route::view('403', '403');


// TODO;
// when i try making post requests from my terminal using curl, all i get is the page expired page.
// why is this happening???? it is something to do with csrf tokens.
// setting csrf tokens using curl.


Route::group(['middleware' => 'participant-only'], function(){
    Route::get('/participant/dashboard', 'App\Http\Controllers\DataController@sendParticipantDashboard');
});



Route::get('/customers', 'App\Http\Controllers\ProfileController@showCustomers');
Route::get('/customers/{id}', 'App\Http\Controllers\ProfileController@showCustomerProfile');
Route::get('/admins', 'App\Http\Controllers\ProfileController@showAdmins');
Route::get('/admins/{id}', 'App\Http\Controllers\ProfileController@showAdminProfile');



