<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    // index
    public function index()
    {
        return view('dashboard.pages.categories.index');
    }


    // show form
    public function create()
    {
        return view('dashboard.pages.categories.create');
    }


    // create
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully');
    }


    // product by category
    public function showByCategory($category_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $productsByCategory = $category->products()->paginate(12);

        return view('dashboard.pages.categories.show', compact('productsByCategory', 'category'));
    }



    // show form
    public function edit(Category $category)
    {
        return view('dashboard.pages.categories.edit', compact('category'));
    }


    //update
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }


    // delete
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()->route('dashboard.categories.index')->with('error', 'Cannot delete category with associated products');
        }

        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
    }
}
