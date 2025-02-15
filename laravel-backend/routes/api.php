<?php

use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('pakets', PaketController::class);
Route::get('/pelanggan/total', [PelangganController::class, 'index']);
