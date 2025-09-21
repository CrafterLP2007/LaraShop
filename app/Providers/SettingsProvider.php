<?php

namespace App\Providers;

use App\Models\Setting;
use Cache;
use Config;
use Inertia\ServiceProvider;
use Qirolab\Theme\Theme;

class SettingsProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadSettings();
    }

    private function loadSettings(): void
    {
        $settings = Cache::get('settings', []);

        if (empty($settings)) {
            $settings = Setting::where('settings.entity_type', null)->get()->pluck('key', 'value');
            Cache::put('settings', $settings);
        }

        foreach ($settings as $key => $value) {
            Config::set("settings.{$key}", $value);
        }

        Theme::set(config('settings.theme', 'default'), 'default');
    }

    public static function clearCache(): void
    {
        Cache::forget('settings');
        self::loadSettings();
    }
}
