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

// get blade
Route::get('/', function () { return view('welcome'); });
Route::get('/posts', function() { return view('post'); });
Route::get('/posts/{id}',function($id){ return view('post-single', ['id' => $id ]); });

// post controller
Route::post('/posts', 'PostController@store')->name('post');

// product controller
Route::get('/products', 'ProductController@list');
Route::get('/products/add-cart/{id}', 'ProductController@add_cart');
Route::get('/products/list-cart', 'ProductController@list_cart');
Route::get('/products/cart', 'ProductController@cart');

// user controller
Route::get('/user', 'UserController@index')->name('user');
Route::post('/user', 'UserController@store')->name('user-post');
Route::get('/user/{id}/delete/', 'UserController@destroy')->name('user-delete');
Route::get('/user/{id}/edit/', 'UserController@edit')->name('userEdit');
Route::post('/user/{id}/edit/', 'UserController@update')->name('user-update');


// show session
Route::get('/session', 'UserController@show_session');
Route::get('/show-user', 'UserController@show_user');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
