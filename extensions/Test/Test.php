<?php

namespace Extensions\Test;

use App\Attributes\ExtensionMeta;
use App\Classes\Extension\Extension;
use App\Classes\Extension\GatewayExtension;
use App\Classes\Extension\ShippingExtension;
use App\Models\Order;

#[ExtensionMeta(name: 'Test', description: 'A test extension', version: '1.0.0', author: 'Paul H', url: 'https://github.com/PaulHaSASASASASASAS')]
class Test extends ShippingExtension
{
    public function options(): array
    {
        return [
            [
                'name' => 'stripe_secret_key',
                'label' => 'Stripe Restricted key',
                'placeholder' => 'Enter your Stripe Restricted API key',
                'type' => 'text',
                'description' => 'Find your API keys at https://dashboard.stripe.com/apikeys',
                'required' => true,
            ],
            [
                'name' => 'stripe_publishable_key',
                'label' => 'Stripe Publishable Key',
                'placeholder' => 'Enter your Stripe Publishable API key',
                'type' => 'text',
                'description' => 'Find your API keys at https://dashboard.stripe.com/apikeys',
                'required' => true,
            ],
        ];
    }

    public function create(Order $order): void
    {
        // TODO: Implement create() method.
    }

    public function refund(Order $order): void
    {
        // TODO: Implement refund() method.
    }

    public function cancel(Order $order): void
    {
        // TODO: Implement cancel() method.
    }

    public function getShippingDetails(Order $order): ?array
    {
        // TODO: Implement getShippingDetails() method.
    }

    public function pay(Order $order): void
    {
        // TODO: Implement pay() method.
    }
}
