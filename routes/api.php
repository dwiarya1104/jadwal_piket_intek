<?php

use Illuminate\Http\Request;
use app\Http\Controllers\Auth\LoginController;
use app\Http\Controllers\ScheduleController;
use app\Http\Controllers\ApiController;

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

Route::post('login', 'Auth\LoginController@apiLogin');

Route::get('dataOb','ApiController@dataOb');
Route::get('dataSchedule','ApiController@dataSchedule');
Route::get('history','ApiController@history');
Route::post('schedule','ApiController@schedule');
Route::post('update', 'ApiController@update');
Route::post('addSchedule', 'ApiController@addSchedule');
Route::post('registration','ApiController@registration');