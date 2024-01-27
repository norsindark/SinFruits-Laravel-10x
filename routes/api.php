<?php

use App\Http\Controllers\Client\CartsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::put('/cart/update-quantity/{productId}', [CartsController::class, 'updateQuantity'])->name('client.cart.updateQuantity');
