<?php

namespace App\Enums;

enum OrderStatus: int
{
    /**
     * Initial state - waiting for admin review
     */
    case PENDING = 1;

    /**
     * Order is being processed/prepared
     */
    case PROCESSING = 2;

    /**
     * Order has been shipped and is on its way
     */
    case SHIPPING = 3;

    /**
     * Order has arrived at destination
     */
    case COMPLETED = 4;

    /**
     * Order was cancelled
     */
    case CANCELLED = 5;

    /**
     * Payment was refunded to customer
     */
    case REFUNDED = 6;
}
