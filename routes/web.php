<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta pública principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Jetstream (login, registro, etc.)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard normal (NO el admin)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ----------------------------------------------------------
//  GRUPO DE RUTAS PARA EL PANEL ADMIN
// ----------------------------------------------------------
Route::prefix('admin')->name('admin.')->middleware([
    
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard del administrador → http://localhost:8000/admin
    Route::get('/', function () {
        return view('admin.dashboard');  // resources/views/admin/dashboard.blade.php
    })->name('dashboard');

    // CRUD de Roles
    Route::resource('roles', RoleController::class)->names('roles');

    // CRUD de Usuarios
    Route::resource('users', UserController::class)->names('users');
    
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class)->names('courses');

});
