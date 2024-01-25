<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

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

        $product = Product::create([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
        ]);


        ProductDetail::create([
            'product_id' => $product->id,
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);


        // if ($request->hasFile('image_path')) {

        //     $images = [];
        //     foreach ($request->file('image_path') as $image) {
        //         $imageName = 'product_image_' . time() . '_' . uniqid() . '.jpg';
        //         $images[] = ['product_id' => $product->id, 'image_path' => asset('storage/products/' . $imageName)];
        //         Storage::put('public/products/' . $imageName);
        //     }
        //     ProductImage::insert($images);
        // }

        $product->warehouses()->attach([
            $request->input('warehouse_id') => ['quantity' => $request->input('quantity')],
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    //save image
    // public function saveImages(array $images, $productId)
    // {
    //     $imageData = [];

    //     foreach ($images as $image) {
    //         $imageName = 'product_image_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //         $image->storeAs('public/products', $imageName);

    //         $imageData[] = [
    //             'product_id' => $productId,
    //             'image_path' => 'products/' . $imageName,
    //         ];
    //     }

    //     ProductImage::insert($imageData);
    // }


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
