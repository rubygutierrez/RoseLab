<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\EstudianteController;

/*
| Ruta principal
*/

Route::redirect('/', '/dashboard');

/*
| Usuarios sin sesión iniciada
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post')
        ->middleware('throttle:10,1');

});

/*
| Usuarios con sesión iniciada
*/

Route::middleware('auth')->group(function () {

    // Inicio
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Proyectos
    Route::view('/proyectos', 'proyectos.index')
        ->name('proyectos.index');

    // Gestión de equipos
    Route::resource('equipos', EquipoController::class);

    // Registro de estudiantes
    Route::get('/estudiantes/crear', [
        EstudianteController::class,
        'create'
    ])->name('estudiantes.create');

    Route::post('/estudiantes', [
        EstudianteController::class,
        'store'
    ])->name('estudiantes.store');

    // Préstamos
    Route::get('/prestamos', [
        PrestamoController::class,
        'index'
    ])->name('prestamos.index');

    Route::get('/prestamos/crear', [
        PrestamoController::class,
        'create'
    ])->name('prestamos.create');

    Route::post('/prestamos', [
        PrestamoController::class,
        'store'
    ])->name('prestamos.store');

    Route::post('/prestamos/{prestamo}/devolver', [
        PrestamoController::class,
        'devolver'
    ])->name('prestamos.devolver');

});