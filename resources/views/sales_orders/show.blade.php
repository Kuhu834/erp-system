@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Sales Order #{{ $salesOrder->id }}</h2>
        <a href="{{ route('sales-orders.index') }}" class="btn btn-secondary">← Back to Orders</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title text-primary mb-0">Order Details</h5>
                <a href="{{ route('sales-orders.pdf', $salesOrder->id) }}" class="btn btn-outline-primary">
                    ⬇️ Download PDF
                </a>
            </div>
            <hr>

            <div class="mb-3">
                <strong>Status:</strong>
                <div>{{ ucfirst($salesOrder->status) }}</div>
            </div>

            <div class="mb-3">
                <strong>Ordered By:</strong>
                <div>{{ $salesOrder->user->name ?? 'N/A' }}</div>
            </div>

            <div class="mb-3">
                <strong>Order Date:</strong>
                <div>{{ $salesOrder->created_at ? $salesOrder->created_at->format('d M, Y H:i') : 'N/A' }}</div>
            </div>

            <hr>
            <h5 class="text-primary">Order Items</h5>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salesOrder->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                                <td class="text-end">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th class="text-end">₹{{ number_format($salesOrder->total, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
