<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class HSTSMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(App::isLocal() || !$request->isSecure()) return $next($request);
        $response = $next($request);
        $response->headers->set("Strict-Transport-Security", "max-age=31536000; preload");
        return $response;
    }
}
