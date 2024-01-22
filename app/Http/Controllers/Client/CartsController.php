<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $userId = Auth::user()->id;

        $userCart = Cart::where('user_id', $userId)->first();

        if (!$userCart) {
            $userCart = Cart::create([
                'user_id' => $userId,
            ]);
        }

        $existingProduct = $userCart->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            $existingProduct->pivot->quantity += $quantity;
            $existingProduct->pivot->save();
        } else {
            $userCart->products()->attach($productId, ['quantity' => $quantity]);
        }
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
}
