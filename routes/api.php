<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// post api 
Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}', 'PostController@show');
Route::post('/posts', 'PostController@store');

// product api
Route::get('/products', 'ProductController@api');
Route::get('/products/{class}', 'ProductController@filterApi');
Route::get('/products/{class}/image', 'ProductController@imageApi');
Route::get('/products/{id}/show', 'ProductController@singleApi');
Route::get('/products/{id}/images', 'ProductController@imagesApi');

