<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ProductController as APIProductController;
use App\Http\Controllers\API\SalesOrderController as APISalesOrderController;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [APIProductController::class, 'index']);
    Route::post('/sales-orders', [APISalesOrderController::class, 'store']);
    Route::get('/sales-orders/{id}', [APISalesOrderController::class, 'show']);
});