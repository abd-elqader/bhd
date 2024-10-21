<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard('admin')->check() || Auth::guard('client')->check()) {
            return redirect()->away('/');
        }

        return $next($request);
    }
}