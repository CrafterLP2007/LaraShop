<?php

namespace App\Admin\Pages\Shop;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class TicketsPage extends Page
{
    protected static ?string $title = 'Tickets';
    protected static string|UnitEnum|null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?string $navigationLabel = 'Tickets';
    protected static ?int $navigationSort = 6;
}
