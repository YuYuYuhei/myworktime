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


Route::get('records/create', 'RecordController@create')->middleware('auth');
Route::post('/punchIn', 'RecordController@storePunchIn')->middleware('auth');
Route::post('/punchOut', 'RecordController@storePunchOut')->middleware('auth');
Route::post('/store', 'RecordController@storeMemo')->middleware('auth');
Route::get('/', 'RecordController@index')->middleware('auth');
// Route::get('/empty', 'RecordController@index')->middleware('auth');
Route::get('/records/{id}', 'RecordController@show')->middleware('auth');
Route::get('records/edit/{id}', 'RecordController@edit')->middleware('auth');
Route::post('records/edit/{id}', 'RecordController@update')->middleware('auth');
Route::delete('delete/{id}', 'RecordController@delete')->middleware('auth');

 // ※createとshowの順番大事。
 // showが先だと,showメソッドにcreateという文字列が渡されてしまう



Auth::routes(); //認証まわりのrouting 消すと->middleware('auth')ついてるcodeに不具合



// Route::get('/home', 'HomeController@index')->name('home');
