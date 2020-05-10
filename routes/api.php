<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'UserController@show');

    Route::patch('/user', 'UserController@update');
    Route::patch('/user/password', 'PasswordController@update');
});

Route::post('/auth/login', 'AuthController@login')->name('login');
Route::post('/auth/logout', 'AuthController@logout')->name('logout');
