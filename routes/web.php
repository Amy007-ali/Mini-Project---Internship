<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect()->route('places.index');
});

Route::resource('places', PlaceController::class);

Route::resource('categories', CategoryController::class);