<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\OrderCancellation;
use App\Models\ProductWarehouse;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{

    //index
    public function index()
    {
    }


    // create order
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'order_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

        return redirect()->route('client.cart.index')->with('success', 'Order created successfully');
    }


    // cancel order
    public function cancelOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'cancel_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order = Order::find($request->input('order_id'));

        if ($order->status !== 0) {
            return response()->json(['error' => 'Invalid order or order cannot be canceled.'], 422);
        }

        $order->status = 3;
        $order->save();

        OrderCancellation::create([
            'order_id' => $order->id,
            'cancel_reason' => $request->input('cancel_reason'),
        ]);

        return response()->json(['success' => 'Order cancelled successfully! You will receive a refund of 90% of the order value after 3-7 days from the date of cancellation.']);
    }


    // buy again
    public function buyAgain(Order $order)
    {
        $originalProducts = $order->orderItems;


        $cart = auth()->user()->carts;

        foreach ($originalProducts as $originalProduct) {
            // dd($originalProduct->productWarehouse->quantity);

            if($originalProduct->quantity > $originalProduct->productWarehouse->quantity) {
                return redirect()->back()->with('error', 'Products added to cart FAILED! Not enough quantity in warehouse!');
            }


            $existingCartItem = CartItem::where('product_id', $originalProduct->product->id)
                ->where('cart_id', $cart->id)
                ->first();

            if ($existingCartItem) {
                $existingCartItem->update([
                    'quantity' => $existingCartItem->quantity + $originalProduct->quantity,
                ]);
            } else {
                CartItem::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $originalProduct->product->id,
                    'quantity' => $originalProduct->quantity,
                    'cart_id' => $cart->id,
                ]);
            }
        }

        return redirect()->route('client.cart.index')->with('success', 'Products added to cart successfully!');
    }
}
