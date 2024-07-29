<?php

use App\Http\Controllers\Admin\WorkoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::view('/', 'welcome');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Rutas protegidas por middleware 'admin'
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
});

// Rutas para usuarios normales
Route::middleware(['auth'])->group(function () {
    // Aquí puedes añadir rutas específicas para usuarios, como favoritos
});

require __DIR__ . '/auth.php';

