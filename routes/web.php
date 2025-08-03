<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\indexcontroller;
use App\Http\Controllers\mocicontroller;
use Illuminate\Support\Facades\Route;

// Rute untuk publik (halaman utama)
Route::get('/', [indexcontroller::class, 'index']);

// Rute untuk tamu (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// --- RUTE ADMIN ---
// Semua rute di dalam grup ini akan memiliki prefix /admin
// dan memerlukan otentikasi (login)
Route::middleware('auth')->prefix('admin')->group(function () {
    // Arahkan /admin ke /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('admin.index');

    // Rute dashboard
    Route::get('/dashboard', function () {
        return view('admin.app');
    })->name('admin.dashboard');

    // Rute logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin', [mocicontroller::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');

    // Rute untuk CRUD Moci
    Route::prefix('moci')->name('moci.')->group(function () {
        Route::get('/', [mocicontroller::class, 'index'])->name('index');
        Route::get('/data', [mocicontroller::class, 'data'])->name('data');
        Route::post('/store', [mocicontroller::class, 'store'])->name('store');
        Route::get('/{id}', [mocicontroller::class, 'show'])->name('show');
        Route::post('/{id}', [mocicontroller::class, 'update'])->name('update');
        Route::delete('/{id}', [mocicontroller::class, 'destroy'])->name('destroy');
        
    });
});