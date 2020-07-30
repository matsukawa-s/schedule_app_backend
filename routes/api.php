<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;

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


Route::post('/login', 'UsersController@login');
Route::post('/register', 'UsersController@register');
Route::get('/logout', 'UsersController@logout')->middleware('auth:api');

Route::group(['prefix' => 'extension','middleware' => 'auth:api'], function () {
    Route::get('/index','ExtensionController@index');
    Route::get('/addlist/{id}','ExtensionController@exAddList');
    Route::post('/calexadd','ExtensionController@calendarExtensionAdd');
});

Route::group(['prefix' => 'diary','middleware' => 'auth:api'], function () {
    Route::get('/get/{id}','DiaryController@getDiaryList');
    Route::post('add','DiaryController@addDiary');
    Route::post('store','DiaryController@store');
});

Route::get('/calendar/{id}','SchedulesController@index');
Route::get('/schedules/{id}','SchedulesController@show');
<<<<<<< HEAD

Route::post('/schedules/store','SchedulesController@store');
=======
Route::get('/schedules/start_date/{date}','SchedulesController@getSchedulesDate');
>>>>>>> master
