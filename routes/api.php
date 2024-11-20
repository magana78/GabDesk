<?php
// routes/api.php

use App\Http\Controllers\Android\AuthAndroidController;
use Illuminate\Support\Facades\Route;

// Rutas para autenticación
Route::post('/login', [AuthAndroidController::class, 'login']);
Route::post('/logout', [AuthAndroidController::class, 'logout']);
Route::get('/hello', function () {
    return 'Hello, World!';
});
