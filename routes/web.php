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

Route::get('/login/customer', 'App\Http\Controllers\Auth\LoginController@showCustomerLoginPage');
Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginPage');
Route::get('/login/participant', 'App\Http\Controllers\Auth\LoginController@showParticipantLoginPage');

Route::get('/register/customer', 'App\Http\Controllers\Auth\RegisterController@showCustomerRegisterPage');
Route::get('/register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegisterPage');

// Route::get('/customer/{id}', '');
// Route::get('/admin/{id}', '');
// Route::get('/participant/{id}', '');

// route();
Route::post('/login/customer', 'App\Http\Controllers\Auth\LoginController@customerLogin')->name('loginCustomer');
Route::post('/login/admin', 'App\Http\Controllers\Auth\LoginController@adminLogin')->name('loginAdmin');
Route::post('/login/participant', 'App\Http\Controllers\Auth\LoginController@participantLogin')->name('loginParticipant');

// TODO;
// fix the issues below. especially from the route() method in my views.
// this is bad naming practice.
// fixed by using the name() method at the end.

// when i try making post requests from my terminal using curl, all i get is the page expired page.
// why is this happening????

Route::post('/register/admin', 'App\Http\Controllers\Auth\RegisterController@createAdmin')->name('registerAdmin');
Route::post('/register/customer', 'App\Http\Controllers\Auth\RegisterController@createCustomer')->name('registerCustomer');
Route::post('/register/participant', 'App\Http\Controllers\Auth\RegisterController@createParticipant')->name('registerParticipant');






