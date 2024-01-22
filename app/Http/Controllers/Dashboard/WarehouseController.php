<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
// use App\Models\Product;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('dashboard.pages.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('dashboard.pages.warehouses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Warehouse::create($request->all());

        return redirect()->route('dashboard.warehouses.index')->with('success', 'Warehouse created successfully.');
    }

    public function show(Warehouse $warehouse)
    {
        $products = $warehouse->product_warehouse;
        $productCount = $products ? $products->count() : 0;
        return view('dashboard.pages.warehouses.show', compact('warehouse', 'products', 'productCount'));
    }

    public function showProducts(Warehouse $warehouse)
    {
        $perpage = 10;
        $products = $warehouse->product_warehouse()->paginate($perpage);
        return view('dashboard.pages.warehouses.show_products', compact('warehouse', 'products'));
    }


    public function edit(Warehouse $warehouse)
    {
        return view('dashboard.pages.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $warehouse->update($request->all());

        return redirect()->route('dashboard.warehouses.index')->with('success', 'Warehouse updated successfully.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('dashboard.warehouses.index')->with('success', 'Warehouse deleted successfully.');
    }
}
