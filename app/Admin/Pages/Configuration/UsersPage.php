<?php

namespace App\Admin\Pages\Configuration;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class UsersPage extends Page
{
    protected static ?string $title = 'Users';
    protected static string|UnitEnum|null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Users';
    protected static ?int $navigationSort = 2;
}
