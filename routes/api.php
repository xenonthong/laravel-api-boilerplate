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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('user', 'UserController@show');

    Route::patch('user', 'UserController@update');
    Route::patch('user/password', 'Auth\PasswordController@update');

    Route::post('auth/logout', 'Auth\LogoutController@logout')->name('logout');
});

Route::post('auth/login', 'Auth\LoginController@login')->name('login');
Route::post('auth/register', 'Auth\RegistrationController@register')->name('register');
Route::get('auth/verify/{user}/{hash}', 'Auth\VerificationController@verify')
    ->name('auth.verify');
