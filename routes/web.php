<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardRedirectorController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Pasien\BookingController;


// Rute Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Rute yang akan mengarahkan user setelah login berdasarkan rolenya
Route::get('/dashboard', DashboardRedirectorController::class)
    ->middleware(['auth'])
    ->name('dashboard');

// Rute untuk Halaman Profil (bawaan Breeze)
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
    Route::resource('polis', PoliController::class);
    
    // Rute CRUD untuk Manajemen Dokter dan Jadwalnya (Nested)
    Route::resource('doctors', DoctorController::class);
    Route::resource('doctors.schedules', DoctorScheduleController::class)->shallow();
});

// Rute untuk Dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dashboard');
});

// Rute untuk Kasir
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', function () {
        // Kita akan buat view-nya nanti
        return "<h1>Ini Dashboard Kasir</h1>";
    })->name('dashboard');
});

// Ganti blok rute Pasien yang lama dengan yang ini
// Rute untuk Pasien
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('dashboard');

    // Rute untuk Alur Booking
    Route::get('/booking/pilih-poli', [BookingController::class, 'stepOne'])->name('booking.step-one');
    Route::get('/booking/pilih-dokter/{poli}', [BookingController::class, 'stepTwo'])->name('booking.step-two');
    Route::get('/booking/pilih-jadwal/{doctor}', [BookingController::class, 'stepThree'])->name('booking.step-three');
    Route::post('/booking/simpan', [BookingController::class, 'store'])->name('booking.store');
});

// Meng-include file rute autentikasi bawaan Breeze
require __DIR__.'/auth.php';