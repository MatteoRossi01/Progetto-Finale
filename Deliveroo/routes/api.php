<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/items','Api\ItemController@index');

Route::get('/user/{slug}/{cart}/{filtcart}','Api\ItemController@filtcart');

Route::get('/types','Api\TypeController@index');

Route::get('/users','Api\UserController@index');

Route::get('/users/{filter}','Api\UserController@filter');

Route::get('/user/{slug}', 'Api\UserController@show');

Route::get('/user/{slug}/{cart}','Api\UserController@cart');

Route::post('/user/{slug}/pay', 'Api\OrderController@order');

