<?php

use App\Http\Controllers\DashboardRedirectorController;
use App\Http\Controllers\ProfileController; // <-- TAMBAHKAN BARIS INI
use Illuminate\Support\Facades\Route;

// Rute Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Rute yang akan mengarahkan user setelah login berdasarkan rolenya
Route::get('/dashboard', DashboardRedirectorController::class)
    ->middleware(['auth'])
    ->name('dashboard');

// Rute untuk Halaman Profil (bawaan Breeze)
// Pastikan middleware-nya hanya 'auth' agar bisa diakses semua role yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// === GRUP RUTE UNTUK SETIAP ROLE ===

// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Rute CRUD untuk Manajemen Poli
    Route::resource('polis', \App\Http\Controllers\Admin\PoliController::class);
    // Rute CRUD untuk Manajemen Dokter
    Route::resource('doctors', \App\Http\Controllers\Admin\DoctorController::class);

});

// Rute untuk Dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard'); // Arahkan ke view dokter
    })->name('dashboard');
});

// Rute untuk Kasir
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', function () {
        return "<h1>Ini Dashboard Kasir</h1>";
    })->name('dashboard');
});

// Rute untuk Pasien
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', function () {
        return "<h1>Ini Dashboard Pasien</h1>";
    })->name('dashboard');
});


// Meng-include file rute autentikasi bawaan Breeze
require __DIR__.'/auth.php';