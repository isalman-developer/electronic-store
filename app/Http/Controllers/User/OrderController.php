<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Core\Services\Admin\InvoiceService;
use App\Core\Services\Admin\OrderService;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('user.checkout.index');
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:2',
            'payment_method' => 'required|string|in:cash_on_delivery,credit_card,paypal',
            'cart_data' => 'required|json',
        ]);
        $order = app(OrderService::class)->placeUserOrder($validated);
        return redirect()->route('order.success', ['order_number' => $order->order_number])
            ->with('success', 'Your order has been placed successfully!');
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        $order->load('items');

        // Clear any session cart data
        session()->forget('cart');

        return view('user.order.success', compact('order'));
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.order.index', compact('orders'));
    }

    public function userOrderDetail(Order $order)
    {
        // Check if order belongs to user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items');
        return view('user.order.detail', compact('order'));
    }
}
