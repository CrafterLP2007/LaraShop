<?php

namespace App\Helpers;

class Theme
{
    public static function getActiveTheme(): string
    {
        return \Qirolab\Theme\Theme::active() ?? 'default';
    }

    public static function getThemeConfig()
    {
        $activeTheme = self::getActiveTheme();
        $configPath = base_path("themes/{$activeTheme}/config/theme.php");

        if (file_exists($configPath)) {
            return include $configPath;
        }

        return [];
    }

    public static function getThemeSettings(): array
    {
        return self::getThemeConfig()['configuration'] ?? [];
    }

    public function getThemeMetadata(): array
    {
        return self::getThemeConfig()['metadata'] ?? [];
    }
}
