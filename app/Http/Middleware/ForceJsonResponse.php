<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        // Forcer Accept: application/json pour les routes API
        if ($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');
        }

        $response = $next($request);

        // Forcer Content-Type JSON
        if ($request->is('api/*')) {
            $response->header('Content-Type', 'application/json');
        }

        return $response;
    }
}
