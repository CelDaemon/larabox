<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FragmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if(!$request->expectsJson() || !(($content = $response->getOriginalContent()) instanceof View)) return $response;
        /** @var View $content */
        return $response->setContent(["title" => $request->attributes->get("title"), "content" => $content->fragment("content")]);
    }
}
