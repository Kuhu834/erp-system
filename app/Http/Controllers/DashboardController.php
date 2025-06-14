<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalSales' => SalesOrder::sum('total'),
            'totalOrders' => SalesOrder::count(),
            'lowStock' => Product::where('quantity', '<=', 5)->get(),
        ]);
    }
}
