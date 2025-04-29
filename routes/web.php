<?php

use App\Http\Controllers\CalculationController;
use App\Http\Controllers\DietPlanController;
use App\Http\Controllers\PersonalDatasController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('App');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('personal-datas', PersonalDatasController::class)->middleware(['auth']);
Route::resource('calculation', CalculationController::class)->middleware(['auth']);
Route::resource('diet-plan', DietPlanController::class)->middleware(['auth']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
