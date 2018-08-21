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
    return view('welcome');
});

//post controller 
Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}', 'PostController@show');
Route::post('/posts', 'PostController@store');

// user controller
Route::get('/user', 'UserController@index')->name('user');
Route::post('/user', 'UserController@store')->name('user-post');
Route::get('/user/{id}/delete/', 'UserController@destroy')->name('user-delete');
Route::get('/user/{id}/edit/', 'UserController@edit')->name('userEdit');
Route::post('/user/{id}/edit/', 'UserController@update')->name('user-update');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
