<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth' ], function () {
    Route::post('login', 'App\Http\Controllers\AuthJwt\AuthController@login');
    Route::post('login/socialite', 'App\Http\Controllers\AuthJwt\AuthController@socialite');
    Route::post('logout', 'App\Http\Controllers\AuthJwt\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthJwt\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthJwt\AuthController@me');
    Route::post('registration','App\Http\Controllers\AuthJwt\AuthController@registration');
});

Route::post('book-naw',[\App\Http\Controllers\API\OrderController::class,'book_naw']);
Route::post('/vaila/check-avialable',[\App\Http\Controllers\API\VailaController::class,'check_avialable']);
Route::get('/vaila/newarival', [\App\Http\Controllers\API\VailaController::class, 'newArival'])->name('newArival');
Route::get('/vaila/bestsell', [\App\Http\Controllers\API\VailaController::class, 'bestSell'])->name('bestSell');
Route::apiResource('vaila',\App\Http\Controllers\API\VailaController::class);
Route::apiResource('orders',\App\Http\Controllers\API\OrderController::class);

