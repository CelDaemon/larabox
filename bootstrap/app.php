<?php

use App\Http\Middleware\CSPMiddleware;
use App\Http\Middleware\HSTSMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->removeFromGroup("web", ValidateCsrfToken::class);
        $middleware->alias(["csp" => CSPMiddleware::class]);
        $middleware->appendToGroup("web", "csp");
        $middleware->append(HSTSMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
