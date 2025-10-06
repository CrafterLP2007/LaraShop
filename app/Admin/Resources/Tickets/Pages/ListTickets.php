<?php

namespace App\Admin\Resources\Tickets\Pages;

use App\Admin\Resources\Tickets\TicketsResource;
use App\Admin\Resources\Tickets\Widgets\TicketsOverviewWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            TicketsOverviewWidget::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Tickets')
                ->icon('heroicon-m-user-group'),
            'open' => Tab::make('Open Tickets')
                ->icon('heroicon-o-lock-open')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'open')),
            'replied' => Tab::make('Replied Tickets')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'replied')),
            'closed' => Tab::make('Closed Tickets')
                ->icon('heroicon-o-lock-closed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'closed')),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'open';
    }
}
