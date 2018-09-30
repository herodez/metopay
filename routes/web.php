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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'TransactionController@index');
Route::post('/createTransaction', 'TransactionController@store')
    ->name('createPseTransaction');
Route::get('/transactions', 'TransactionController@getTransactions')
    ->name('transactions');
Route::get('/getBanksList', 'TransactionController@getBankList');
Route::get('/transaction/{transaction}', 'TransactionController@show')
    ->name('transaction_show');
Auth::routes();

