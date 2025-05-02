<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $exception, Request $request){
            return response(
                content: [
                    "success" => false,
                    "message" => "Validation failed",
                    "fails" => $exception->errors()
                ],
                status: $exception->status,
                headers: [
                    'Content-Type => application/json'
                ]
            );
        });

    })->create();
