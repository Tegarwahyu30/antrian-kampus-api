<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\AntrianController;
use App\Http\Controllers\Api\AuthController;

// TEST API
Route::get('/test-api', function () {
    return 'API HIDUP';
});

// SERVICES
Route::get('/services', [ServiceController::class, 'index']);
Route::post('/services', [ServiceController::class, 'store']);

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// ANTRIAN (CRUD LENGKAP)
Route::get('/antrians', [AntrianController::class, 'index']);
Route::post('/antrians', [AntrianController::class, 'store']);
Route::get('/antrians/{id}', [AntrianController::class, 'show']);
Route::put('/antrians/{id}', [AntrianController::class, 'update']);
Route::delete('/antrians/{id}', [AntrianController::class, 'destroy']);