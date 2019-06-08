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

Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

# Every model almost (browsers don't do PUT & DELETE) follows the 7 RESTful routes
# If this were raw API routes, resource routes could've been used
# Reference - https://laravel.com/docs/5.0/controllers#restful-resource-controllers
Route::get('/user/{id}', 'UserController@show')->name('user_show')->middleware('auth');
Route::get('/user/{id}/edit', 'UserController@edit')->name('user_edit')->middleware('auth');
Route::post('/user/{id}/update', 'UserController@update')->name('user_update')->middleware('auth');

Route::get('/trade', 'TradeController@index')->name('trade_index')->middleware('auth');
Route::get('/trade/new', 'TradeController@new')->name('trade_new')->middleware('auth');
Route::post('/trade/create', 'TradeController@create')->name('trade_create')->middleware('auth');
Route::get('/trade/{id}', 'TradeController@show')->name('trade_show')->middleware('auth');
Route::get('/trade/{id}/edit', 'TradeController@edit')->name('trade_edit')->middleware('auth');
Route::post('/trade/{id}/update', 'TradeController@update')->name('trade_update')->middleware('auth');
Route::post('/trade/{id}/complete', 'TradeController@complete')->name('trade_complete')->middleware('auth');
Route::post('/trade/{id}/delete', 'TradeController@delete')->name('trade_delete')->middleware('auth');

Route::get('/hat', 'HatController@index')->name('hat_index')->middleware('auth');
Route::get('/hat/new', 'HatController@new')->name('hat_new')->middleware('auth');
Route::post('/hat/create', 'HatController@create')->name('hat_create')->middleware('auth');
Route::get('/hat/{id}', 'HatController@show')->name('hat_show')->middleware('auth');
Route::get('/hat/{id}/edit', 'HatController@edit')->name('hat_edit')->middleware('auth');
Route::post('/hat/{id}/update', 'HatController@update')->name('hat_update')->middleware('auth');
Route::post('/hat/{id}/delete', 'HatController@delete')->name('hat_delete')->middleware('auth');

Route::get('/charms', 'CharmController@index')->name('charm_index')->middleware('auth');
Route::get('/charm/new', 'CharmController@new')->name('charm_new')->middleware('auth');
Route::post('/charm/create', 'CharmController@create')->name('charm_create')->middleware('auth');
Route::get('/charm/{id}', 'CharmController@show')->name('charm_show')->middleware('auth');
Route::get('/charm/{id}/edit', 'CharmController@edit')->name('charm_edit')->middleware('auth');
Route::post('/charm/{id}/update', 'CharmController@update')->name('charm_update')->middleware('auth');
Route::post('/charm/{id}/delete', 'CharmController@delete')->name('charm_delete')->middleware('auth');

