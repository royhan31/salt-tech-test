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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/balance', [App\Http\Controllers\BalanceController::class, 'index'])->name('balance');
Route::post('/balance', [App\Http\Controllers\BalanceController::class, 'store'])->name('balance.store');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::get('/order/search', [App\Http\Controllers\OrderController::class, 'search'])->name('order.search');
Route::get('/order/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');
Route::get('/order/pay/{order}', [App\Http\Controllers\OrderController::class, 'pay'])->name('order.pay');
Route::put('/order/pay/{order}', [App\Http\Controllers\OrderController::class, 'update'])->name('order.update');
