<?php

namespace App\Classes\Extension;

use App\Models\Order;
use Exception;

/**
 * Abstract base class for all shipping extensions.
 *
 * Shipping extensions are responsible for handling order creation, refunds,
 * and cancellations. All custom shipping implementations should extend this class
 * and provide concrete logic for these operations.
 */
abstract class ShippingExtension extends Extension
{
    /**
     * Creates a new order or initiates a shipping/payment process for the given order.
     *
     * This method should implement the logic required to create a shipment or start
     * the payment process for the specified order. If the creation fails due to
     * invalid data, external API errors, or other issues, an Exception should be thrown.
     *
     * @param Order $order The order instance to process.
     * @throws Exception If the creation fails.
     * @return mixed
     */
    public abstract function create(Order $order): void;

    /**
     * Processes a refund for the specified order.
     *
     * This method should implement the logic required to initiate and complete
     * a refund transaction for the given order. If the refund cannot be processed,
     * for example due to API errors or invalid order state, an Exception should be thrown.
     *
     * @param Order $order The order instance to refund.
     * @throws Exception If the refund fails.
     * @return mixed
     */
    public abstract function refund(Order $order): void;

    /**
     * Cancels the specified order.
     *
     * This method should implement the logic required to cancel the given order,
     * such as updating its status or notifying external services. If the cancellation
     * fails, for example due to API errors or invalid order state, an Exception should be thrown.
     *
     * @param Order $order The order instance to cancel.
     * @throws Exception If the cancellation fails.
     * @return mixed
     */
    public abstract function cancel(Order $order): void;
}
