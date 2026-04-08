<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InformasiLokerApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route bawaan (boleh dipakai)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 🔐 AUTH API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔒 PROTECTED ROUTE
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

Route::get('/loker', [InformasiLokerApiController::class, 'index']);
Route::get('/loker/{id}', [InformasiLokerApiController::class, 'show']);
Route::post('/loker', [InformasiLokerApiController::class, 'store']);
Route::put('/loker/{id}', [InformasiLokerApiController::class, 'update']);
Route::delete('/loker/{id}', [InformasiLokerApiController::class, 'destroy']);



