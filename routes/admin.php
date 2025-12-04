<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseUserController;


Route::get('/' , function () {
    return view('dashboard');
})->name('dashboard');


route::resource('roles', RoleController::class);
route::resource('users', UserController::class);
Route::resource('courses', CourseController::class);

Route::prefix('courses')->name('courses.')->group(function () {

    // Vista para asignar usuarios
    Route::get('{course}/assign-users', [CourseUserController::class, 'assignUsers'])
        ->name('assign-users');

    // Acción para asignar un usuario
    Route::post('{course}/assign', [CourseUserController::class, 'assign'])
        ->name('assign');
});

Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');
Route::get('/settings', function () {
    return view('settings.index');
})->name('settings.index');
Route::get('/profile', function () {
    return view('admin.profile.show');
})->name('profile.show');


