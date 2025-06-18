<?php

use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Dokter\ObatController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::get('/restore', [ObatController::class, 'restore'])->name('dokter.obat.restore');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
        Route::patch('/{id}/soft-delete', [ObatController::class, 'softdestroy'])->name('dokter.obat.softdestroy');
    });

    Route::prefix('JadwalPeriksa')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwalPeriksa.index');
        Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwalPeriksa.create');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwalPeriksa.store');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwalPeriksa.update');
    });
    
    Route::prefix('Memeriksa')->group(function () {
        Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
        Route::get('/create/{id}', [MemeriksaController::class, 'create'])->name('dokter.memeriksa.create');
        Route::post('/store', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
        Route::get('/history', [MemeriksaController::class, 'history'])->name('dokter.memeriksa.history');
        Route::get('/detail/{id}', [MemeriksaController::class, 'detail'])->name('dokter.memeriksa.detail');
    });
});