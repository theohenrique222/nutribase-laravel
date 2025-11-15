<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\PersonalDatasController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource('diet', DietController::class)->middleware('auth');
Route::resource('clients', ClientsController::class)->middleware('auth');
Route::resource('products', ProductsController::class)->middleware('auth');
Route::get('dashboard', DashboardController::class)->middleware('auth');
