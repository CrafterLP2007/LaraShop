<?php

namespace App\Admin\Pages\Configuration;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class CurrenciesPage extends Page
{
    protected static ?string $title = 'Currencies';
    protected static string|UnitEnum|null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Currencies';
    protected static ?int $navigationSort = 4;
    protected ?string $subheading = 'Manage the currencies available for your customers and billing.';
}
