<?php

use App\Http\Middleware\ContentSecurityPolicyMiddleware;
use App\Http\Middleware\HttpsMiddleware;
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
        $middleware->removeFromGroup('web', ValidateCsrfToken::class);
        $middleware->appendToGroup('web', ContentSecurityPolicyMiddleware::class);
        $middleware->append(HttpsMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
