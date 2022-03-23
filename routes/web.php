<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/vaila', App\Http\Controllers\VailaController::class);
Route::resource('/orders', App\Http\Controllers\OrderController::class);
Route::resource('/customers', App\Http\Controllers\CustomersController::class);
Route::resource('/merchant', App\Http\Controllers\MerchantController::class);
Route::resource('governorate',App\Http\Controllers\GovernorateController::class);


