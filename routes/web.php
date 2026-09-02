<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CategoryController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('places', PlaceController::class)
    ->only(['index', 'store', 'update', 'destroy']);

Route::resource('categories', CategoryController::class)
    ->only(['index', 'store', 'update', 'destroy']);