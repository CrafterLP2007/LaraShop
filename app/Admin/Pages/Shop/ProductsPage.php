<?php

namespace App\Admin\Pages\Shop;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class ProductsPage extends Page
{
    protected static ?string $title = 'Products';
    protected static string|UnitEnum|null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Products';
    protected static ?int $navigationSort = 3;
}
