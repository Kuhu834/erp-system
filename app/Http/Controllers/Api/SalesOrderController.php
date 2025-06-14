<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = DB::transaction(function () use ($request) {
            $total = 0;

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->quantity < $item['quantity']) {
                    abort(400, "{$product->name} stock is insufficient.");
                }
                $total += $product->price * $item['quantity'];
            }

            $order = SalesOrder::create([
                'user_id' => $request->user()->id,
                'total' => $total,
                'status' => 'confirmed'
            ]);

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);
                $product->decrement('quantity', $item['quantity']);
            }

            return $order->load('items.product');
        });

        return response()->json($order, 201);
    }


    public function show($id)
    {
        $order = SalesOrder::with('items.product')->findOrFail($id);
        return response()->json([
            'id' => $order->id,
            'user_id' => $order->user_id,
            'total' => $order->total,
            'status' => $order->status,
            'items' => $order->items->map(function ($item) {
                return [
                    'product' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->quantity * $item->price
                ];
            }),
        ]);
    }
    
}