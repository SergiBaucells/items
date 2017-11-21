<?php

Route::group(['namespace' => "Baucells\Items\Http\Controllers", 'middleware' => 'web'], function () {

      Route::group( ['middleware' => 'auth'] , function () {
          // Items Web without API only Laravel PHP
          Route::get('/items_php',                 'ItemsController@index');
          Route::get('/items_php/create',          'ItemsController@create');
          Route::get('/items_php/edit/{item}',    'ItemsController@edit');
          Route::get('/items_php/{item}',         'ItemsController@show');
          Route::post('/items_php',                'ItemsController@store');
          Route::put('/items_php/{item}',         'ItemsController@update');
          Route::delete('/items_php/{item}',      'ItemsController@destroy');

          // Items API
//          Route::get('/api/v1/items',              'APIItemsController@index');
//          Route::get('/api/v1/items/{item}',      'APIItemsController@show');
//          Route::post('/api/v1/items',             'APIItemsController@store');
//          Route::put('/api/v1/items/{item}',      'APIItemsController@update');
//          Route::delete('/api/v1/items/{item}',   'APIItemsController@destroy');

          //Items vue
          Route::view('/items','items');
    });

});