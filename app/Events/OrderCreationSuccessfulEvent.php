<?php

namespace App\Events;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreationSuccessfulEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Order $order){
        $order->first()->update([
            'status' => OrderStatus::Completed
        ]);
        //Mail::to($order->user()->first())->send();
    }
}
