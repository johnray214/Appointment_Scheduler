<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!$request->user()) {
            abort(401, 'Unauthenticated.');
        }

        if ($request->user()->role !== $role) {
            abort(403, 'Unauthorized. Required role: ' . $role);
        }

        return $next($request);
    }
}
