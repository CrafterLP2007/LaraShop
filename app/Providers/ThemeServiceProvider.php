<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::addNamespace("theme", base_path('themes/' . config('settings.active_theme') . '/views'));
    }

    public function register(): void
    {
        //
    }
}
