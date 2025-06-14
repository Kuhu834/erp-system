@extends('layouts.app')

@section('content')

<style>
    .modern-form-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        background-color: #fff;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e3e6ec;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
        color: #374151;
    }

    .form-group select,
    .form-group input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border 0.2s ease;
    }

    .form-group select:focus,
    .form-group input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 1px #3b82f6;
    }

    .product-group + .product-group {
        margin-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
        padding-top: 1.5rem;
    }

    .btn-primary {
        background-color: #3b82f6;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        transition: background-color 0.2s ease;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2563eb;
    }

    .btn-success {
        background-color: #16a34a;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: background-color 0.2s ease;
        border: none;
    }

    .btn-success:hover {
        background-color: #15803d;
    }

    .btn-remove {
        background-color: #ef4444;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 0.5rem;
        border: none;
    }

    .btn-remove:hover {
        background-color: #dc2626;
    }

    .alert-error {
        background-color: #fee2e2;
        color: #991b1b;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .alert-error ul {
        margin-left: 1rem;
        list-style-type: disc;
    }
    
</style>

<div class="container py-5">
    <div class="modern-form-card p-6 max-w-4xl mx-auto">
        <div class="form-header mb-4">
            <h2 class="text-xl font-bold text-gray-800 py-2 px-4">Create Sales Order</h2>
            <a href="{{ route('sales-orders.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Back to Orders
            </a>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <strong>There were some issues with your submission:</strong>
                <ul class="mt-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sales-orders.store') }}" method="POST" class="p-6">
            @csrf
            <div id="product-container">
                <div class="product-group">
                    <div class="form-group mb-4">
                        <label>Product</label>
                        <select name="products[]" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} (Stock: {{ $product->quantity }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantities[]" min="1" required>
                    </div>
                </div>
            </div>

            <button type="button" onclick="addProduct()" class="btn-primary mt-4">
                + Add Another Product
            </button>

            <div class="mt-6">
                <button type="submit" class="btn-success">
                    Submit Order
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addProduct() {
    const container = document.getElementById('product-container');
    const originalGroup = container.firstElementChild;
    const productGroup = originalGroup.cloneNode(true);

    // Reset values
    productGroup.querySelectorAll('select, input').forEach(el => el.value = '');

    // Add remove button if not already present
    if (!productGroup.querySelector('.btn-remove')) {
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn-remove';
        removeBtn.textContent = 'Remove';
        removeBtn.onclick = function () {
            this.closest('.product-group').remove();
        };
        productGroup.appendChild(removeBtn);
    }

    container.appendChild(productGroup);
}
</script>

@endsection
