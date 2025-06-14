@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Dashboard</h2>
        </div>

        <!-- Welcome Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Welcome, {{ Auth::user()->name }}!</h5>
                <p class="card-text text-muted">
                    You're logged in to your ERP System dashboard.
                </p>
            </div>
        </div>

        <!-- Dashboard Widgets -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text fs-4">{{ \App\Models\Product::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales Orders</h5>
                        <p class="card-text fs-4">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales (Amount)</h5>
                        <p class="card-text fs-4">₹ {{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        @if($lowStock->count())
            <div class="card mt-4">
                <div class="card-header bg-warning text-dark fw-bold">
                    Low Stock Alerts
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($lowStock as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }}
                                <span class="badge bg-danger rounded-pill">Qty: {{ $product->quantity }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
