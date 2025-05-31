<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('api.login.auth');


Route::middleware('auth:sanctum')->group(function () {
    // summary
    Route::get('/summary', [App\Http\Controllers\Api\SummaryController::class, 'index'])->name('api.dashboard.summary');
    Route::get('/summary/sales', [App\Http\Controllers\Api\SummaryController::class, 'sales'])->name('api.dashboard.sales-overview');
    
    // products
    Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'getData'])->name('api.product.data');
    Route::get('/products/all', [App\Http\Controllers\Api\ProductController::class, 'getDataAll'])->name('api.product.data-all');
    Route::get('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'read'])->name('api.product.read');
    Route::post('/product', [App\Http\Controllers\Api\ProductController::class, 'create'])->name('api.product.create');
    Route::put('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'update'])->name('api.product.update');
    Route::delete('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'delete'])->name('api.product.delete');

    // customers
    Route::get('/customers', [App\Http\Controllers\Api\CustomerController::class, 'getData'])->name('api.customer.data');
    Route::get('/customers/all', [App\Http\Controllers\Api\CustomerController::class, 'getDataAll'])->name('api.customer.data-all');
    Route::get('/customer/{id}', [App\Http\Controllers\Api\CustomerController::class, 'read'])->name('api.customer.read');
    Route::post('/customer', [App\Http\Controllers\Api\CustomerController::class, 'create'])->name('api.customer.create');
    Route::put('/customer/{id}', [App\Http\Controllers\Api\CustomerController::class, 'update'])->name('api.customer.update');
    Route::delete('/customer/{id}', [App\Http\Controllers\Api\CustomerController::class, 'delete'])->name('api.customer.delete');

    // orders
    Route::get('/orders', [App\Http\Controllers\Api\OrderController::class, 'getData'])->name('api.order.data');
    Route::get('/order/{id}', [App\Http\Controllers\Api\OrderController::class, 'read'])->name('api.order.read');
    Route::post('/order', [App\Http\Controllers\Api\OrderController::class, 'create'])->name('api.order.create');
    Route::put('/order/complete/{id}', [App\Http\Controllers\Api\OrderController::class, 'complete'])->name('api.order.complete');
    Route::put('/order/cancel/{id}', [App\Http\Controllers\Api\OrderController::class, 'cancel'])->name('api.order.cancel');
});
