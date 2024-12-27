<?php

namespace App\Observers;

use App\Enums\OrderStatus;
use App\Events\OrderCreatedEvent;
use App\Events\OrderCreationFailedEvent;
use App\Events\OrderCreationSuccessfulEvent;
use App\Models\Order;

class OrderObserver
{
    public function created(Order $order): void
    {
        event(new OrderCreatedEvent($order));
    }

    public function updated(Order $order): void
    {
        switch ($order->first()->status) {
            case OrderStatus::Completed:
                event(new OrderCreationSuccessfulEvent($order));
                break;

            case OrderStatus::Failed:
                event(new OrderCreationFailedEvent($order));
                break;
        }
    }
}
