<?php
// routes/api.php

use App\Http\Controllers\Android\AuthAndroidController;
use Illuminate\Support\Facades\Route;

// Rutas para autenticación
Route::post('/login', [AuthAndroidController::class, 'login']);
Route::post('/logout', [AuthAndroidController::class, 'logout']);
Route::get('/departamento/{idUsuario}', [AuthAndroidController::class, 'getDepartamento']);
Route::get('/cubiculo/{idUsuario}', [AuthAndroidController::class, 'getCubiculo']);
Route::get('/equipos/{idUsuario}', [AuthAndroidController::class, 'getEquipos']);
Route::get('equipos/area/{areaId}', [AuthAndroidController::class, 'getEquiposPorArea']);
Route::get('/usuarios/area/{id_area}', [AuthAndroidController::class, 'getUsuariosPorArea']);
Route::post('/change-password', [AuthAndroidController::class, 'changePassword']);
Route::post('/crear-ticket', [AuthAndroidController::class, 'crearTicket']);

// Rutas para subir evidencias e imágenes
Route::post('tickets/{ticketId}/evidencias', [AuthAndroidController::class, 'subirEvidenciaPorTicket']);
Route::post('/equipos/{equipoId}/imagen', [AuthAndroidController::class, 'subirImagenPorEquipo']);

// Ruta para eliminar imágenes por equipo
Route::delete('/equipos/{equipoId}/deleteimagenes', [AuthAndroidController::class, 'eliminarImagenesPorEquipo']);

Route::get('/tickets/area/{areaId}', [AuthAndroidController::class, 'getTicketsPorArea']);

Route::get('/equipo/{equipoId}', [AuthAndroidController::class, 'getEquipoDetalles']);

Route::get('ticket/{ticketId}', [AuthAndroidController::class, 'getTicketDetalles']);


// Ruta de prueba
Route::get('/hello', function () {
    return 'Hello, World!';
});
