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

Route::get('/', ['as' => 'film.redirect', 'uses' => 'Web\FilmsController@index']);

Route::group(['prefix' => 'films'], function() {
    Route::get('/', ['as' => 'all.films', 'uses' => 'Web\FilmsController@films']);
    Route::get('/create', ['as' => 'create.films', 'uses' => 'Web\FilmsController@create']);
    Route::post('/store', ['as' => 'save.films', 'uses' => 'Web\FilmsController@store']);
    Route::get('/{slug}', ['as' => 'show.films', 'uses' => 'Web\FilmsController@show']);
});

Route::group(['prefix' => 'comments', 'middleware' => 'auth'], function () {
    Route::post('/store', ['as' => 'new.comment', 'uses' => 'Web\CommentController@store']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
