<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $products = Product::with('product_details')->paginate($perPage);
        return view('dashboard.pages.products.index', compact('products'));
    }


    //show form
    public function create()
    {
        return view('dashboard.pages.products.create');
    }

    //create
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'numeric',
            'quantity' => 'integer|min:1',
            'description' => 'string',
            'warehouse_id' => 'required|exists:warehouses,id',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $currentDateTime = Carbon::now();

        $product = Product::create([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'created_at' => $currentDateTime,
        ]);


        ProductDetail::create([
            'product_id' => $product->id,
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('image_path')) {
            $images = $request->file('image_path');
            foreach ($images as $image) {
                $imageContents = file_get_contents($image->path()); 
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(storage_path('app/public/products'), $imageName); 
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'http://127.0.0.1:8000/storage/products/' . $imageName,
                ]);
            }
        }
        
        

        $product->warehouses()->attach([
            $request->input('warehouse_id') => ['quantity' => $request->input('quantity')],
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    //show form edit
    public function show(Product $product)
    {
        return view('dashboard.pages.products.show', compact('product'));
    }

    //edit
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.pages.products.edit', compact('product', 'categories'));
    }

    //update
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }



    //delete
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully.');
    }
}
