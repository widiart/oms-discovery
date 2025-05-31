<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::get('login/{token?}', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:admin'])
        ->get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    Route::middleware(['role:admin|staff'])->group(function () {
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
        });
        Route::prefix('customer')->name('customer.')->group(function () {
            Route::get('/', [App\Http\Controllers\CustomerController::class, 'index'])->name('index');
        });
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('index');
        });
    });
});
