<?php

namespace App\Services\Themes;

use Qirolab\Theme\Theme;

class ThemesService
{
    public function getActiveTheme(): string
    {
        return Theme::active() ?? 'default';
    }

    public function getThemeConfig()
    {
        $activeTheme = $this->getActiveTheme();
        $configPath = base_path("themes/{$activeTheme}/config/theme.php");

        if (file_exists($configPath)) {
            return include $configPath;
        }

        return [];
    }

    public function getThemeSettings(): array
    {
        return $this->getThemeConfig()['configuration'] ?? [];
    }

    public function getThemeMetadata(): array
    {
        return $this->getThemeConfig()['metadata'] ?? [];
    }
}
