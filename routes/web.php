<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/vaila/active/{vaila}', [App\Http\Controllers\VailaController::class,'active'])->name('vaila.active');
Route::get('/vaila/disactive/{vaila}', [App\Http\Controllers\VailaController::class,'disactive'])->name('vaila.disactive');
Route::resource('/vaila', App\Http\Controllers\VailaController::class, ['as' => 'web']);
Route::resource('orders', App\Http\Controllers\OrderController::class,['as' => 'web']);
Route::resource('/sliders', App\Http\Controllers\SliderController::class);

Route::get('/customers/active/{customer}', [App\Http\Controllers\CustomersController::class,'active'])->name('customers.active');
Route::get('/customers/disactive/{customer}', [App\Http\Controllers\CustomersController::class,'disactive'])->name('customers.disactive');
Route::resource('/customers', App\Http\Controllers\CustomersController::class);

Route::get('/merchant/active/{merchant}', [App\Http\Controllers\MerchantController::class,'active'])->name('merchant.active');
Route::get('/merchant/disactive/{merchant}', [App\Http\Controllers\MerchantController::class,'disactive'])->name('merchant.disactive');
Route::resource('/merchant', App\Http\Controllers\MerchantController::class);

Route::resource('/governorate',App\Http\Controllers\GovernorateController::class);
Route::resource('/services',App\Http\Controllers\ServicesController::class);
Route::get('/accounting/{merchant}',[App\Http\Controllers\AccountingController::class,'index']);
Route::delete('/accounting/{merchant}',[App\Http\Controllers\AccountingController::class,'delete'])->name('accounting.delete');
Route::resource('/holiday',App\Http\Controllers\HolidayController::class);

Route::get('/settings',[App\Http\Controllers\SettingsController::class,'index']);
Route::post('/settings',[App\Http\Controllers\SettingsController::class,'store']);

