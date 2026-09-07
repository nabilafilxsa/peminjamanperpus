<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\User\KatalogController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ==================== GRUP UNTUK USER (SISWA) ====================
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard / Katalog Buku untuk Siswa
    Route::get('/dashboard', [KatalogController::class, 'index'])->name('dashboard');

    // Proses peminjaman buku
    Route::post('/dashboard/pinjam', [KatalogController::class, 'store'])->name('user.pinjam');

    // Proses pengembalian buku (mandiri)
    Route::patch('/dashboard/kembali/{peminjaman}', [KatalogController::class, 'kembali'])->name('user.kembali');
});

// ==================== GRUP UNTUK ADMIN ====================
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Buku
    Route::resource('/admin/buku', BukuController::class, ['as' => 'admin']);

    // CRUD Peminjaman (Admin)
    Route::resource('/admin/peminjaman', PeminjamanController::class, ['as' => 'admin']);

    // Route khusus untuk pengembalian oleh admin
    Route::patch('/admin/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.kembali');
});

// Profile (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';