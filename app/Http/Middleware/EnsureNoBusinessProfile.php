<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureNoBusinessProfile
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->businessProfile) {
            return redirect()->route('provider.dashboard')->with('info', 'You already have a business profile set up.');
        }
        
        return $next($request);
    }
}
