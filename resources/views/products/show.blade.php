@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Product Details</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back to Products</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-primary">{{ $product->name }}</h5>
            <hr>

            <div class="mb-3">
                <strong>SKU:</strong>
                <div>{{ $product->sku }}</div>
            </div>

            <div class="mb-3">
                <strong>Price:</strong>
                <div>₹{{ number_format($product->price, 2) }}</div>
            </div>

            <div class="mb-3">
                <strong>Quantity:</strong>
                <div>{{ $product->quantity }}</div>
            </div>

            <div class="mt-4">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
