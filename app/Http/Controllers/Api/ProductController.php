<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    //  public function index()
    //     {
    //         return response()->json([
    //             'products' => Product::all()
    //         ]);
    //     }
}
