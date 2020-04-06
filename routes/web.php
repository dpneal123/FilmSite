<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/films', 'FilmsController@index');
Route::resource('FilmsModel','FilmsController');
Route::get('/register',function() {
    return view('register');
});
Route::post('user/register', 'UserController@insert');

Route::get('user/register/done',function() {
    return view('register');
});


Route::get('/login',function() {
    return view('login');
});
Route::post('user/login', 'UserController@check');

Route::get('/account/{id}',function () {
   return view('account');
});
