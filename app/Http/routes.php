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

    Route::post('/cars', 'CategoryController@search');

    Route::get('/cars/{category}/{model?}', 'CategoryController@show');

   // Route::post('/search', 'CategoryController@show');



    //parser
    Route::get('/parse', 'AdController@parse');
    Route::get('/parse/ss', 'AdController@parseSS');
    Route::get('/parse/latauto', 'AdController@parseLatAuto');
    Route::get('/parse/auto24', 'AdController@parseAuto24');
});





