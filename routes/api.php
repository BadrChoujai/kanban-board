<?php

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

/**
 * Columns
 */
Route::prefix('columns')->group(function () {
    Route::get('/', 'Api\ColumnController@index');
    Route::post('/store', 'Api\ColumnController@store');
    Route::post('/storeColumns', 'Api\ColumnController@storeColumns');
    Route::delete('/delete/{id}', 'Api\ColumnController@destroy');
});

/**
 * Cards
 */
Route::get('/list-cards', 'Api\CardController@index');
