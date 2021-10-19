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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'PreventBackButton']], function () {

    Route::get('/list', '\App\Http\Controllers\AdminController@index')->name('admin.list');
    Route::get('/create', '\App\Http\Controllers\AdminController@create')->name('admin.create');

    Route::post('/store', 'App\Http\Controllers\AdminController@store');

    Route::get('/edit/{id}', 'App\Http\Controllers\AdminController@edit');
    Route::post('/update', 'App\Http\Controllers\AdminController@update')->name('admin.update');

    Route::get('/delete/{id}', 'App\Http\Controllers\AdminController@destroy');
});

Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'PreventBackButton']], function () {

    Route::get('/list', '\App\Http\Controllers\UserController@index')->name('user.list');
    Route::get('/create', '\App\Http\Controllers\UserController@create')->name('user.create');

    Route::post('/store', 'App\Http\Controllers\UserController@store');

    Route::get('/edit/{id}', 'App\Http\Controllers\UserController@edit');
    Route::post('/update', 'App\Http\Controllers\UserController@update')->name('user.update');
});