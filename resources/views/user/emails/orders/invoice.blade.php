<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        h1 {
            color: #444;
            margin-bottom: 20px;
        }
        .order-details {
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Company Logo" class="logo">
        <h1>Your Invoice is Ready</h1>
    </div>
    
    <p>Dear {{ $order->first_name }} {{ $order->last_name }},</p>
    
    <p>Thank you for your order. Please find attached the invoice for your recent purchase (Order #{{ $order->order_number }}).</p>
    
    <div class="order-details">
        <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
        <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
    </div>
    
    <p>If you have any questions about your order or invoice, please don't hesitate to contact our customer service team.</p>
    
    <p>You can also view your order details by clicking the button below:</p>
    
    <p style="text-align: center; margin: 30px 0;">
        <a href="{{ route('user.order.detail', $order->id) }}" class="button">View Order Details</a>
    </p>
    
    <p>Thank you for shopping with us!</p>
    
    <p>Best regards,<br>
    The Team</p>
    
    <div class="footer">
        <p>This email was sent to {{ $order->email }}. If you have any questions, please contact us at support@example.com</p>
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </div>
</body>
</html>