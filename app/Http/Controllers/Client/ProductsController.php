<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function showDetails($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }
        return view('client.pages.products.product-details', compact('product'));
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $searchProducts = Product::where('name', 'like', '%' . $keyword . '%')->paginate(12);

        return view('client.pages.products.searchIndex', compact('searchProducts', 'keyword'));
    }
}
