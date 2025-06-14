@extends('layouts.app')

@section('content')
<style>
    /* Rounded container and subtle background */
    .modern-table-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    /* Header button spacing */
    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Checkbox styling (like modern toggle) */
    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    /* Table */
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

    /* Buttons */
    .btn-outline-warning, .btn-outline-danger {
        font-size: 0.85rem;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
    }

    /* Status badges (optional if you use one in the future) */
    .badge-status {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-closed {
        background-color: #ffe5e5;
        color: #d33;
    }

    .badge-progress {
        background-color: #d4f4f9;
        color: #008c99;
    }
</style>

<div class="container py-4">
    <div class="header-actions mb-4">
        <h1 class="h4 mb-0">Product List</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
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
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Price (₹)</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <!-- View Button -->
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-info">View</a>

                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No products found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
