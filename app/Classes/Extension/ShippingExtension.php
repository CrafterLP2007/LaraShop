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
     */
    public abstract function refund(Order $order): void;

    /**
     * Cancels the specified order or shipment.
     *
     * This method should implement the logic required to cancel the order or
     * shipment associated with the given order. If the cancellation cannot be
     * completed, for example due to API errors or invalid order state, an Exception should be thrown.
     *
     * @param Order $order The order instance to cancel.
     * @throws Exception If the cancellation fails.
     */
    public abstract function cancel(Order $order): void;

    /**
     * Retrieves shipping details and current location of the product.
     *
     * This method should return information about the shipment, such as tracking number,
     * carrier, estimated delivery date, and current location/status of the product.
     * Implementations may fetch data from external APIs or internal records.
     * You can return null if no shipping details are available.
     *
     * Example return array:
     * [
     *   'tracking_number' => '123456789',
     *   'carrier' => 'DHL',
     *   'estimated_delivery' => '2024-06-15',
     *   'current_location' => 'Hamburg, DE',
     *   'status' => 'In Transit',
     * ]
     *
     * @param Order $order The order instance to get shipping details for.
     * @throws Exception If shipping details cannot be retrieved.
     * @return array|null
     */
    public abstract function getShippingDetails(Order $order): ?array;
}
