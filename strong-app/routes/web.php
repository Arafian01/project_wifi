<?php

use App\Http\Controllers\API\LoginAPIController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('user', UserController::class)->middleware('auth');
    Route::resource('paket', PaketController::class)->middleware('auth');
    Route::resource('pelanggan', PelangganController::class)->middleware('auth');
    Route::resource('tagihan', TagihanController::class)->middleware('auth');
    Route::resource('pembayaran', PembayaranController::class)->middleware('auth');

    Route::get('notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi', [NotifikasiController::class, 'store'])->name('notifikasi.store');
    Route::post('/notifikasi/baca/{id}', [NotifikasiController::class, 'baca'])->name('notifikasi.baca');
    Route::put('/notifikasi/{id}', [NotifikasiController::class, 'update'])->name('notifikasi.update');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
    Route::resource('error', ErrorController::class);
});

require __DIR__ . '/auth.php';
