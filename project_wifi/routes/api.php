<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/api/notifikasi', function () {
    return response()->json(App\Models\Notifikasi::latest()->take(5)->get());
});