<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class HttpsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!App::isProduction()) return $next($request);
        $response = $next($request);
        $header = "max-age=".config("app.hsts.max_age");
        if(config("app.hsts.include_subdomains")) $header .= ";includeSubdomains";
        if(!$request->secure()) return redirect()->secure($request->path(), 301)->header("Strict-Transport-Security", $header);
        $response->header("Strict-Transport-Security", $header);
        return $response;
    }
}
