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

Route::get('/', 'ReportController@userTransactions');

/** @see \App\Http\Controllers\RateController::store() */
Route::post('rate', 'RateController@store');

/** @see \App\Http\Controllers\TransactionController::index() */
Route::get('transaction', 'TransactionController@index');

/** @see \App\Http\Controllers\WalletController::add */
Route::put('wallet', 'WalletController@add');

/** @see \App\Http\Controllers\TransferController::store() */
Route::post('transfer', 'TransferController@store');

/** @see \App\Http\Controllers\UserController::store() */
Route::post('user', 'UserController@store');


