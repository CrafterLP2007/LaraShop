<?php

namespace App\Enums;

enum TicketStatus: int
{
    case OPEN = 0;
    case RESOLVED = 2;
    case CLOSED = 3;
}
