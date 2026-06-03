<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Login & Logout
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang Dilindungi (Wajib Login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ubah path jadi /inventory tapi nama route tetap barang.*
    Route::resource('inventory', BarangController::class)->names('barang');
    Route::resource('supplier', SupplierController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);
    
    // Atribut Barang
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});