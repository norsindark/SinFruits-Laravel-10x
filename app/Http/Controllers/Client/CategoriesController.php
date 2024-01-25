<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    public function index()
    {
        return view('client.pages.categories.index');
    }


    //show by categories
    public function showByCategory($category_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $productsByCategory = $category->products()->paginate(12);

        return view('client.pages.categories.showByCategory', compact('productsByCategory', 'category'));
    }
}
