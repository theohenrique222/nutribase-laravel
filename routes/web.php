<?php

use App\Http\Controllers\CoachController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CustomDietController;
use App\Http\Controllers\DietPlanController;
use App\Http\Controllers\PersonalDatasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DietController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('App');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('profile', ProfileController::class)->middleware(['auth']);
Route::resource('personal-datas', PersonalDatasController::class)->middleware(['auth']);
Route::resource('calculation', CalculationController::class)->middleware(['auth']);
Route::resource('diet-plan', DietPlanController::class)->middleware(['auth']);
Route::resource('custom-diet', CustomDietController::class)->middleware('auth');
Route::resource('measurements', MeasurementsController::class)->middleware(['auth']);
Route::post('/diets/generate', [App\Http\Controllers\DietPlanController::class, 'generate']);
Route::resource('students', StudentController::class)->middleware(['auth']);
Route::resource('coach', CoachController::class)->middleware(['auth']);
Route::resource('diet', DietController::class)->middleware(['auth']);

// Route::post('/api/generate-diet', [AiController::class, 'generateDiet']);



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
