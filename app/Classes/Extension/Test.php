<?php

namespace App\Classes\Extension;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Test extends GatewayExtension
{
    public function refund(Order $order): void
    {
        // TODO: Implement refund() method.
    }

    public function pay(Order $order): void
    {
        // TODO: Implement pay() method.
    }

    public function options(): array
    {
        return [
            [
                ''
            ]
        ];
    }
}
