<?php

namespace App\Admin\Pages\Configuration;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class RolesPage extends Page
{
    protected static ?string $title = 'Roles';
    protected static string|UnitEnum|null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Roles';
    protected static ?int $navigationSort = 3;
}
