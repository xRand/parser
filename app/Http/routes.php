<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'CategoryController@index');
    Route::post('/', 'CategoryController@getModels');

    //authorization
    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
    Route::get('/logout', 'Auth\AuthController@getLogout');

    //search
    Route::post('/cars', 'CategoryController@search');
    Route::get('/cars/{category}/{model?}', 'CategoryController@show');
    Route::post('/cars/{category?}/{model?}', 'CategoryController@getModels');

    //parser
    Route::get('/parse', 'ParserController@index');
    Route::post('/parse/ss', 'ParserController@parseSS');
    Route::post('/parse/latauto', 'ParserController@parseLatAuto');
    Route::post('/parse/auto24', 'ParserController@parseAuto24');
});





