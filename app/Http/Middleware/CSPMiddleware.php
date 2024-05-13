<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\Concerns\ExcludesPaths;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CSPMiddleware
{
    use ExcludesPaths;
    protected array $except = ["/up"];
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = Str::random();
        $request->attributes->set("nonce", $nonce);
        $response = $next($request);
        if ($this->inExceptArray($request) || $response->isClientError() || $response->isServerError()) return $response;
        $response->headers->set("Content-Security-Policy",
            $value ?? "script-src 'strict-dynamic' 'nonce-$nonce';style-src 'self' 'nonce-$nonce';object-src 'none';base-uri 'none';frame-ancestors 'none'",
            false);
        return $response;
    }
}
