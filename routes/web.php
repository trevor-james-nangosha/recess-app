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

Auth::routes();

Route::view('/', 'welcome');
Route::view('/home', 'home');

Route::get('/customers', 'App\Http\Controllers\ProfileController@showCustomers');
Route::get('/customers/{id}', 'App\Http\Controllers\ProfileController@showCustomerProfile');
Route::get('/admins', 'App\Http\Controllers\ProfileController@showAdmins');
Route::get('/admins/{id}', 'App\Http\Controllers\ProfileController@showAdminProfile');
Route::get('/participants', 'App\Http\Controllers\ProfileController@showParticipants');
Route::get('/participants/{id}', 'App\Http\Controllers\ProfileController@showParticipantProfile');
Route::get('/about/participants', 'App\Http\Controllers\ParticipantsController@browseAllParticipants');
Route::get('/about/participants/{id}', 'App\Http\Controllers\ParticipantsController@browseParticipant');

Route::get('/shop', 'App\Http\Controllers\ShoppingController@showOrderPage');
Route::get('/products', 'App\Http\Controllers\ProductsController@showAllProducts');
Route::get('/products/{id}', 'App\Http\Controllers\ProductsController@showProduct');

Route::get('/checkout', 'App\Http\Controllers\CheckoutController@finalisePurchase')->name('checkoutget');

Route::post('/products', 'App\Http\Controllers\ProductsController@addNewProduct');
Route::post('/checkout', 'App\Http\Controllers\CheckoutController@processCheckout')->name('checkoutpost');

// TODO;
// when i try making post requests from my terminal using curl, all i get is the page expired page.
// why is this happening???? it is something to do with csrf tokens.
// setting csrf tokens using curl.





