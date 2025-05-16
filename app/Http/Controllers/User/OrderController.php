<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        // We're using localStorage for cart, so we don't need to check session
        // Just render the checkout view
        return view('user.checkout.index');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:2',
            'payment_method' => 'required|string|in:credit_card,paypal',
            'cart_data' => 'required|json',
        ]);

        // Parse cart data
        $cartItems = json_decode($request->cart_data, true);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Calculate order total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create the order
        $order = Order::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'shipping_address' => $request->shipping_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Process payment (simplified for this example)
        if ($request->payment_method === 'credit_card') {
            // Process credit card payment
            // This would typically integrate with a payment gateway
            $order->update(['payment_status' => 'paid']);
        } else if ($request->payment_method === 'paypal') {
            // Redirect to PayPal
            return redirect()->route('paypal.process', ['order_id' => $order->id]);
        }

        // Send order confirmation email
        // Mail::to($request->email)->send(new OrderConfirmation($order));

        return redirect()->route('order.success', ['order_number' => $order->order_number])
            ->with('success', 'Your order has been placed successfully!');
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

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

        return view('user.order.detail', compact('order'));
    }
}
