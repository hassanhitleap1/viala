<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth' ], function () {
    Route::post('login', 'AuthJwt\AuthController@login');
    Route::post('logout', 'AuthJwt\AuthController@logout');
    Route::post('refresh', 'AuthJwt\AuthController@refresh');
    Route::post('me', 'AuthJwt\AuthController@me');
    Route::post('registration','AuthJwt\AuthController@registration');
});

Route::apiResource('vaila',\API\VailaController::class);
