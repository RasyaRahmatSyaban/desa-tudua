<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Public Berita Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Public Pengumuman Routes
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');

// Public Data Routes
Route::get('/data-penduduk', [PendudukController::class, 'index'])->name('data-penduduk');
Route::get('/dana-desa', function () {
    return view('dana-desa');
})->name('dana-desa');

// Public Pelayanan Routes
// Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes Group
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Berita Routes
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/create', [BeritaController::class, 'create'])->name('create');
        Route::post('/store', [BeritaController::class, 'store'])->name('store');
        Route::get('/{id}', [BeritaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [BeritaController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [BeritaController::class, 'exportPdf'])->name('export.pdf');
    });

    // Pengumuman Routes
    Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('index');
        Route::get('/create', [PengumumanController::class, 'create'])->name('create');
        Route::post('/store', [PengumumanController::class, 'store'])->name('store');
        Route::get('/{id}', [PengumumanController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PengumumanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PengumumanController::class, 'update'])->name('update');
        Route::delete('/{id}', [PengumumanController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [PengumumanController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [PengumumanController::class, 'exportPdf'])->name('export.pdf');
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
        Route::get('/export/excel', [PendudukController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [PendudukController::class, 'exportPdf'])->name('export.pdf');
    });

    // Kepala Keluarga Routes
    Route::prefix('kepala-keluarga')->name('kepala-keluarga.')->group(function () {
        Route::get('/', [KepalaKeluargaController::class, 'index'])->name('index');
        Route::get('/create', [KepalaKeluargaController::class, 'create'])->name('create');
        Route::post('/store', [KepalaKeluargaController::class, 'store'])->name('store');
        Route::get('/{id}', [KepalaKeluargaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [KepalaKeluargaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KepalaKeluargaController::class, 'update'])->name('update');
        Route::delete('/{id}', [KepalaKeluargaController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [KepalaKeluargaController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [KepalaKeluargaController::class, 'exportPdf'])->name('export.pdf');
    });

    // Perangkat Desa Routes
    Route::prefix('perangkat-desa')->name('perangkat-desa.')->group(function () {
        Route::get('/', [PerangkatDesaController::class, 'index'])->name('index');
        Route::get('/create', [PerangkatDesaController::class, 'create'])->name('create');
        Route::post('/store', [PerangkatDesaController::class, 'store'])->name('store');
        Route::get('/{id}', [PerangkatDesaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PerangkatDesaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PerangkatDesaController::class, 'update'])->name('update');
        Route::delete('/{id}', [PerangkatDesaController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [PerangkatDesaController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [PerangkatDesaController::class, 'exportPdf'])->name('export.pdf');
    });

    // Pelayanan Routes
    Route::prefix('pelayanan')->name('pelayanan.')->group(function () {
        Route::get('/', [PelayananController::class, 'index'])->name('index');
        Route::get('/create', [PelayananController::class, 'create'])->name('create');
        Route::post('/store', [PelayananController::class, 'store'])->name('store');
        Route::get('/{id}', [PelayananController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PelayananController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PelayananController::class, 'update'])->name('update');
        Route::delete('/{id}', [PelayananController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [PelayananController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [PelayananController::class, 'exportPdf'])->name('export.pdf');
    });

    // Media Routes
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::get('/create', [MediaController::class, 'create'])->name('create');
        Route::post('/store', [MediaController::class, 'store'])->name('store');
        Route::get('/{id}', [MediaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MediaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MediaController::class, 'update'])->name('update');
        Route::delete('/{id}', [MediaController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [MediaController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [MediaController::class, 'exportPdf'])->name('export.pdf');
    });

    // Surat Masuk Routes
    Route::prefix('surat-masuk')->name('surat-masuk.')->group(function () {
        Route::get('/', [SuratMasukController::class, 'index'])->name('index');
        Route::get('/create', [SuratMasukController::class, 'create'])->name('create');
        Route::post('/store', [SuratMasukController::class, 'store'])->name('store');
        Route::get('/{id}', [SuratMasukController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [SuratMasukController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SuratMasukController::class, 'update'])->name('update');
        Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [SuratMasukController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [SuratMasukController::class, 'exportPdf'])->name('export.pdf');
    });

    // Surat Keluar Routes
    Route::prefix('surat-keluar')->name('surat-keluar.')->group(function () {
        Route::get('/', [SuratKeluarController::class, 'index'])->name('index');
        Route::get('/create', [SuratKeluarController::class, 'create'])->name('create');
        Route::post('/store', [SuratKeluarController::class, 'store'])->name('store');
        Route::get('/{id}', [SuratKeluarController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [SuratKeluarController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SuratKeluarController::class, 'update'])->name('update');
        Route::delete('/{id}', [SuratKeluarController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [SuratKeluarController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [SuratKeluarController::class, 'exportPdf'])->name('export.pdf');
    });

    // Dana Masuk Routes
    Route::prefix('dana-masuk')->name('dana-masuk.')->group(function () {
        Route::get('/', [DanaMasukController::class, 'index'])->name('index');
        Route::get('/create', [DanaMasukController::class, 'create'])->name('create');
        Route::post('/store', [DanaMasukController::class, 'store'])->name('store');
        Route::get('/{id}', [DanaMasukController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [DanaMasukController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DanaMasukController::class, 'update'])->name('update');
        Route::delete('/{id}', [DanaMasukController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [DanaMasukController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [DanaMasukController::class, 'exportPdf'])->name('export.pdf');
    });

    // Dana Keluar Routes
    Route::prefix('dana-keluar')->name('dana-keluar.')->group(function () {
        Route::get('/', [DanaKeluarController::class, 'index'])->name('index');
        Route::get('/create', [DanaKeluarController::class, 'create'])->name('create');
        Route::post('/store', [DanaKeluarController::class, 'store'])->name('store');
        Route::get('/{id}', [DanaKeluarController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [DanaKeluarController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DanaKeluarController::class, 'update'])->name('update');
        Route::delete('/{id}', [DanaKeluarController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [DanaKeluarController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [DanaKeluarController::class, 'exportPdf'])->name('export.pdf');
    });

    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [UserController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [UserController::class, 'exportPdf'])->name('export.pdf');
        Route::put('/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        Route::put('/{id}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    });

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('index');
        Route::put('/update', [UserController::class, 'updateProfile'])->name('update');
        Route::put('/change-password', [UserController::class, 'changePassword'])->name('change-password');
    });

    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return view('admin.settings.index');
        })->name('index');
        Route::put('/update', [UserController::class, 'updateSettings'])->name('update');
    });

    // Reports Routes
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', function () {
            return view('admin.reports.index');
        })->name('index');
        Route::get('/penduduk', [PendudukController::class, 'reportPenduduk'])->name('penduduk');
        Route::get('/keuangan', function () {
            return view('admin.reports.keuangan');
        })->name('keuangan');
        Route::get('/surat', function () {
            return view('admin.reports.surat');
        })->name('surat');
    });

    // Backup Routes
    Route::prefix('backup')->name('backup.')->group(function () {
        Route::get('/', function () {
            return view('admin.backup.index');
        })->name('index');
        Route::post('/create', [UserController::class, 'createBackup'])->name('create');
        Route::get('/download/{file}', [UserController::class, 'downloadBackup'])->name('download');
        Route::delete('/delete/{file}', [UserController::class, 'deleteBackup'])->name('delete');
    });
});

// API Routes (untuk AJAX requests)
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/penduduk/search', [PendudukController::class, 'apiSearch'])->name('penduduk.search');
    Route::get('/kepala-keluarga/search', [KepalaKeluargaController::class, 'apiSearch'])->name('kepala-keluarga.search');
    Route::get('/dashboard/stats', [UserController::class, 'getDashboardStats'])->name('dashboard.stats');
    Route::get('/chart/penduduk', [PendudukController::class, 'getChartData'])->name('chart.penduduk');
    Route::get('/chart/keuangan', [DanaMasukController::class, 'getChartData'])->name('chart.keuangan');
});
