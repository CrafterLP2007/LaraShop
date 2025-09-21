<?php

namespace App\Admin\Pages\Shop;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class CouponsPage extends Page
{
    protected static ?string $title = 'Coupons';
    protected static string|UnitEnum|null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Coupons';
    protected static ?int $navigationSort = 5;
}

