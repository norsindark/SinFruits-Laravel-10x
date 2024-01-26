<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    
    public function showDetails($title)
    {
        $product = Product::where('title', $title)->first();

        if (!$product) {
            abort(404);
        }
        $reviews = $product->productReviews()->paginate(4);

        if ($reviews->isEmpty()) {
            $reviews = [];
        }
        return view('client.pages.products.product-details', compact('product', 'reviews'));
    }



    // search products
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $searchProducts = Product::where('name', 'like', '%' . $keyword . '%')->paginate(12);

        return view('client.pages.products.searchIndex', compact('searchProducts', 'keyword'));
    }


    // sort products
    public function sortProducts(Request $request)
    {
        $sortOption = $request->input('sort_by');

        $products = Product::paginate(12);

        switch ($sortOption) {
            case 1:
                $sortedProducts = $products->sortBy('name');
                break;
            case 2:
                $sortedProducts = $products->sortByDesc('rating');
                break;
            case 3:
                $sortedProducts = $products->sortByDesc('created_at');
                break;
            case 4:
                $sortedProducts = $products->sortBy(function ($product) {
                    return optional($product->product_details)->price;
                });
                break;
            case 5:
                $sortedProducts = $products->sortByDesc(function ($product) {
                    return optional($product->product_details)->price;
                });
                break;
            default:
                $sortedProducts = $products;
        }

        return view('client.pages.products.sorted', ['sortedProducts' => $sortedProducts]);
    }
}
