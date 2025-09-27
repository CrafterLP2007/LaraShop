<?php

namespace App\Admin\Pages\System;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class ApiPage extends Page
{
    protected static ?string $title = 'API Keys';
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationLabel = 'API Keys';
    protected static ?int $navigationSort = 5;
}
