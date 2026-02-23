<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\LogController;
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

    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/logs/fetch', [LogController::class, 'fetch'])->name('logs.fetch');
    Route::post('/logs/clear', [LogController::class, 'clear'])->name('logs.clear');

    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

    Route::get('/demo/login', [DemoController::class, 'login'])->name('demo.login');
    Route::get('/demo/register', [DemoController::class, 'register'])->name('demo.register');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
