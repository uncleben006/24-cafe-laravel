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
Route::get('/products/{class}', 'ProductController@list');
Route::get('/products/{class}/{id}/detail', 'ProductController@showDetail');

Route::get('/products/job/list', 'ProductController@job');
Route::get('/products/job/list', 'ProductController@job');
Route::get('/products/job/new', 'ProductController@createJob');
Route::post('/products/job/new', 'ProductController@storeJob');
Route::get('/products/job/filter/new', 'ProductController@createFilter');
Route::post('/products/job/filter/new', 'ProductController@storeFilter');
Route::get('/products/job/{id}/edit', 'ProductController@edit');
Route::post('/products/job/{id}/edit', 'ProductController@update');
Route::get('/products/job/filter/{id}/edit', 'ProductController@editFilter');
Route::post('/products/job/filter/{id}/edit', 'ProductController@updateFilter');

Route::get('/products/job/{id}/delete', 'ProductController@destroy');
Route::get('/products/job/filter/{id}/delete', 'ProductController@destroyFilter');


Route::get('/products/coffee/show','ProductController@showCoffee');

// order-list controller
// Route::get('/products/checkout', 'OrderListController@index');
// Route::post('/products/checkout', 'OrderListController@store');
// Route::get('/products/order-list', 'OrderListController@show');

// chat controller
Route::get('/chat', 'ChatController@index');
Route::get('/chat/all/{id}/', 'ChatController@all');
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
