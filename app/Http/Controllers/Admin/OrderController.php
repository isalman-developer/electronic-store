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
        $orders = $this->service->getAll();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function show(Order $order)
    {
        $orders = $this->service->getAll();
        return view('admin.orders.index', compact('orders'));
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
