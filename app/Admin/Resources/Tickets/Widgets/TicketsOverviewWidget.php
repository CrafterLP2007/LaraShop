<?php

namespace App\Admin\Resources\Tickets\Widgets;

use App\Models\Ticket;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;

class TicketsOverviewWidget extends StatsOverviewWidget
{
    protected ?string $pollingInterval = "10s";

    private function getTicketCountsByDay($status): array
    {
        $counts = [];
        for ($i = 7 - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $counts[] = Ticket::where('status', $status)
                ->whereDate('created_at', $date)
                ->count();
        }
        return $counts;
    }

    protected function getStats(): array
    {
        return [
            StatsOverviewWidget\Stat::make('Opened Tickets', number_format(Ticket::where('status', 'open')->count()))
                ->color('success')
                ->icon('heroicon-o-ticket')
                ->chart($this->getTicketCountsByDay('open')),

            StatsOverviewWidget\Stat::make('Closed Tickets', number_format(Ticket::where('status', 'closed')->count()))
                ->color('danger')
                ->icon('heroicon-o-check-circle')
                ->chart($this->getTicketCountsByDay('closed')),

            StatsOverviewWidget\Stat::make('Pending Tickets', number_format(Ticket::where('status', 'resolved')->count()))
                ->color('warning')
                ->icon('heroicon-o-clock')
                ->chart($this->getTicketCountsByDay('pending'))
        ];
    }
}
