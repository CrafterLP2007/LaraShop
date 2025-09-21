<?php

namespace App\Admin\Pages\Shop;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class CategoriesPage extends Page
{
    protected static ?string $title = 'Categories';
    protected static string|UnitEnum|null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationLabel = 'Categories';
    protected static ?int $navigationSort = 4;
}
