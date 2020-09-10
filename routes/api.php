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
    Route::get('/get/{id}','DiaryController@getDiaryData');
    Route::post('store','DiaryController@store');
    Route::post('update/{id}','DiaryController@update');
    Route::get('delete/{id}','DiaryController@delete');
});

Route::group(['prefix' => 'todo', 'middleware' => 'auth:api'], function(){
    Route::get('get/{id}', 'ToDoController@index');
    Route::post('store', 'ToDoController@store');
    Route::post('update/{id}', 'ToDoController@update');
    Route::get('delete/{id}', 'ToDoController@delete');
});

Route::group(['prefix' => 'calendar','middleware' => 'auth:api'], function () {
    Route::get('/get','CalendarController@getUserCalendar');
    Route::post('store','CalendarController@store');
    Route::get('/delete/{id}','CalendarController@delete');
    Route::post('/edit/{id}','CalendarController@editCalendarName');
});

Route::get('/calendar/{id}','SchedulesController@index');
Route::get('/schedules/{id}','SchedulesController@show');

Route::group(['prefix' => 'schedules','middleware' => 'auth:api'], function () {
    Route::post('store','SchedulesController@store');
    Route::post('update/{id}','SchedulesController@update');
    Route::get('delete/{id}','SchedulesController@delete');
});
// Route::post('/schedules/store','SchedulesController@store');
// Route::post('/schedules/update/{id}','SchedulesController@update');
Route::get('/schedules/start_date/{date}','SchedulesController@getSchedulesDate');
