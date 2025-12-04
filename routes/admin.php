<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/' , function () {
    return view('dashboard');
})->name('dashboard');


route::resource('roles', RoleController::class);
route::resource('users', UserController::class);
