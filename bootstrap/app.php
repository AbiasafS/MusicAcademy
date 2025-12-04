<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {

            // Rutas protegidas para admin:
            Route::middleware([
                'web',
                'auth',                       // se usa auth normal (Fortify)
                'verified',                   // verificación email (si aplica)
            ])
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Aquí puedes agregar middleware global si lo necesitas en el futuro
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
