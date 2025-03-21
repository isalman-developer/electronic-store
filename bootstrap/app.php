<?php

use Illuminate\Foundation\Application;
use App\Exceptions\LogValidationsExceptions;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ValidationException $exception, $request) {

            $errors = $exception->validator->errors()->toArray();
            $logValidationExeptions = new LogValidationsExceptions();
            $logValidationExeptions->logErrors($request, $errors);
        });
    })->create();
