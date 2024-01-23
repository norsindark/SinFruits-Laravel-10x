<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductWarehouse;

class CartsController extends Controller
{

    //index
    public function index()
    {
        $userId = Auth::user()->id;
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return view('client.pages.carts.index', ['cartItems' => []]);
        }

        $cartItems = $cart->products;
        $subTotal = $cartItems->sum(function ($item) {
            return $item->product_details->price * $item->pivot->quantity;
        });

        $vat = $subTotal * 0.1;
        $total = $subTotal + $vat;

        return view('client.pages.carts.index', compact('cartItems', 'subTotal', 'vat', 'total'));
    }


    // add to cart 
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $productWarehouse = ProductWarehouse::where('product_id', $productId)->first();

        if ($productWarehouse->quantity < $quantity) {
            return redirect()->back()->with('error', 'Not enough quantity in warehouse!');
        }

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
            // $productWarehouse->decrement('quantity', $quantity);

            // $productWarehouse->save();
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }


    // remove 
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = Auth::user()->id;

        $userCart = Cart::where('user_id', $userId)->first();

        if (!$userCart) {
            return view('client.pages.carts.index', ['cartItems' => []]);
        }

        $userCart->products()->detach($productId);

        return redirect()->back()->with('success', 'Product removed from cart successfully');
    }


    // update quantity
    public function updateQuantity(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|int|min:1',
        ]);

        $newQuantity = $request->input('quantity');

        $productWarehouse = ProductWarehouse::where('product_id', $productId)->first();

        if ($productWarehouse->quantity < $newQuantity) {
            return redirect()->back()->with('error', 'Not enough quantity in the warehouse!');
        }

        $userId = Auth::user()->id;
        $userCart = Cart::where('user_id', $userId)->first();

        if (!$userCart) {
            return redirect()->back()->with('error', 'User cart not found!');
        }

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $existingProduct = $userCart->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            $existingProduct->pivot->quantity = $newQuantity;
            $existingProduct->pivot->save();
        } else {
            $userCart->products()->attach($productId, ['quantity' => $newQuantity]);
            // $productWarehouse->quantity -= $newQuantity;
            // $productWarehouse->save();
        }

        return redirect()->back()->with('success', 'Quantity updated successfully!');
    }
}
