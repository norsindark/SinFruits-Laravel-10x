<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\ProductWarehouse;
use App\Models\ProductDetail;

class OrdersController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'order_notes' => 'nullable|string',
        ]);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_amount' => 0,
            'full_name' => $request->input('full_name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'notes' => $request->input('order_notes'),
        ]);

        $cartId = Cart::where('user_id', auth()->user()->id)->first()->id;

        $cartItems = CartItem::where('cart_id', $cartId)->get();

        foreach ($cartItems as $item) {
            $productWarehouse = ProductWarehouse::where('product_id', $item->product_id)->first();

            if ($productWarehouse->quantity < $item->quantity) {
                return redirect()->back()->with('error', 'Not enough quantity in the warehouse for product: ' . $item->product->name);
            }

            $productDetails = ProductDetail::where('product_id', $item->product_id)->first();

            $orderItem = $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $productDetails->price,
            ]);

            $order->total_amount += $item->quantity * $productDetails->price;

            $productWarehouse->decrement('quantity', $item->quantity);

            $orderItem->productWarehouse()->associate($productWarehouse);
            $orderItem->save();
        }

        $order->total_amount += $order->total_amount * 0.1;

        $order->save();

        CartItem::where('cart_id', $cartId)->delete();

        return redirect()->back()->with('success', 'Order created successfully');

    }
}
