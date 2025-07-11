<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Core\Services\Admin\OrderService;
use App\Core\Services\Admin\OrderTimelineService;
use App\Core\Services\Admin\InvoiceService;
use App\Http\Requests\Admin\Order\OrderStoreRequest;
use App\Http\Requests\Admin\Order\OrderUpdateRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $service,
        protected OrderTimelineService $timelineService,
        protected InvoiceService $invoiceService
    ) {}

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
        $order->load(['items', 'user', 'items.product.media', 'timelines.user']);
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

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        $this->timelineService->updateOrderStatus(
            $order,
            $validated['status'],
            $validated['description'] ?? null
        );

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }

    public function addTimelineEntry(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|max:50',
            'description' => 'nullable|string',
            'custom_status' => 'nullable|string|max:255',
        ]);

        $this->timelineService->addTimelineEntry(
            $order,
            $validated['status'],
            $validated['description'] ?? null,
            $validated['custom_status'] ?? null
        );

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Timeline entry added successfully.');
    }

    /**
     * Download invoice for an order
     */
    public function downloadInvoice(Order $order)
    {
        return $this->invoiceService->downloadInvoice($order);
    }

    /**
     * Resend invoice email to customer
     */
    public function resendInvoice(Order $order)
    {
        $success = $this->invoiceService->resendInvoice($order);

        if (request()->ajax()) {
            return response()->json([
                'success' => $success,
                'message' => 'Invoice has been resent to the customer.'
            ]);
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Invoice has been resent to the customer.');
    }

    /**
     * Update order tracking information
     */
    public function updateTracking(Request $request, Order $order)
    {
        $validated = $request->validate([
            'courier' => 'nullable|string|max:255',
            'tracking_number' => 'nullable|string|max:255',
        ]);

        $order->update([
            'courier' => $validated['courier'],
            'tracking_number' => $validated['tracking_number'],
        ]);

        // Add a timeline entry for tracking information
        if ($validated['tracking_number']) {
            $this->timelineService->addTimelineEntry(
                $order,
                'Tracking information updated',
                'Tracking number: ' . $validated['tracking_number'] . ' via ' . $validated['courier'],
                'tracking_updated',
                'bx bx-map',
                'text-primary'
            );
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Tracking information updated successfully.');
    }
}
