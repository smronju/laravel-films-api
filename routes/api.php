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

Route::get('/films', ['as' => 'film.list', 'uses' => 'FilmsController@index']);
Route::get('films/{film}', ['as' => 'film.details', 'uses' => 'FilmsController@show']);
Route::post('/films', ['as' => 'new.film', 'uses' => 'FilmsController@store']);
Route::post('/films/{film}', ['as' => 'film.update', 'uses' => 'FilmsController@update']);
Route::delete('/films/{film}', ['as' => 'delete.film', 'uses' => 'FilmsController@remove']);