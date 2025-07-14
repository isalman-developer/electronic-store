<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            color: #333;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f8f8f8;
        }
        .text-right {
            text-align: right;
        }
        .totals {
            width: 50%;
            float: right;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
            font-size: 12px;
        }
        .payment-info {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f8f8;
            border-radius: 4px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <div>
                <h2>INVOICE</h2>
                <p>Invoice #: {{ $order->order_number }}</p>
                <p>Date: {{ $order->created_at->format('F d, Y') }}</p>
                <p>Due Date: {{ $order->created_at->addDays(30)->format('F d, Y') }}</p>
            </div>
            <div>
                <img src="{{ public_path('assets/images/logo.png') }}" alt="Company Logo" class="logo">
                <p>Your Company Name</p>
                <p>123 Business Street</p>
                <p>City, State ZIP</p>
                <p>Phone: (123) 456-7890</p>
            </div>
        </div>

        <div style="clear: both; margin-bottom: 20px;">
            <div style="width: 50%; float: left;">
                <h3>Bill To:</h3>
                <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->city }}, {{ $order->state }} {{ $order->zip }}</p>
                <p>{{ $order->country }}</p>
                <p>Email: {{ $order->email }}</p>
                <p>Phone: {{ $order->phone }}</p>
            </div>
            <div style="width: 50%; float: left;">
                <h3>Ship To:</h3>
                <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->city }}, {{ $order->state }} {{ $order->zip }}</p>
                <p>{{ $order->country }}</p>
            </div>
        </div>

        <div style="clear: both;">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product->description ?? 'Product Description' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-right">${{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</td>
                </tr>
                @if($order->discount > 0)
                <tr>
                    <td>Discount:</td>
                    <td class="text-right">-${{ number_format($order->discount, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td>Shipping:</td>
                    <td class="text-right">${{ number_format($order->shipping_fee ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td>Tax:</td>
                    <td class="text-right">${{ number_format($order->items->sum('tax'), 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Total:</strong></td>
                    <td class="text-right"><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <div style="clear: both;"></div>

        <div class="payment-info">
            <h3>Payment Information</h3>
            <p><strong>Payment Method:</strong>
                @if($order->payment_method == 'credit_card')
                    Credit Card
                @elseif($order->payment_method == 'paypal')
                    PayPal
                @else
                    Cash on Delivery
                @endif
            </p>
            <p><strong>Payment Status:</strong>
                @if($order->payment_status == 'paid')
                    Paid
                @elseif($order->payment_status == 'refunded')
                    Refunded
                @else
                    Pending
                @endif
            </p>
            @if($order->transaction_id)
            <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
            @endif
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>If you have any questions about this invoice, please contact our customer service.</p>
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
