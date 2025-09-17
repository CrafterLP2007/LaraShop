<?php

namespace App\Http\Middleware;

use App\Facades\LangManager;
use Closure;
use Inertia\Inertia;

class ShareTranslations
{
    public function handle($request, Closure $next)
    {
        $translations = LangManager::getLoaded();

        if (!empty($translations)) {
            Inertia::share([
                'lang' => $translations,
            ]);
        }

        return $next($request);
    }
}
