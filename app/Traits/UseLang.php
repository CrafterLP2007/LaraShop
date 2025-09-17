<?php

namespace App\Traits;

use App\Facades\LangManager;
use ReflectionClass;
use voku\helper\ASCII;

trait UseLang
{
    public function loadLang(...$files): void
    {
        foreach ($files as $file) {
            LangManager::load(ASCII::to_ascii($file), request()->user()->language ?? config('app.fallback_locale'));
        }
    }

    public function loadLangAuto(): void
    {
        $reflection = new ReflectionClass($this);
        $namespace = str_replace('App\\Http\\Controllers\\', '', $reflection->getNamespaceName());
        $className = preg_replace('/Controller$/', '', $reflection->getShortName());

        $langPath = strtolower(trim(str_replace('\\', '/', $namespace) . '/' . $className, '/'));
        $langPath = ASCII::to_ascii($langPath);

        LangManager::load($langPath, request()->user()->language ?? config('app.fallback_locale'));
    }
}
