<?php

namespace App\Services\Language;

class LanguageService
{
    protected array $loaded = [];

    public function load(string $file, string $locale): array
    {
        if (isset($this->loaded[$file])) {
            return $this->loaded[$file];
        }

        $basePath = rtrim(lang_path(), '/');
        $path = "{$basePath}/{$locale}/{$file}.php";

        $this->loaded[$file] = file_exists($path) ? require $path : [];

        return $this->loaded[$file];
    }

    public function getLoaded(): array
    {
        return $this->loaded;
    }
}
