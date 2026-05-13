<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;

// 1. Halaman Depan Aplikasi
Route::get('/', function () {
    return view('welcome');
});

// 2. Dashboard Utama (Multi-role Landing)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. Manajemen Profil Pengguna (Bawaan Breeze/Jetstream)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Area Khusus Administrator
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/tools', function () {
        return "Selamat datang Admin! Anda punya akses teknis tinggi."; 
    });
});

// 5. Area Khusus Pustakawan MacaBae (CRUD Buku Diringkas Sempurna)
Route::middleware(['auth', 'role:pustakawan'])->prefix('pustakawan')->name('pustakawan.')->group(function () {
    
    // 1. SUNTIKKAN RUTE BARU INI TEPAT DI ATAS RESOURCE BUKU
    Route::delete('buku/destroy-multiple', [BukuController::class, 'destroyMultiple'])->name('buku.destroy-multiple');

    // 2. Baris resource bawaan proyekmu yang sudah ada sebelumnya
    Route::resource('buku', BukuController::class);
    Route::resource('kategori', KategoriController::class);
    
});

// 6. Area Khusus Member/Pembaca Terdaftar
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::post('/pinjam/{bukuId}', [PeminjamanController::class, 'store'])->name('pinjam.buku');
});

require __DIR__.'/auth.php';