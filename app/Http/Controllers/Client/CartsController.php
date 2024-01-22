<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $existingProduct = Cart::get($productId);

        if ($existingProduct) {
            $quantity += $existingProduct->quantity;
            Cart::update($existingProduct->rowId, $quantity);
        } else {
            $product = Product::find($productId);

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            Cart::add($productId, $product->name, $quantity, $product->product_details->price);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
}
