<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MustVerifyEmail
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user->hasRole('admin') || $user->hasVerifiedEmail()) {
            return $next($request);
        }

        return Inertia::render('Auth/MustVerifyEmail');
    }
}
