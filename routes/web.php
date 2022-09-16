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

//customer, user, participant

Route::view('/', 'welcome');
Route::view('/home', 'home');

// Route::get('/login/customer', '');
// Route::get('/login/admin', '');
// Route::get('/login/participant', '');

// Route::get('/customer/{id}', '');
// Route::get('/admin/{id}', '');
// Route::get('/participant/{id}', '');


// Route::post('/login/customer', '');
// Route::post('/login/admin', '');
// Route::post('/login/participant', '');



