<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dokter/dashboard', function () {
    return view('dokter.index');
})->name('dokter.dashboard')->middleware(['auth', 'verified', RoleMiddleware::class . ':dokter']);

Route::get('pasien/dashboard', function () {
    return view('pasien.index');
})->name('pasien.dashboard')->middleware(['auth', 'verified', RoleMiddleware::class . ':pasien']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';