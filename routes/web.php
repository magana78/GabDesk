<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\TecnicoController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SoporteTecnicoController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\TechnicianDashboardController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\AdminDashboardController as AdminAdminDashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EquipoGestionController;
use App\Http\Controllers\ImagenEquipoGestionController;
use App\Http\Controllers\UsuarioEquipoGestionController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas de perfil para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para el Administrador
Route::middleware(['auth', 'role:Administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Gestión de roles y permisos
        Route::get('roles/{role}/permissions', [RolePermissionController::class, 'index'])->name('roles.permissions.index');
        Route::post('roles/{role}/permissions', [RolePermissionController::class, 'store'])->name('roles.permissions.store');
        Route::get('/tickets/data', [TicketController::class, 'getAdminTicketData'])->name('tickets.data');
        Route::put('/ticket/{id}/cerrar', [TicketController::class, 'cerrarTicket'])->name('cerrarTicket');
// web.php o api.php
Route::get('/usuarios/tecnicos', [TicketController::class, 'getTecnicosSoporte'])->name('usuarios.tecnicos');

        // Gestión de tickets
        Route::prefix('tickets')->name('tickets.')->group(function () {
            Route::get('/', [TicketController::class, 'adminIndex'])->name('index');
            Route::get('/{ticket}/ver', [TicketController::class, 'vista'])->name('vista');
            Route::put('/tickets/{ticket}/cambiarEstado', [TicketController::class, 'cambiarEstadoAdmin'])->name('tickets.cambiarEstado');
            Route::post('/tickets/{ticket}/asignar', [TicketController::class, 'asignarAdmin'])->name('tickets.asignar');

        });

        // Ruta de registro de usuarios solo para administradores
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
        Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
        Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');

         // Rutas AJAX para listas desplegables dinámicas
         Route::get('/admin/ajax/areas/{id_departamento}', [AjaxController::class, 'getAreasByDepartamento'])->name('ajax.getAreas');
         Route::get('/admin/ajax/ubicaciones/{id_area}', [AjaxController::class, 'getUbicacionesByArea'])->name('ajax.getUbicaciones');
         Route::get('/admin/ajax/cubiculos/{id_ubicacion}', [AjaxController::class, 'getCubiculosByUbicacion'])->name('ajax.getCubiculos');
    });

    
    

// Rutas para el Técnico de Soporte
Route::middleware(['auth', 'role:Técnico de soporte'])
    ->prefix('tecnico')
    ->name('tecnico.')
    ->group(function () {
        Route::get('/dashboard', [TechnicianDashboardController::class, 'index'])->name('dashboard');
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::get('/{ticket}/edit', [TicketController::class, 'edit'])->name('edit');
        Route::put('/{ticket}', [TicketController::class, 'update'])->name('update');
        Route::delete('/{ticket}', [TicketController::class, 'destroy'])->name('destroy');

        // Rutas específicas para tickets
        Route::post('/tomar/{id}', [TicketController::class, 'tomar'])->name('tomar');
        Route::get('/asignar/{id}', [TicketController::class, 'asignarForm'])->name('asignar');
        Route::post('/asignar/{id}', [TicketController::class, 'asignar'])->name('asignar.post');
        Route::get('/cambiarEstado/{id}', [TicketController::class, 'cambiarEstadoForm'])->name('cambiarEstado');
        Route::post('/cambiarEstado/{id}', [TicketController::class, 'cambiarEstado'])->name('cambiarEstado.post');
        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('show');
        Route::post('/tickets/{ticket}/evidencias', [TicketController::class, 'uploadEvidencia'])->name('uploadEvidencia');
        Route::delete('/evidencias/{id}', [TicketController::class, 'deleteEvidencia'])->name('evidencias.delete');
        Route::post('/tickets/{id}/observacion', [TicketController::class, 'agregarObservacion'])->name('agregarObservacion');
        Route::get('/tickets/{ticket}/detalle', [TicketController::class, 'detalle'])->name('detalle');
        Route::put('/ticket/{id}/cerrar', [TicketController::class, 'cerrarTicket'])->name('cerrarTicket');
        Route::get('/estado/{estado}', [TicketController::class, 'filterByState'])->name('filterByState');
        Route::get('/filter/{estado?}', [TicketController::class, 'filterTickets'])->name('filterTickets');
        Route::get('equipos/estado/{estado}', [EquipoController::class, 'equiposPorEstado'])->name('equipos.estado');
        Route::put('/equipo/{id}/cambiar-estado', [EquipoController::class, 'cambiarEstadoEquipo'])->name('cambiarEstadoEquipo');
        Route::put('/tecnico/ticket/{id}/cerrar', [TicketController::class, 'cerrarTicket'])->name('cerrarTicket');
        Route::get('/tecnico/tickets/data', [TicketController::class, 'getTicketData'])->name('tickets.data');
        Route::get('/tecnico/tickets/statistics', [TicketController::class, 'getTicketStatistics'])->name('tickets.statistics');
        Route::get('/carteras/filtrar', [TicketController::class, 'mostrarFormulario'])->name('carteras.filtrar');

        Route::get('/filtrar-areas', [TicketController::class, 'filtrarAreas'])->name('filtrar.areas');
        Route::get('/filtrar-ubicaciones', [TicketController::class, 'filtrarUbicaciones'])->name('filtrar.ubicaciones');
        Route::get('/filtrar-cubiculos', [TicketController::class, 'filtrarCubiculos'])->name('filtrar.cubiculos');
        Route::get('/obtener-informacion-soporte', [TicketController::class, 'obtenerInformacionSoporte'])->name('informacion.soporte');
        
        // 
        // Ruta para gestionar equipos (mostrar todos los equipos)
        Route::get('/equipos', [EquipoGestionController::class, 'index'])->name('equipos.gestion.index');
        Route::get('/equipos/create', [EquipoGestionController::class, 'create'])->name('equipos.gestion.create');
        Route::post('/equipos', [EquipoGestionController::class, 'store'])->name('equipos.gestion.store');
        Route::get('/equipos/{equipo}', [EquipoGestionController::class, 'show'])->name('equipos_gestion_show');
        Route::post('/equipos/{equipo}/add-accessory', [EquipoGestionController::class, 'addAccessory'])->name('equipos.gestion.addAccessory');

        Route::get('/equipos/{equipo}/add-image', [ImagenEquipoGestionController::class, 'create'])->name('equipos.gestion.addImage');
        Route::post('/equipos/{equipo}/store-image', [ImagenEquipoGestionController::class, 'store'])->name('equipos.gestion.storeImage');

        Route::get('/equipos/{equipo}/assign-user', [UsuarioEquipoGestionController::class, 'assignForm'])->name('equipos.gestion.assignUser');
        Route::post('/equipos/{equipo}/assign-user', [UsuarioEquipoGestionController::class, 'assign'])->name('equipos.gestion.assign');
       
    });