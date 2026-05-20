<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UraianController;
use App\Http\Controllers\SubUraianController;
use App\Http\Controllers\RuanganController;

use App\Http\Controllers\InspeksiController;
use App\Http\Controllers\LaporanInspeksiController;

/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/', fn () => redirect()->route('dashboard'));

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */
    Route::prefix('master-data')->name('master-data.')->group(function () {

        Route::resource('kategori', KategoriController::class);
        Route::resource('uraian', UraianController::class);
        Route::resource('sub-uraian', SubUraianController::class);
        Route::resource('ruangan', RuanganController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | INSPEKSI
    |--------------------------------------------------------------------------
    */
    Route::prefix('inspeksi')->name('inspeksi.')->group(function () {

        Route::get('/', [InspeksiController::class, 'index'])->name('index');
        Route::get('/create', [InspeksiController::class, 'create'])->name('create');
        Route::post('/store', [InspeksiController::class, 'store'])->name('store');

        Route::get('/riwayat', [InspeksiController::class, 'riwayat'])->name('riwayat');

        Route::get('/{inspeksi}/hasil', [InspeksiController::class, 'show'])->name('hasil');

        Route::get('/{inspeksi}/edit', [InspeksiController::class, 'edit'])->name('edit');

        Route::put('/{inspeksi}', [InspeksiController::class, 'update'])->name('update');

        Route::delete('/{inspeksi}', [InspeksiController::class, 'destroy'])->name('destroy');

        // ✅ FIX PDF ROUTE (INI YANG KAMU BUTUH)
        Route::get('/{inspeksi}/pdf', [InspeksiController::class, 'cetakPdf'])
            ->name('cetakPdf');
    });

    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('laporan')->name('laporan.')->group(function () {

        Route::get('/inspeksi', [LaporanInspeksiController::class, 'index'])->name('inspeksi');

        Route::get('/inspeksi/pdf', [LaporanInspeksiController::class, 'pdf'])->name('inspeksi.pdf');
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::fallback(function () {
    return redirect()->route('login');
});