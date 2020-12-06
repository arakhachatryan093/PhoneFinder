<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'index'])->name('home');

Auth::routes();


Route::group(['middleware' => ['auth', 'is_admin'], 'prefix' => '/admin'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('phones', PhoneController::class);
});

Route::get('categories/{id}/products', [MainController::class, 'categoryPhones'])->name('category_products');
Route::group(['prefix' => '/main'], function () {
    Route::get('/compare_phones', [MainController::class, 'comparePhones'])->name('compare_items');
    Route::get('/phones_info', [MainController::class, 'phonesInfo'])->name('phones_info');
    Route::get('main/show/{id}', [MainController::class, 'showPhoneDetails'])->name('phone_details');
});


