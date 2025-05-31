<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::middleware('auth:api')
    ->get('/summary', [App\Http\Controllers\Api\SummaryController::class, 'index'])->name('dashboard.index');
