<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Core\Services\Admin\OrderService;
use App\Http\Requests\Admin\Order\OrderStoreRequest;
use App\Http\Requests\Admin\Order\OrderUpdateRequest;

class OrderController extends Controller
{
    public function __construct(protected OrderService $service) {}

    public function index()
    {
        $orders = $this->service->getAll(relations: ['items', 'user'], perPage: 10);

        // Get order statistics
        $orderStats = [
            'refund_count' => $this->service->getAll(conditions: ['payment_status' => 'refund'])->count(),
            'canceled_count' => $this->service->getAll(conditions: ['status' => 'canceled'])->count(),
            'shipped_count' => $this->service->getAll(conditions: ['status' => 'shipped'])->count(),
            'delivering_count' => $this->service->getAll(conditions: ['status' => 'delivering'])->count(),
            'pending_review_count' => $this->service->getAll(conditions: ['status' => 'pending_review'])->count(),
            'pending_payment_count' => $this->service->getAll(conditions: ['payment_status' => 'pending'])->count(),
            'delivered_count' => $this->service->getAll(conditions: ['status' => 'completed'])->count(),
            'in_progress_count' => $this->service->getAll(conditions: ['status' => 'processing'])->count(),
        ];

        return view('admin.orders.index', compact('orders', 'orderStats'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function show(Order $order)
    {
        $order->load(['items', 'user', 'items.product.media']);
        return view('admin.orders.show', compact('order'));
    }

    public function store(OrderStoreRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $this->service->update($order->id, $request->validated());
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {

        $this->service->delete($order->id);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
