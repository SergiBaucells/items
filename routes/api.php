<?php

Route::group(['namespace' => "Baucells\Items\Http\Controllers",'middleware' => 'api','prefix' => 'api/v1', 'middleware' => ['throttle','bindings']], function () {

    //HERE API PUBLIC ROUTES


    Route::group(['middleware' => 'auth:api'], function() {
        //HERE API PRIVATE ROUTES
        Route::get('/api/v1/items',              'APIItemsController@index');
        Route::get('/api/v1/items/{item}',      'APIItemsController@show');
        Route::post('/api/v1/items',             'APIItemsController@store');
        Route::put('/api/v1/items/{item}',      'APIItemsController@update');
        Route::delete('/api/v1/items/{item}',   'APIItemsController@destroy');
    });
});