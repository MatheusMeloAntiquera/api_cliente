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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
}); */

Route::post('/client', "ClientController@create");
Route::get('/client', "ClientController@list");
Route::get('/client/{id}', "ClientController@getById");
Route::put('/client/{id}', "ClientController@update");
Route::delete('/client/{id}', "ClientController@delete");
