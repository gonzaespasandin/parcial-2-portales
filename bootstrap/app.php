<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Session;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function(){
            Session::flash('feedback.message', 'Debes iniciar sesión para acceder a esta página');
            Session::flash('feedback.type', 'danger');
            return route('auth.login.show');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
