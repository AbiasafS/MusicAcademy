<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

// Route::get('/', function () {
//     return view('welcome');
// });
//enviar directo al login 
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('courses', CourseController::class);
});
