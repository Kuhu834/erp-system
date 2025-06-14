@extends('layouts.app')

@section('content')
<style>
    .modern-table-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .table thead th {
        background-color: #f9fafb;
        border-bottom: 1px solid #e3e6ec;
    }

    .table tbody tr {
        transition: background 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f6f9fc;
    }

    .btn-outline-info, .btn-outline-danger {
        font-size: 0.85rem;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
    }

    .badge-status {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-confirmed {
        background-color: #d4f4d7;
        color: #0f9d58;
    }

    .badge-pending {
        background-color: #fff4d4;
        color: #f4b400;
    }
</style>

<div class="container py-4">
    <div class="header-actions mb-4">
        <h1 class="h4 mb-0">Sales Orders</h1>
        <a href="{{ route('sales-orders.create') }}" class="btn btn-primary">+ Create Sales Order</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card modern-table-card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Total (₹)</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="badge-status {{ $order->status == 'confirmed' ? 'badge-confirmed' : 'badge-pending' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('sales-orders.show', $order->id) }}" class="btn btn-sm btn-outline-info">View</a>
                            <!-- Optional: Add Edit/Delete if needed in future -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No sales orders found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
