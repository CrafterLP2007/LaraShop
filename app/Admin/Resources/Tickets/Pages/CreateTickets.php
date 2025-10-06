<?php

namespace App\Admin\Resources\Tickets\Pages;

use App\Admin\Resources\Tickets\TicketsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTickets extends CreateRecord
{
    protected static string $resource = TicketsResource::class;
}
