<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $products = Product::with('product_details')->paginate($perPage);
        return view('dashboard.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            // Add any other validation rules as needed
        ]);

        Product::create($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('dashboard.pages.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            // Add any other validation rules as needed
        ]);

        $product->update($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully.');
    }
}
