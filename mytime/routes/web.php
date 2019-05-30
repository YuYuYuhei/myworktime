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
    return view('auth.login');
});

Route::get('record', 'RecordController@index')->middleware('auth');
Route::post('record', 'RecordController@punchIn')->middleware('auth');
Route::get('record', 'RecordController@show')->middleware('auth');
// Route::post('record', 'RecordController@punchOut')->middleware('auth');
// Route::get('record', 'RecordController@result')->middleware('auth');

Route::get('index', 'IndexController@add')->middleware('auth');
Route::get('index', 'RecordController@create')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
