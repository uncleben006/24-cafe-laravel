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
Route::get('/', function () { return view('index'); });
Route::get('/posts', function() { return view('post.post'); });
Route::get('/posts/{id}/show',function($id){ return view('post.post-single', ['id' => $id ]); });
Route::post('/posts', 'PostController@store')->name('post');




// product controller administrator
Route::get('/products/{category}', 'ProductController@list');
Route::get('/products/{category}/{id}/detail', 'ProductController@showDetail');
Route::get('/products/job/list', 'ProductController@job');
Route::get('/products/job/new', 'ProductController@jobForm');
Route::post('/products/job/new', 'ProductController@store');
Route::get('/products/{category}/{id}/edit', 'ProductController@edit');
Route::post('/products/{category}/{id}/edit', 'ProductController@update');
Route::get('/products/{id}/delete', 'ProductController@destroy');

// order-list controller
// Route::get('/products/checkout', 'OrderListController@index');
// Route::post('/products/checkout', 'OrderListController@store');
// Route::get('/products/order-list', 'OrderListController@show');

// chat controller
Route::get('/chat', 'ChatController@index');
Route::get('/chat/all', 'ChatController@all');
Route::get('/chat/last/', 'ChatController@last');
Route::post('/chat', 'ChatController@create');

// user controller
Route::get('/user', 'UserController@index')->name('user');
Route::post('/user', 'UserController@store')->name('user.post');
Route::get('/user/{id}/delete/', 'UserController@destroy')->name('user.delete');
Route::get('/user/{id}/edit/', 'UserController@edit')->name('user.edit');
Route::post('/user/{id}/edit/', 'UserController@update')->name('user.edit.post');

// show session
Route::get('/session', 'UserController@show_session');
Route::get('/show-user', 'UserController@show_user');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
