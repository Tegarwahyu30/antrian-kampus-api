<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;

// GET: ambil semua layanan
Route::get('/services', [ServiceController::class, 'index']);

// TEST API (biar tahu api hidup)
Route::get('/test-api', function () {
    return 'API HIDUP';
});

// POST: tambah layanan baru
Route::post('/services', [ServiceController::class, 'store']);