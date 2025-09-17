<?php

namespace App\Classes\Extension;

use App\Models\Order;
use Exception;

/**
 * Abstract base class for all gateway extensions.
 *
 * Gateway extensions are responsible for handling payment and refund operations
 * for orders. All custom gateway implementations should extend this class and
 * provide concrete logic for processing payments and refunds.
 */
abstract class GatewayExtension extends Extension
{
    /**
     * Processes a refund for the specified order.
     *
     * This method should implement the logic required to initiate and complete
     * a refund transaction for the given order. If the refund cannot be processed,
     * an exception should be thrown by the implementation.
     *
     * @param Order $order The order instance to refund.
     * @return void
     * @throws Exception if the refund cannot be processed.
     */
    public abstract function refund(Order $order): void;

    /**
     * Processes a payment for the specified order.
     *
     * This method should implement the logic required to initiate and complete
     * a payment transaction for the given order. If the payment cannot be processed,
     * an exception should be thrown by the implementation.
     *
     * @param Order $order The order instance to pay.
     * @return void
     * @throws Exception if the refund cannot be processed.
     */
    public abstract function pay(Order $order): void;
}
