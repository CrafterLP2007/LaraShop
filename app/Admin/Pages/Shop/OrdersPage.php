<?php

namespace App\Admin\Pages\Shop;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class OrdersPage extends Page
{
    protected static ?string $title = 'Orders';
    protected static string|UnitEnum|null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Orders';
    protected static ?int $navigationSort = 1;
}
