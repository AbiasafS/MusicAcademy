<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/' , function () {
    return view('dashboard');
})->name('dashboard');


route::resource('roles', RoleController::class);
route::resource('users', UserController::class);
Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');
Route::get('/settings', function () {
    return view('settings.index');
})->name('settings.index');
Route::get('/profile', function () {
    return view('admin.profile.show');
})->name('profile.show');

