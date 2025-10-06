<?php

namespace App\Admin\Resources\Tickets;

use App\Admin\Resources\Tickets\Pages\CreateTickets;
use App\Admin\Resources\Tickets\Pages\EditTickets;
use App\Admin\Resources\Tickets\Pages\ListTickets;
use App\Admin\Resources\Tickets\Schemas\TicketsForm;
use App\Admin\Resources\Tickets\Tables\TicketsTable;
use App\Admin\Resources\Tickets\Widgets\TicketsOverviewWidget;
use App\Models\Ticket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TicketsResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static string | UnitEnum | null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleOvalLeftEllipsis;
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'Tickets';
    protected static ?string $recordTitleAttribute = 'Tickets';

    public static function form(Schema $schema): Schema
    {
        return TicketsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TicketsOverviewWidget::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTickets::route('/create'),
            'edit' => EditTickets::route('/{record}/edit'),
        ];
    }
}
