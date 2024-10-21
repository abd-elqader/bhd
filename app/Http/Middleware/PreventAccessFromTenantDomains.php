<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventAccessFromTenantDomains
{
    public function handle(Request $request, Closure $next)
    {
        if (substr($request->root(), strpos($request->root(), '://') + 1) != substr(env('APP_URL'), strpos(env('APP_URL'), '://') + 1)) {
            abort(404);
        }

        return $next($request);
    }
}
