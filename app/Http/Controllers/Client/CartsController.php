<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductWarehouse;
use App\Services\CartService;
use Illuminate\Support\Facades\Validator;

class CartsController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    //index
    public function index()
    {
        return view('client.pages.carts.index');
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
    // public function updateQuantity(Request $request, $productId)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'quantity' => 'required|int|min:1',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $newQuantity = $request->input('quantity');

    //     $productWarehouse = ProductWarehouse::where('product_id', $productId)->first();

    //     if ($productWarehouse->quantity < $newQuantity) {
    //         return redirect()->back()->with('error', 'Not enough quantity in the warehouse!');
    //     }

    //     $userId = Auth::user()->id;
    //     $userCart = Cart::where('user_id', $userId)->first();

    //     if (!$userCart) {
    //         return redirect()->back()->with('error', 'User cart not found!');
    //     }

    //     $product = Product::find($productId);

    //     if (!$product) {
    //         return redirect()->back()->with('error', 'Product not found!');
    //     }

    //     $existingProduct = $userCart->products()->where('product_id', $productId)->first();

    //     if ($existingProduct) {
    //         $existingProduct->pivot->quantity = $newQuantity;
    //         $existingProduct->pivot->save();
    //     } else {
    //         $userCart->products()->attach($productId, ['quantity' => $newQuantity]);
    //     }

    //     return redirect()->back()->with('success', 'Quantity updated successfully!');
    // }

    // public function updateQuantity(Request $request, $productId)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'quantity' => 'required|int|min:1',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $newQuantity = $request->input('quantity');

    //     $productWarehouse = ProductWarehouse::where('product_id', $productId)->first();

    //     if ($productWarehouse->quantity < $newQuantity) {
    //         return redirect()->back()->with('error', 'Not enough quantity in the warehouse!');
    //     }

    //     $user = Auth::user();
    //     $userCart = Cart::where('user_id', $user->id)->first();

    //     $existingProduct = $userCart->products()->find($productId);

    //     if ($existingProduct) {
    //         $existingProduct->pivot->update(['quantity' => $newQuantity]);
    //     } else {
    //         $userCart->products()->attach($productId, ['quantity' => $newQuantity]);
    //     }

    //     return response()->json(['success' => 'Update quantity successfully!']);
    // }


    public function updateQuantity(Request $request, $productId)
    {
        // dd($productId);
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|int|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $newQuantity = $request->input('quantity');

        $productWarehouse = ProductWarehouse::where('product_id', $productId)->first();

        if ($productWarehouse->quantity < $newQuantity) {
            return response()->json(['error' => 'Not enough quantity in the warehouse!'], 422);
        }

        $userId = Auth::user()->id;
        $userCart = Cart::where('user_id', $userId)->first();

        $existingProduct = $userCart->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            $existingProduct->pivot->quantity = $newQuantity;
            $existingProduct->pivot->save();
        } else {
            $userCart->products()->attach($productId, ['quantity' => $newQuantity]);
        }

        return response()->json(['success' => 'Update quantity successfully!']);
    }


    public function incrementQuantity(Request $request, $productId)
    {
        return $this->updateQuantity($request, $productId, 1);
    }

    public function decrementQuantity(Request $request, $productId)
    {
        return $this->updateQuantity($request, $productId, -1);
    }
}
