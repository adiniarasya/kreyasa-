<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

/* ================= PUBLIC ================= */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product}', [HomeController::class, 'detail'])->name('product.detail');

/* Cart */
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});

/* Checkout */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/{code}', [CheckoutController::class, 'success'])->name('order.success');
Route::post('/order/{code}/upload-proof', [CheckoutController::class, 'uploadProof'])->name('order.upload');

/* ================= ADMIN ================= */
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth (tanpa middleware)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Area admin (butuh login admin)
    Route::middleware(['admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
        Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
        Route::post('/orders/{order}/delete', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

        // Products
        Route::get('/products', [AdminProductController::class, 'index'])->name('products');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::post('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
        Route::post('/products/{product}/delete', [AdminProductController::class, 'destroy'])->name('products.destroy');
    });
    // Guides
Route::get('/guides', [DashboardController::class, 'guides'])->name('guides');
});