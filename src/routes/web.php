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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::namespace('Web')->group(function () {

    // ログイン
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::get('/', 'LoginController@showLoginForm');

    // ログイン画面のログインボタン押下時
    Route::post('login', 'LoginController@login');
    Route::post('/', 'LoginController@login');

    // ログアウト
    Route::get('logout', 'LoginController@logout')->name('logout');

    // ログインに成功した場合のみ、以下のページに遷移できる
    Route::group(['middleware' => ['auth:web']], function () {
        // ログインが必要なものは以下に書く
        
        Route::get('/holiday/list', 'HolidayController@index')->name('list');
        Route::get('/holiday/form', 'HolidayController@add')->name('add');
        Route::get('/holiday/update/{holidayId}', 'HolidayController@update')->name('update');

    });

});