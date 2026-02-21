<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('dosen', DosenController::class);
    Route::resource('mata-kuliah', MataKuliahController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('jadwal', JadwalController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
