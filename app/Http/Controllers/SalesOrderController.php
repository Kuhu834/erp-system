<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSalesOrderRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class SalesOrderController extends Controller
{
    // Display all sales orders
    public function index()
    {
    //    dd('inside controller');
        $orders = SalesOrder::with('user')->latest()->get();

        // dd( $orders);
        return view('sales_orders.list', compact('orders'));
    }

    // Show form to create a new sales order
    public function create()
    {
        $products = Product::all();
        return view('sales_orders.create', compact('products'));
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $order = DB::transaction(function () use ($request) {
            $total = 0;

            foreach ($request->products as $index => $productId) {
                $product = Product::findOrFail($productId);
                $quantity = $request->quantities[$index];

                if ($product->quantity < $quantity) {
                    abort(400, "{$product->name} stock is insufficient.");
                }

                $total += $product->price * $quantity;
            }

            $order = SalesOrder::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'confirmed'
            ]);

            foreach ($request->products as $index => $productId) {
                $product = Product::findOrFail($productId);
                $quantity = $request->quantities[$index];

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);

                $product->decrement('quantity', $quantity);
            }

            return $order;
        });

        return redirect()->route('sales-orders.show', $order->id)->with('success', 'Order placed.');
    }

    // Show a specific sales order
    public function show($id)
    {
        // Find the sales order by ID
        $salesOrder = SalesOrder::findOrFail($id);

        // dd($salesOrder);

        // Load related data: items with product info and the user who placed the order
        $salesOrder->load('items.product', 'user');

        // Return the view and pass the order to it
        return view('sales_orders.show', ['salesOrder' => $salesOrder]);
    }

    // Export PDF invoice
    public function exportPDF($id)
    {
        $order = SalesOrder::with('items.product', 'user')->findOrFail($id);
        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download("invoice_{$order->id}.pdf");
    }

    public function apiStore(Request $request)
    {
        // Validate and create order, then return response
        return response()->json(['message' => 'Sales order created'], 201);
    }

    public function apiShow($id)
    {
        $order = SalesOrder::with('items')->findOrFail($id);
        return response()->json($order);
    }
}

