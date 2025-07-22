<?php

namespace App\Core\Services\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Core\Services\AbstractService;
use App\Services\OrderTrackingService;
use App\Core\Repositories\OrderRepository;
use App\Core\Services\Admin\OrderEventService;
use App\Core\Repositories\OrderItemRepository;

class OrderService extends AbstractService
{
    public function __construct(
        protected OrderRepository $orderRepository,
        protected InvoiceService $invoiceService,
        protected OrderTrackingService $orderTrackingService,
        protected OrderEventService $orderEventService,
        protected OrderItemRepository $orderItemRepository,
    ) {
        parent::__construct($orderRepository);
    }

    public function handlePostUpdate(Order $order)
    {
        if ($order->payment_status === 'paid' && !$order->invoice_path) {
            $this->invoiceService->generateInvoice($order);
        }
    }

    public function updateOrder(Order $order, array $data)
    {
        unset($data['payment_method']);
        unset($data['total_amount']);

        if (isset($data['status'])) {
            if ($data['status'] === 'pending') {
                $data['payment_status'] = 'pending';
            } elseif ($data['status'] === 'paid') {
                $data['payment_status'] = 'paid';
            } elseif ($data['status'] === 'refunded') {
                $data['payment_status'] = 'refunded';
            }
        }

        $order->update($data);
        $this->handlePostUpdate($order);
    }

    public function updateOrderStatus(Order $order, string $status, ?string $description = null)
    {
        $newStatus = \App\Enums\OrderStatus::from($status);
        $previousStatus = $order->getOriginal('status');

        // Automatically set payment_status based on status
        if ($newStatus->value === 'paid') {
            $order->payment_status = 'paid';
        } elseif ($newStatus->value === 'refunded') {
            $order->payment_status = 'refunded';
        }
        $order->save();

        $this->handlePostUpdate($order);
        $this->orderTrackingService->updateStatus($order, $newStatus, $description);

        $this->orderEventService->store([
            'order_id' => $order->id,
            'type' => 'status_updated',
            'description' => 'Order status updated to ' . $newStatus->value . '.',
            'created_by' => Auth::id(),
            'data' => [
                'new_status' => $newStatus->value,
                'previous_status' => $previousStatus,
                'actor_id' => Auth::id(),
            ],
        ]);
    }

    public function refundOrder(Order $order)
    {
        $this->orderTrackingService->updateStatus($order, \App\Enums\OrderStatus::Refunded, 'Order refunded by admin.');
        $this->orderEventService->store([
            'order_id' => $order->id,
            'type' => 'order_refunded',
            'description' => 'Order was refunded by admin.',
            'created_by' => Auth::id(),
            'data' => [
                'actor_id' => Auth::id(),
                'refund_amount' => $order->total_amount,
            ],
        ]);
    }

    public function returnOrder(Order $order)
    {
        $this->orderTrackingService->updateStatus($order, \App\Enums\OrderStatus::Returned, 'Order marked as returned by admin.');
        $this->orderEventService->store([
            'order_id' => $order->id,
            'type' => 'order_returned',
            'description' => 'Order was marked as returned by admin.',
            'created_by' => Auth::id(),
            'data' => [
                'actor_id' => Auth::id(),
            ],
        ]);
    }

    public function logInvoiceDownload(Order $order)
    {
        $this->orderEventService->store([
            'order_id' => $order->id,
            'type' => 'invoice_downloaded',
            'description' => 'Invoice was downloaded by admin.',
            'created_by' => Auth::id(),
            'data' => [
                'actor_id' => Auth::id(),
                'invoice_path' => $order->invoice_path,
            ],
        ]);
    }

    public function resendInvoice(Order $order)
    {
        $this->invoiceService->resendInvoice($order);
        $this->orderEventService->store([
            'order_id' => $order->id,
            'type' => 'invoice_resent',
            'description' => 'Invoice email resent to customer.',
            'created_by' => Auth::id(),
            'data' => [
                'actor_id' => Auth::id(),
                'email' => $order->email,
                'invoice_path' => $order->invoice_path,
            ],
        ]);
    }

    public function placeUserOrder(array $data)
    {
        $cartItems = $this->parseCartData($data['cart_data']);
        $total = $this->calculateTotal($cartItems);
        $orderData = [
            'user_id' => Auth::check() ? Auth::id() : null,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'shipping_address' => $data['shipping_address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'country' => $data['country'],
            'notes' => $data['notes'] ?? null,
            'payment_method' => $data['payment_method'],
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => $data['payment_method'] === 'cash_on_delivery' ? 'pending' : 'pending',
        ];
        $order = $this->orderRepository->store($orderData);

        foreach ($cartItems as $item) {
            $this->orderItemRepository->store([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'product_id' => $item['ProductId'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }
        if ($order->payment_status === 'paid') {
            $this->invoiceService->generateInvoice($order);
        }
        return $order;
    }

    private function parseCartData($cartData)
    {
        $cartItems = json_decode($cartData, true);
        if (empty($cartItems)) {
            throw new \RuntimeException('Cart is empty');
        }
        return $cartItems;
    }

    private function calculateTotal(array $cartItems): float
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
