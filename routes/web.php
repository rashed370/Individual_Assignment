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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@update')->name('profile_update');

    Route::group(['middleware' => ['access:admin']], function () {
        Route::get('/users', 'UserController@index')->name('users');
        Route::get('/users/add', 'UserController@add_index')->name('users_add');
        Route::post('/users/add', 'UserController@add_post')->name('users_add_post');
        Route::get('/users/update/{id}', 'UserController@update_index')->name('users_update');
        Route::post('/users/update/{id}', 'UserController@update_post')->name('users_update_post');
        Route::get('/users/delete/{id}', 'UserController@delete')->name('users_delete');
    });
});

