<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Order $order){
        //Mail::to($order->user()->first())->send();
    }
}
