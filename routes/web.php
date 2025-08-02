<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\indexcontroller;
use App\Http\Controllers\mocicontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', [indexcontroller::class, 'index']);


Route::get('/admin', function () {
    return view('admin.content');
});




Route::middleware('web')->group(function () {
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.content');
    });
});


Route::get('/moci', [mocicontroller::class, 'index']); 
Route::get('/moci/data', [mocicontroller::class, 'data']);
Route::post('/moci/store', [mocicontroller::class, 'store']); 
Route::get('/moci/{id}', [mocicontroller::class, 'show']); 
Route::post('/moci/{id}', [mocicontroller::class, 'update']); 
Route::delete('/moci/{id}', [mocicontroller::class, 'destroy']);