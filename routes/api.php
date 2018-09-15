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


/** @see \App\Http\Controllers\RateController::store() */
Route::post('rate', 'RateController@store');

/** @see \App\Http\Controllers\TransactionController::index() */
Route::get('transaction', 'TransactionController@index');

/** @see \App\Http\Controllers\WalletController::add */
Route::put('wallet/{user}', 'WalletController@add');

/** @see \App\Http\Controllers\TransferController::store() */
Route::post('transfer', 'TransferController@store');

/** @see \App\Http\Controllers\UserController::store() */
Route::post('user', 'UserController@store');
