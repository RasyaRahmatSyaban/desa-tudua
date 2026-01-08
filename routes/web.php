<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DanaDesaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratDesaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DanaKeluarController;
use App\Http\Controllers\DanaMasukController;
use App\Http\Controllers\KepalaKeluargaController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UserController;

// Public Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profil', [PerangkatDesaController::class, 'index'])->name('profil');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Public Berita Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Public Pengumuman Routes
Route::get('/arsip', [SuratDesaController::class, 'index'])->name('arsip');

// Public Data Routes
Route::get('/data-penduduk', [PendudukController::class, 'index'])->name('data-penduduk');

// Public dana routes
Route::get('/dana-desa', [DanaDesaController::class, 'index'])->name('dana-desa');

// Public media routes
Route::get('/media', [MediaController::class, 'index'])->name('media');

// Public Pelayanan Routes
Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::put('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');

// Admin Routes Group
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Berita Routes
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/create', [BeritaController::class, 'create'])->name('create');
        Route::post('/store', [BeritaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('destroy');
    });

    // Pengumuman Routes
    Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('index');
        Route::get('/create', [PengumumanController::class, 'create'])->name('create');
        Route::post('/store', [PengumumanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PengumumanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PengumumanController::class, 'update'])->name('update');
        Route::delete('/{id}', [PengumumanController::class, 'destroy'])->name('destroy');
    });

    // Penduduk Routes
    Route::prefix('penduduk')->name('penduduk.')->group(function () {
        Route::get('/', [PendudukController::class, 'index'])->name('index');
        Route::get('/create', [PendudukController::class, 'create'])->name('create');
        Route::post('/store', [PendudukController::class, 'store'])->name('store');
        Route::get('/{id}', [PendudukController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PendudukController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PendudukController::class, 'update'])->name('update');
        Route::delete('/{id}', [PendudukController::class, 'destroy'])->name('destroy');
    });

    // Perangkat Desa Routes
    Route::prefix('perangkat-desa')->name('perangkat-desa.')->group(function () {
        Route::get('/', [PerangkatDesaController::class, 'index'])->name('index');
        Route::get('/create', [PerangkatDesaController::class, 'create'])->name('create');
        Route::post('/store', [PerangkatDesaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PerangkatDesaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PerangkatDesaController::class, 'update'])->name('update');
        Route::delete('/{id}', [PerangkatDesaController::class, 'destroy'])->name('destroy');
    });

    // Pelayanan Routes
    Route::prefix('pelayanan')->name('pelayanan.')->group(function () {
        Route::get('/', [PelayananController::class, 'index'])->name('index');
        Route::get('/create', [PelayananController::class, 'create'])->name('create');
        Route::post('/store', [PelayananController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PelayananController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PelayananController::class, 'update'])->name('update');
        Route::delete('/{id}', [PelayananController::class, 'destroy'])->name('destroy');
    });

    // Media Routes
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::get('/create', [MediaController::class, 'create'])->name('create');
        Route::post('/store', [MediaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MediaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MediaController::class, 'update'])->name('update');
        Route::delete('/{id}', [MediaController::class, 'destroy'])->name('destroy');
    });

    // Surat Masuk Routes
    Route::prefix('surat-masuk')->name('surat-masuk.')->group(function () {
        Route::get('/', [SuratMasukController::class, 'index'])->name('index');
        Route::get('/create', [SuratMasukController::class, 'create'])->name('create');
        Route::post('/store', [SuratMasukController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SuratMasukController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SuratMasukController::class, 'update'])->name('update');
        Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->name('destroy');
    });

    // Surat Keluar Routes
    Route::prefix('surat-keluar')->name('surat-keluar.')->group(function () {
        Route::get('/', [SuratKeluarController::class, 'index'])->name('index');
        Route::get('/create', [SuratKeluarController::class, 'create'])->name('create');
        Route::post('/store', [SuratKeluarController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SuratKeluarController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SuratKeluarController::class, 'update'])->name('update');
        Route::delete('/{id}', [SuratKeluarController::class, 'destroy'])->name('destroy');
    });

    // Dana Masuk Routes
    Route::prefix('dana-masuk')->name('dana-masuk.')->group(function () {
        Route::get('/', [DanaMasukController::class, 'index'])->name('index');
        Route::get('/create', [DanaMasukController::class, 'create'])->name('create');
        Route::post('/store', [DanaMasukController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DanaMasukController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DanaMasukController::class, 'update'])->name('update');
        Route::delete('/{id}', [DanaMasukController::class, 'destroy'])->name('destroy');
    });

    // Dana Keluar Routes
    Route::prefix('dana-keluar')->name('dana-keluar.')->group(function () {
        Route::get('/', [DanaKeluarController::class, 'index'])->name('index');
        Route::get('/create', [DanaKeluarController::class, 'create'])->name('create');
        Route::post('/store', [DanaKeluarController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DanaKeluarController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DanaKeluarController::class, 'update'])->name('update');
        Route::delete('/{id}', [DanaKeluarController::class, 'destroy'])->name('destroy');
    });

    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    });

});
