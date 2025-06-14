<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

// Show login page as homepage
Route::get('/', function () {
    return view('auth.login');
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');


    Route::get('/sales-orders', [SalesOrderController::class, 'index'])->name('sales-orders.index');
    Route::get('/sales-orders/create', [SalesOrderController::class, 'create'])->name('sales-orders.create');
    Route::post('/sales-orders/store', [SalesOrderController::class, 'store'])->name('sales-orders.store');
    Route::get('/sales-orders/{order}', [SalesOrderController::class, 'show'])->name('sales-orders.show');
    Route::get('/sales-orders/{order}/pdf', [SalesOrderController::class, 'exportPdf'])->name('sales-orders.pdf');

});


// Token generation (for API use/testing)
Route::get('/generate-token', function () {
    $user = User::where('email', 'admin@example.com')->first();
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json(['token' => $token]);
});

require __DIR__.'/auth.php';
