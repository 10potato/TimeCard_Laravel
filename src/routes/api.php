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

Route::namespace('Api')->group(function () {

    // TODO サンプル
    // Route::get('/getSample', 'SampleController@getSample');
    // Route::post('/postSample', 'SampleController@postSample');

    // 休暇データ登録
    Route::post('/holiday/add', 'HolidayController@add')->name('add');
    // 休暇データ更新
    Route::post('/holiday/update', 'HolidayController@update')->name('update');
    // 休暇データ削除
    Route::post('/holiday/delete', 'HolidayController@delete')->name('delete');
    

    Route::group(['middleware' => ['auth:web']], function () {
        // ログインが必要なものは以下に書く
        // Route::post('/holiday/add', 'HolidayController@add')->name('add');

    });

});