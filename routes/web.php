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

// 和session有關的api要用中介層管理或直接放在web

// post controller
Route::get('/', function () { return view('welcome'); });
Route::get('/posts', function() { return view('post'); });
Route::get('/posts/{id}',function($id){ return view('post-single', ['id' => $id ]); });
Route::post('/posts', 'PostController@store')->name('post');

// product controller
Route::get('/products', 'ProductController@list');
Route::get('/products/add-cart/{id}', 'ProductController@add_cart');
Route::get('/products/list-cart', 'ProductController@list_cart');
Route::get('/products/cart', 'ProductController@cart');

// order-list controller
Route::get('/products/checkout', 'OrderListController@index');
Route::post('/products/checkout', 'OrderListController@store');
Route::get('/products/order-list', 'OrderListController@show');

// chat controller
Route::get('/chat', 'ChatController@index');
Route::get('/chat/all', 'ChatController@all');
Route::post('/chat', 'ChatController@create');

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
