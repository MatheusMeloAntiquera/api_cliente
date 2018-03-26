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

Route::prefix('customer')->group(function () {
    Route::post('/', "CustomerController@create");
    Route::get('/', "CustomerController@list");
    Route::get('/{id}', "CustomerController@getById");
    Route::put('/{id}', "CustomerController@update");
    Route::delete('/{id}', "CustomerController@delete");

    //Contact
    Route::post('/{customer}/contact', "ContactController@create");
    Route::get('/{customer}/contact', "ContactController@list");
    Route::get('/{customer}/contact/{id}', "ContactController@getById");
    Route::put('/{customer}/contact/{id}', "ContactController@update");
    Route::delete('/{customer}/contact/{id}', "ContactController@delete");
});

/* Route::prefix('contact')->group(function () {
Route::post('/', "ContactController@create");
Route::get('/', "ContactController@list");
Route::get('/{id}', "ContactController@getById");
Route::put('/{id}', "ContactController@update");
Route::delete('/{id}', "ContactController@delete");
});
 */
