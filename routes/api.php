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

Route::prefix('/user')->group(function() {
    Route::get('/check',            'UserController@checkToken');
    Route::post('/refresh',         'UserController@refreshToken');
    Route::post('/login',           'UserController@login');
    Route::post('/register',        'UserController@register');
    // Route::post('/facebook',        'UserController@facebook');

    Route::middleware('auth:api')->group(function () {
        Route::post('/cont',              'UserController@edit');
    });
});

