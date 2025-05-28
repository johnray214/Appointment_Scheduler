<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProviderHasBusinessProfile
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'provider' && !auth()->user()->businessProfile) {
            return redirect()->route('provider.business-profile.setup');
        }

        return $next($request);
    }
}
