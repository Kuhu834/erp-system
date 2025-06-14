<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Order #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Sales Order Invoice #{{ $order->id }}</h2>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Ordered By Customer:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y H:i') }}</p>

    <h4>Order Items</h4>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                <td class="text-right">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>₹{{ number_format($order->total, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
