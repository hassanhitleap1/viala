<?php


use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth' ], function () {
    Route::post('login', 'App\Http\Controllers\AuthJwt\AuthController@login');
    Route::post('login/google', 'App\Http\Controllers\AuthJwt\AuthController@loginWithGoogle');
    Route::post('login/facebook', 'App\Http\Controllers\AuthJwt\AuthController@loginWithFacebook');
    Route::post('logout', 'App\Http\Controllers\AuthJwt\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthJwt\AuthController@refresh');
    Route::get('me', 'App\Http\Controllers\AuthJwt\AuthController@me');
    Route::post('registration','App\Http\Controllers\AuthJwt\AuthController@registration');
    Route::post('/send-otp','App\Http\Controllers\AuthJwt\AuthController@sendOtp');
    Route::post('/verify-otp','App\Http\Controllers\AuthJwt\AuthController@verifyOtp');
    Route::post('set-fcm', 'App\Http\Controllers\AuthJwt\AuthController@setFcm');
    Route::post('forget-password', 'App\Http\Controllers\AuthJwt\AuthController@forgetPassword');
    Route::post('updateprofile', 'App\Http\Controllers\AuthJwt\AuthController@updateprofile');
});


Route::get('terms-and-conditions', 'App\Http\Controllers\API\SettingsController@terms_and_conditions');
Route::get('about', 'App\Http\Controllers\API\SettingsController@about');
Route::get('privacy-policy', 'App\Http\Controllers\API\SettingsController@privacy_policy');
Route::get('slider', 'App\Http\Controllers\API\sliderController@index');
Route::get('governorates', 'App\Http\Controllers\API\GovernorateController@index');
Route::post('book-naw',[\App\Http\Controllers\API\OrderController::class,'book_naw']);
Route::post('/vaila/check-avialable',[\App\Http\Controllers\API\VailaController::class,'check_avialable']);
Route::get('/vaila/newarival', [\App\Http\Controllers\API\VailaController::class, 'newArival'])->name('newArival');
Route::get('vaila/bestsell', [\App\Http\Controllers\API\VailaController::class, 'bestSell'])->name('bestSell');
Route::get('vaila/my-vaila', [\App\Http\Controllers\API\VailaController::class, 'myViala'])->name('myViala');
Route::get('vaila/nearby', [\App\Http\Controllers\API\VailaController::class, 'nearby'])->name('nearby');
Route::apiResource('vaila',\App\Http\Controllers\API\VailaController::class);

Route::get('booking-history',[\App\Http\Controllers\API\OrderController::class,'booking_history']);
Route::apiResource('orders',\App\Http\Controllers\API\OrderController::class);
Route::apiResource('comments',\App\Http\Controllers\API\CommentsController::class);
Route::apiResource('rates',\App\Http\Controllers\API\RateController::class);

Route::get('myfavourite',[\App\Http\Controllers\API\FavouritesController::class,'myfavourite']);
Route::apiResource('favourites',\App\Http\Controllers\API\FavouritesController::class);

