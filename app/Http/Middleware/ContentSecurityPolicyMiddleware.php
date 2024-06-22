<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\Concerns\ExcludesPaths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Illuminate\Http\Response;

class ContentSecurityPolicyMiddleware
{
    use ExcludesPaths;

    protected array $except = ["/up"];
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = Vite::useCspNonce();
        $request->attributes->set('nonce', $nonce);
        $response = $next($request);
        if($this->inExceptArray($request) || $response->isClientError() || $response->isServerError()) return $response;
        $response->headers->set('Content-Security-Policy', "script-src 'strict-dynamic' 'nonce-$nonce';style-src 'self' 'nonce-$nonce';object-src 'none';base-uri 'none';frame-ancestors 'none'", false);
        return $response;
    }
}
