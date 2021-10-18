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

Route::group(['middleware' => ['PreventBackButton']], function () {

    Route::get('/list', '\App\Http\Controllers\PostController@index')->name('list')->middleware('auth');
    Route::get('/create', '\App\Http\Controllers\PostController@create')->name('create')->middleware('auth');

    Route::post('/store', 'App\Http\Controllers\PostController@store')->middleware('auth');

    Route::get('/edit/{id}', 'App\Http\Controllers\PostController@edit')->middleware('auth');
    Route::post('/update', 'App\Http\Controllers\PostController@update')->name('update')->middleware('auth');

    Route::get('/delete/{id}', 'App\Http\Controllers\PostController@destroy')->middleware('auth');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});