<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UraianController;
use App\Http\Controllers\SubUraianController;
use App\Http\Controllers\RuanganController;

use App\Http\Controllers\InspeksiController;
use App\Http\Controllers\RiwayatInspeksiController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ROOT
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

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
    | INSPEKSI MODULE (FIXED TOTAL FLOW)
    |--------------------------------------------------------------------------
    */
    Route::prefix('inspeksi')->name('inspeksi.')->group(function () {

        /*
        | FORM INSPEKSI
        */
        Route::get('/', [InspeksiController::class, 'index'])
            ->name('index');

        Route::get('/create', [InspeksiController::class, 'create'])
            ->name('create');

        Route::post('/store', [InspeksiController::class, 'store'])
            ->name('store');

        Route::get('/{inspeksi}/hasil', [InspeksiController::class, 'show'])
            ->name('hasil');

        /*
        | EDIT
        */
        Route::get('/{inspeksi}/edit', [InspeksiController::class, 'edit'])
            ->name('edit');

        /*
        | UPDATE
        */
        Route::put('/{inspeksi}', [InspeksiController::class, 'update'])
            ->name('update');

        /*
        | DELETE
        */
        Route::delete('/{inspeksi}', [InspeksiController::class, 'destroy'])
            ->name('destroy');

        /*
        | RIWAYAT
        */
        Route::get('/riwayat', [RiwayatInspeksiController::class, 'index'])
            ->name('riwayat');

    });

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

});

/*
|--------------------------------------------------------------------------
| FALLBACK
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return redirect()->route('login');
});