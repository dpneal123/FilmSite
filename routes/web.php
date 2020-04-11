<?php

use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return view('films');
})->name('films');
Route::resource('FilmsModel','FilmsController');
Route::get('/register', function() {
    return view('register');
});
Route::post('/user/register', 'UserController@insert');

Route::get('/user/register/done',function() {
    return view('register');
});

Route::resource('UserModel', 'UserController');

Route::get('/login', function() {
    return view('login');
})->name('login');

Route::get('/account', function () {
    return view('account');
})->name('account');

Route::get('/films/{id}', function($id)
{
    return view('filminfo', [$id => 'id']);
})->name('films.get');

Route::post('/login', 'UserController@check')->name('login.check');

Route::get('/logout', 'UserController@logout')->name('logout');

Route::get('/account/edit', function () {
   return view('accountedit');
});

Route::post('/account/edit', 'UserController@edit')->name('account.edit');

Route::resource('BasketModel', 'BasketController');

Route::get('/basket', function () {
    return view('basket');
})->name('basket')->middleware('Basket');

Route::post('/films/*', 'BasketController@add')->name('basket.add');

Route::post('/basket', 'BasketController@clear')->name('basket.clear');


