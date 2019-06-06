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
Route::get('/trade', 'TradeController@index')->name('trade_index');
Route::get('/trade/new', 'TradeController@new')->name('trade_new');
Route::get('/trade/create', 'TradeController@create')->name('trade_create');
Route::get('/trade/:id', 'TradeController@show')->name('trade_show');
Route::get('/trade/:id/edit', 'TradeController@edit')->name('trades_edit');
Route::get('/trade/:id/update', 'TradeController@update')->name('trade_update');
Route::get('/trade/:id/delete', 'TradeController@delete')->name('trade_delete');

Route::get('/hat', 'HatController@index')->name('hat_index');
Route::get('/hat/new', 'HatController@new')->name('hat_new');
Route::get('/hat/create', 'HatController@create')->name('hat_create');
Route::get('/hat/:id', 'HatController@show')->name('hat_show');
Route::get('/hat/:id/edit', 'HatController@edit')->name('hats_edit');
Route::get('/hat/:id/update', 'HatController@update')->name('hat_update');
Route::get('/hat/:id/delete', 'HatController@delete')->name('hat_delete');

Route::get('/charms', 'CharmController@index')->name('charm_index');
Route::get('/charm/new', 'CharmController@new')->name('charm_new');
Route::get('/charm/create', 'CharmController@create')->name('charm_create');
Route::get('/charm/:id', 'CharmController@show')->name('charm_show');
Route::get('/charm/:id/edit', 'CharmController@edit')->name('charms_edit');
Route::get('/charm/:id/update', 'CharmController@update')->name('charm_update');
Route::get('/charm/:id/delete', 'CharmController@delete')->name('charm_delete');

