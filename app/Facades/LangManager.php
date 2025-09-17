<?php

namespace App\Facades;

use App\Services\Language\LanguageService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array load(string $file, \Illuminate\Http\Request $request = null)
 * @method static array getLoaded()
 */
class LangManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LanguageService::class;
    }
}
