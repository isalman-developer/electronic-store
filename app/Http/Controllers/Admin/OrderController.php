<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\OrderTrackingService;
use App\Core\Services\Admin\InvoiceService;
use App\Core\Services\Admin\OrderService;

class OrderController extends Controller
{
    public function __construct(
        protected OrderTrackingService $orderTrackingService,
        protected InvoiceService $invoiceService,
        protected OrderService $orderService
    ) {}

    /**
     * Display a listing of orders
     */
    public function index()
    {
        $orders = Order::with(['items.product', 'user'])
            ->latest()
            ->paginate(15);

        // Get order statistics
        $orderStats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'paid_orders' => Order::where('status', 'paid')->count(),
            'shipped_orders' => Order::where('status', 'shipped')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'canceled_orders' => Order::where('status', 'canceled')->count(),
            'refunded_orders' => Order::where('status', 'refunded')->count(),
            'returned_orders' => Order::where('status', 'returned')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'orderStats'));
    }

    /**
     * Show the form for creating a new order
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
            // Add other validation rules as needed
        ]);

        Order::create($validated);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $progressData = $this->orderTrackingService->getOrderProgress($order);
        $transitionButtons = $this->orderTrackingService->getStatusTransitionButtons($order);

        $order->load(['items.product', 'events' => function ($query) {
            $query->with('creator')->orderBy('created_at', 'desc');
        }]);
        $orderEvents = $order->events;

        return view('admin.orders.show', compact('order', 'progressData', 'transitionButtons', 'orderEvents'));
    }

    /**
     * Show the form for editing the specified order
     */
    public function edit(Order $order)
    {
        $order->load(['items.product']);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'status' => 'required|string|in:pending,paid,shipped,completed,canceled,refunded,returned',
            'payment_status' => 'required|string|in:pending,paid,refunded',
            'shipping_method' => 'nullable|string|max:255',
            'courier' => 'nullable|string|max:255',
            'tracking_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);
        $this->orderService->updateOrder($order, $validated);
        return redirect()->route('admin.orders.show', $order)->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'description' => 'nullable|string|max:500',
        ]);
        try {
            $this->orderService->updateOrderStatus($order, $validated['status'], $validated['description'] ?? null);
            return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.show', $order)->with('error', $e->getMessage());
        }
    }

    /**
     * Update tracking information
     */
    public function updateTracking(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'courier' => 'nullable|string|max:255',
            'tracking_number' => 'nullable|string|max:255',
        ]);

        $order->update([
            'courier' => $request->courier,
            'tracking_number' => $request->tracking_number,
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Tracking information updated successfully.');
    }

    public function refund(Order $order)
    {
        try {
            $this->orderService->refundOrder($order);
            return redirect()->route('admin.orders.show', $order)->with('success', 'Order refunded successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.show', $order)->with('error', $e->getMessage());
        }
    }

    public function return(Order $order)
    {
        try {
            $this->orderService->returnOrder($order);
            return redirect()->route('admin.orders.show', $order)->with('success', 'Order marked as returned.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.show', $order)->with('error', $e->getMessage());
        }
    }

    /**
     * Download the invoice PDF for an order
     */
    public function downloadInvoice(Order $order)
    {
        $this->orderService->logInvoiceDownload($order);
        return $this->invoiceService->downloadInvoice($order);
    }

    /**
     * Resend the invoice email to the customer
     */
    public function resendInvoice(Order $order)
    {
        $this->orderService->resendInvoice($order);
        return redirect()->route('admin.orders.show', $order)->with('success', 'Invoice email resent successfully.');
    }
}
