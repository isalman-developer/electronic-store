<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Models\OrderEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Services\OrderTrackingService;
use App\Core\Services\Admin\InvoiceService;

class OrderController extends Controller
{
    public function __construct(
        protected OrderTrackingService $orderTrackingService,
        protected InvoiceService $invoiceService
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

        unset($validated['payment_method']);
        unset($validated['total_amount']);

        if ($validated['status'] === 'pending') {
            $validated['payment_status'] = 'pending';
        } elseif ($validated['status'] === 'paid') {
            $validated['payment_status'] = 'paid';
        } elseif ($validated['status'] === 'refunded') {
            $validated['payment_status'] = 'refunded';
        }

        $order->update($validated);

        // Generate and send invoice if order is now paid and invoice does not exist
        if ($order->payment_status === 'paid' && !$order->invoice_path) {
            $this->invoiceService->generateInvoice($order);
        }

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully.');
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
        $request->validate([
            'status' => 'required|string',
            'description' => 'nullable|string|max:500',
        ]);

        try {
            $newStatus = OrderStatus::from($request->status);
            $previousStatus = $order->getOriginal('status');
            $description = $request->description;

            // Automatically set payment_status based on status
            if ($newStatus->value === 'paid') {
                $order->payment_status = 'paid';
            } elseif ($newStatus->value === 'refunded') {
                $order->payment_status = 'refunded';
            }
            $order->save();

            // Generate and send invoice if order is now paid and invoice does not exist
            if ($order->payment_status === 'paid' && !$order->invoice_path) {
                info("generating invoice");
                $this->invoiceService->generateInvoice($order);
            }

            $this->orderTrackingService->updateStatus($order, $newStatus, $description);

            OrderEvent::create([
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

            return redirect()
                ->route('admin.orders.show', $order)
                ->with('success', "Order status updated to {$newStatus->label()} successfully.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.orders.show', $order)
                ->with('error', $e->getMessage());
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
            $this->orderTrackingService->updateStatus($order, \App\Enums\OrderStatus::Refunded, 'Order refunded by admin.');
            OrderEvent::create([
                'order_id' => $order->id,
                'type' => 'order_refunded',
                'description' => 'Order was refunded by admin.',
                'created_by' => Auth::id(),
                'data' => [
                    'actor_id' => Auth::id(),
                    'refund_amount' => $order->total_amount,
                ],
            ]);
            return redirect()->route('admin.orders.show', $order)->with('success', 'Order refunded successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.show', $order)->with('error', $e->getMessage());
        }
    }

    public function return(Order $order)
    {
        try {
            $this->orderTrackingService->updateStatus($order, \App\Enums\OrderStatus::Returned, 'Order marked as returned by admin.');
            OrderEvent::create([
                'order_id' => $order->id,
                'type' => 'order_returned',
                'description' => 'Order was marked as returned by admin.',
                'created_by' => Auth::id(),
                'data' => [
                    'actor_id' => Auth::id(),
                ],
            ]);
            // Optionally: trigger inventory restock logic here
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
        OrderEvent::create([
            'order_id' => $order->id,
            'type' => 'invoice_downloaded',
            'description' => 'Invoice was downloaded by admin.',
            'created_by' => Auth::id(),
            'data' => [
                'actor_id' => Auth::id(),
                'invoice_path' => $order->invoice_path,
            ],
        ]);
        return $this->invoiceService->downloadInvoice($order);
    }

    /**
     * Resend the invoice email to the customer
     */
    public function resendInvoice(Order $order)
    {
        $this->invoiceService->resendInvoice($order);
        OrderEvent::create([
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
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Invoice email resent successfully.');
    }
}
