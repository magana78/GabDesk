<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TechnicianDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:Técnico de soporte'])->group(function () {
    Route::get('/tecnico/dashboard', [TechnicianDashboardController::class, 'index'])->name('tecnico.dashboard');
    
     // Rutas del técnico para gestionar sus tickets
     Route::get('/tecnico', [TicketController::class, 'index'])->name('tecnico.index');
     Route::get('/tecnico/create', [TicketController::class, 'create'])->name('tecnico.create');
     Route::post('/tecnico', [TicketController::class, 'store'])->name('tecnico.store');
      // Ruta para mostrar el formulario de edición de un ticket
    Route::get('/tecnico/{ticket}/edit', [TicketController::class, 'edit'])->name('tecnico.edit');
    
    // Ruta para actualizar el ticket editado
    Route::put('/tecnico/{ticket}', [TicketController::class, 'update'])->name('tecnico.update');
    
    // Ruta para eliminar un ticket
    Route::delete('/tecnico/{ticket}', [TicketController::class, 'destroy'])->name('tecnico.destroy');
});



require __DIR__.'/auth.php';
