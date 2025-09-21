<?php

namespace App\Admin\Pages\Shop;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class InvoicesPage extends Page
{
    protected static ?string $title = 'Invoices';
    protected static string|UnitEnum|null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Invoices';
    protected static ?int $navigationSort = 2;
}
