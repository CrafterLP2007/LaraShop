<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MustVerifyEmail
{
    public function handle(Request $request, Closure $next)
    {

    }
}
