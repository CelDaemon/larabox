<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CSPMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = Str::random();
        $request->attributes->set("nonce", $nonce);
        $response = $next($request);
        if ($response->isClientError() || $response->isServerError()) return $response;
        $response->headers->set("Content-Security-Policy",
            $value ?? "script-src 'strict-dynamic' 'nonce-$nonce';style-src 'self' 'nonce-$nonce';object-src 'none';base-uri 'none';frame-ancestors 'none'",
            false);
        return $response;
    }
}
