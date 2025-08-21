<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\VacacionController; // <-- agrega esta línea

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn() => auth()->user());

    // Rutas de reportes
    Route::get('/reports', [ReportController::class, 'index']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::patch('/reports', [ReportController::class, 'updateStatus']);

    // Rutas de vacaciones
    Route::get('/vacaciones', [VacacionController::class, 'index']);  // listar vacaciones
    Route::post('/vacaciones', [VacacionController::class, 'store']); // crear solicitud
});