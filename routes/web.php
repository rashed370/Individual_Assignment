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
    Route::get('/posts', 'PostController@index')->name('posts');
    Route::post('/posts', 'PostController@search')->name('posts_search');
    Route::get('/posts/view/{id}', 'PostController@view')->name('posts_view');

    Route::group(['middleware' => ['access:admin']], function () {
        Route::get('/users', 'UserController@index')->name('users');
        Route::get('/users/add', 'UserController@add_index')->name('users_add');
        Route::post('/users/add', 'UserController@add_post')->name('users_add_post');
        Route::get('/users/update/{id}', 'UserController@update_index')->name('users_update');
        Route::post('/users/update/{id}', 'UserController@update_post')->name('users_update_post');
        Route::get('/users/delete/{id}', 'UserController@delete')->name('users_delete');
        Route::get('/posts/pending', 'PostController@pending')->name('posts_pending');
        Route::get('/posts/approve/{id}', 'PostController@approve')->name('posts_approve');
        Route::get('/posts/modification', 'PostController@modification')->name('posts_modification');
        Route::get('/posts/modification/{id}', 'PostController@modification_details')->name('posts_modification_detail');
        Route::post('/posts/modification/{id}', 'PostController@modification_details_post')->name('posts_modification_detail_post');
        Route::get('/posts/modification/delete/{id}', 'PostController@modification_delete')->name('posts_modification_delete');
        Route::get('/posts/delete/{id}', 'PostController@delete')->name('posts_delete');
        Route::get('/posts/remove/request', 'PostController@delete_list')->name('posts_delete_list');
    });

    Route::group(['middleware' => ['access:scout']], function () {
        Route::get('/posts/create', 'PostController@create')->name('posts_create');
        Route::post('/posts/create', 'PostController@create_post')->name('posts_create_post');
        Route::get('/posts/own', 'PostController@own')->name('posts_own');
        Route::get('/posts/delete/request/{id}', 'PostController@delete_request')->name('posts_delete_request');
    });

    Route::group(['middleware' => ['access:admin,scout']], function () {
        Route::get('/posts/update/{id}', 'PostController@update')->name('posts_update');
        Route::post('/posts/update/{id}', 'PostController@update_post')->name('posts_update_post');
    });

    Route::group(['middleware' => ['access:user']], function () {
        Route::get('/checklist', 'WishListController@index')->name('wishlist');
        Route::get('/checklist/add/{id}', 'WishListController@add')->name('wishlist_add');
        Route::get('/checklist/remove/{id}', 'WishListController@remove')->name('wishlist_delete');
    });
});

