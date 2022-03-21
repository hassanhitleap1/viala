<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth' ], function () {
    Route::post('login', 'App\Http\Controllers\AuthJwt\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthJwt\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthJwt\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthJwt\AuthController@me');
    Route::post('registration','App\Http\Controllers\AuthJwt\AuthController@registration');
});

Route::apiResource('vaila',\API\VailaController::class);
