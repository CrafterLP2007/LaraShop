<?php

namespace App\Admin\Pages\System;

use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use UnitEnum;
use BackedEnum;

class InfoPage extends Page
{
    protected static ?string $title = 'Info';
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'Info';
    protected static ?int $navigationSort = 1;
    protected static ?string $slug = 'info';
    protected string $view = 'admin.pages.system.info';
}
