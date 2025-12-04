<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;

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
    // Dashboard único → el contenido se decide en la vista según el rol
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ----------------------------------------------------------
//  GRUPO DE RUTAS PARA EL PANEL ADMIN (solo admin)
// ----------------------------------------------------------
Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin', // 👈 Solo admin
])->group(function () {
    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('courses', CourseController::class)->names('courses');

    Route::get('courses/assign-users', [CourseController::class, 'assignUsers'])
        ->name('courses.assign-users');
    Route::post('courses/assign-users', [CourseController::class, 'storeUserAssignment'])
        ->name('courses.store-user-assignment');
});

// ----------------------------------------------------------
//  GRUPO DE RUTAS PARA INSTRUCTORES (solo instructor)
// ----------------------------------------------------------
Route::prefix('instructor')->name('instructor.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:instructor', // 👈 Solo instructor
])->group(function () {
    Route::resource('courses', CourseController::class)->names('courses');
});

// ----------------------------------------------------------
//  GRUPO DE RUTAS PARA ESTUDIANTES (solo student)
// ----------------------------------------------------------
Route::prefix('student')->name('student.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:student', // 👈 Solo student
])->group(function () {
    // Aquí puedes poner rutas específicas para estudiantes si lo necesitas
});
Route::get('/info', function () {
    return view('student.info');
})->name('student.info');


// ----------------------------------------------------------
//  LOGOUT
// ----------------------------------------------------------
Route::post('/logout', function () {
    Auth::guard('web')->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->middleware('auth')->name('logout');