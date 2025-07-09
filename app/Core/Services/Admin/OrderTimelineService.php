<?php

namespace App\Core\Services\Admin;

use App\Models\Order;
use App\Models\OrderTimeline;
use Illuminate\Support\Facades\Auth;

class OrderTimelineService
{
    /**
     * Add a new timeline entry for an order
     */
    public function addTimelineEntry(Order $order, string $status, ?string $description = null): OrderTimeline
    {
        return OrderTimeline::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'status' => $status,
            'description' => $description
        ]);
    }

    /**
     * Create default timeline entries when an order is created
     */
    public function createDefaultTimeline(Order $order): void
    {
        // Order confirmed
        $this->addTimelineEntry(
            $order,
            'pending',
            'Order #' . $order->order_number . ' has been confirmed'
        );

        // If payment is already made (not cash on delivery)
        if ($order->payment_status === 'paid') {
            $this->addTimelineEntry(
                $order,
                'paid',
                'Payment received via ' . $this->getPaymentMethodName($order->payment_method)
            );
        }
    }

    private function getPaymentMethodName(string $method): string
    {
        return match ($method) {
            'credit_card' => 'Credit Card',
            'paypal' => 'PayPal',
            default => 'Online Payment'
        };
    }

    /**
     * Update order status and add timeline entry
     */
    public function updateOrderStatus(Order $order, string $status, ?string $description = null): Order
    {
        // Only create a new timeline entry if status has changed
        if ($order->status !== $status) {
            $order->update(['status' => $status]);

            $this->addTimelineEntry(
                $order,
                $status,
                $description
            );
        }

        return $order;
    }
}
