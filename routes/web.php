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
    \Log::debug('from /');
    return view('welcome');
})->name('index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/users', 'UsersController@users')->middleware('auth')->name('users');

Route::resource('/users', 'UsersController')->middleware('auth');

//Route::post('/account/{id}', 'AccountController@update')->name('account.update');
