<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\User;

abstract class Extension
{
    /**
     * Get metadata for the extension.
     *
     * @code [ 'name' => 'Stripe', 'version' => '1.0.0', 'author' => 'John Doe' ]
     * @return array
     */
    public abstract function metadata(): array;

    /**
     * @throw Exception
     */
    public abstract function create(User $user, Order $order);

    /**
     * @throw Exception
     */
    public abstract function refund(User $user, Order $order);

    /**
     * @throw Exception
     */
    public abstract function cancel(User $user, Order $order);

    public function getConfig(): array
    {
        $configFilePath = __DIR__ . 'config/config.php';

        if (file_exists($configFilePath)) {
            return include $configFilePath;
        }

        return [];
    }
}
