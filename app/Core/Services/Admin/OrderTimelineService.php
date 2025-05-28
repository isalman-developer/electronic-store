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
    public function addTimelineEntry(Order $order, string $title, ?string $description = null, ?string $status = null, ?string $icon = null, ?string $iconClass = null): OrderTimeline
    {
        return OrderTimeline::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'icon' => $icon,
            'icon_class' => $iconClass,
            'is_active' => true
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
            'Order confirmed',
            'Order #' . $order->order_number . ' has been confirmed',
            'confirmed',
            'bx bx-check-circle',
            'text-success'
        );

        // If payment is already made (not cash on delivery)
        if ($order->payment_status === 'paid') {
            $paymentMethod = match ($order->payment_method) {
                'credit_card' => 'Credit Card',
                'paypal' => 'PayPal',
                default => 'Online Payment'
            };

            $this->addTimelineEntry(
                $order,
                'Payment received',
                'Payment received via ' . $paymentMethod,
                'paid',
                'bx bx-check-circle',
                'text-success'
            );
        }

        // Create invoice
        $this->addTimelineEntry(
            $order,
            'Invoice created',
            'Invoice created for order #' . $order->order_number,
            'invoice_created',
            'bx bx-check-circle',
            'text-success'
        );

        // Send invoice email
        $this->addTimelineEntry(
            $order,
            'Invoice sent to customer',
            'Invoice email was sent to ' . $order->email,
            'invoice_sent',
            'bx bx-check-circle',
            'text-success'
        );

        // Processing started
        if ($order->status === 'processing') {
            $this->addTimelineEntry(
                $order,
                'Order processing started',
                'The packing has been started',
                'processing',
                null,
                null
            );
        }
    }

    /**
     * Update order status and add timeline entry
     */
    public function updateOrderStatus(Order $order, string $status, ?string $description = null): Order
    {
        $statusTitle = match ($status) {
            'processing' => 'Order processing started',
            'packaging' => 'Order packaging started',
            'ready_to_ship' => 'Order ready to ship',
            'shipped' => 'Order shipped',
            'delivering' => 'Order out for delivery',
            'completed' => 'Order delivered',
            'canceled' => 'Order canceled',
            default => 'Order status updated to ' . ucfirst($status)
        };

        $iconClass = match ($status) {
            'canceled' => 'text-danger',
            'completed' => 'text-success',
            default => 'text-primary'
        };

        $order->update(['status' => $status]);

        $this->addTimelineEntry(
            $order,
            $statusTitle,
            $description,
            $status,
            'bx bx-check-circle',
            $iconClass
        );

        return $order;
    }
}
