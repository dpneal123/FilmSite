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

Route::any('/register', function() {
    return view('register');
});
Route::post('/user/register', 'UserController@insert')->name('register.insert');

Route::get('/user/register/card', function () {
    return view('cardupdate');
})->name('register.card');

Route::post('/user/register/card', 'UserController@insertcard')->name('account.insert');

Route::resource('UserModel', 'UserController');

Route::get('/login', function() {
    return view('login');
})->name('login');

Route::get('/account', function () {
    return view('account');
})->name('account');

Route::get('/account/card', function () {
    return view('carddetails');
});

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

Route::any('/basket', function () {
    return view('basket');
})->name('basket')->middleware('Basket');

Route::post('/films/*', 'BasketController@add')->name('basket.add');

Route::get('/basket/clear', 'BasketController@clear')->name('basket.clear');

Route::get('/basket/purchase', 'BasketController@purchase')->name('purchase');

Route::get('/account/history', 'UserController@gethistory')->name('account.history');

Route::post('/account/card', 'UserController@updatecard')->name('card.update')->middleware('User');
