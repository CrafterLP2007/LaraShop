<?php

namespace App\Events;

use App\Models\Order;
use App\Models\OrderConfirmation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Order $order){
        OrderConfirmation::create([
            'user_id' => $order->user_id,
            'order_id' => $order->order_id,
            'confirmation_code' => config('order.confirmation_code_generator')
        ]);

        //Mail::to($order->user()->first())->send();
    }
}
