<?php

// app/Services/CartService.php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartService
{
    public function getIndexData()
    {
        if (auth()->check()) {
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

            $count = $cartItems->count();

            return [
                'cartItems' => $cartItems,
                'subTotal' => $subTotal,
                'vat' => $vat,
                'total' => $total,
                'count' => $count,
            ];
        } else {
            return view('client.pages.carts.index', ['cartItems' => []]);
        }
    }

    //     public function getIndexData()
    // {
    //     if (auth()->check()) {
    //         $userId = Auth::user()->id;
    //         $cart = Cart::where('user_id', $userId)->first();

    //         if (!$cart) {
    //             return view('client.pages.carts.index', ['cartItems' => []]);
    //         }

    //         $cartItems = $cart->products;
    //         $subTotal = $cartItems->sum(function ($item) {
    //             return $item->product_details->price * $item->pivot->quantity;
    //         });

    //         $couponCode = 'YOUR_COUPON_CODE'; // Replace with your actual coupon code
    //         $couponPercentage = $this->getCouponPercentage($couponCode);

    //         if ($couponPercentage > 0) {
    //             $couponDiscount = $subTotal * ($couponPercentage / 100);
    //             $subTotal -= $couponDiscount;
    //         }

    //         $vat = $subTotal * 0.1;
    //         $total = $subTotal + $vat;

    //         $count = $cartItems->count();

    //         return [
    //             'cartItems' => $cartItems,
    //             'subTotal' => $subTotal,
    //             'vat' => $vat,
    //             'total' => $total,
    //             'count' => $count,
    //             'couponDiscount' => isset($couponDiscount) ? $couponDiscount : 0,
    //         ];
    //     } else {
    //         return view('client.pages.carts.index', ['cartItems' => []]);
    //     }
    // }

    // private function getCouponPercentage($couponCode)
    // {

    //     return Coupon::where('code', $couponCode)->value('percentage') ?? 0;
    // }

}
