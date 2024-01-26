<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductWarehouse;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;


class WarehouseController extends Controller
{

    //index
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('dashboard.pages.warehouses.index', compact('warehouses'));
    }

    public function updateQuantitySold()
    {
        DB::table('product_warehouses')->update([
            'quantity_sold' => 0
        ]);

        DB::table('product_warehouses')->update([
            'quantity_sold' => DB::raw('import_quantity - IFNULL(quantity, 0)')
        ]);

        return redirect()->back()->with('success', 'Quantity update successfully!');
    }


    //show form
    public function create()
    {
        return view('dashboard.pages.warehouses.create');
    }


    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Warehouse::create($request->all());

        return redirect()->route('dashboard.warehouses.index')->with('success', 'Warehouse created successfully.');
    }



    // show warehouse
    public function show(Warehouse $warehouse)
    {
        $products = $warehouse->product_warehouse;
        $productCount = $products ? $products->count() : 0;
        return view('dashboard.pages.warehouses.show', compact('warehouse', 'products', 'productCount'));
    }


    // show products    
    public function showProducts(Warehouse $warehouse)
    {
        $perpage = 10;
        $products = $warehouse->product_warehouse()->paginate($perpage);
        return view('dashboard.pages.warehouses.show_products', compact('warehouse', 'products'));
    }


    // show form
    public function edit(Warehouse $warehouse)
    {
        return view('dashboard.pages.warehouses.edit', compact('warehouse'));
    }


    // update
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $warehouse->update($request->all());

        return redirect()->route('dashboard.warehouses.index')->with('success', 'Warehouse updated successfully.');
    }


    // delete
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('dashboard.warehouses.index')->with('success', 'Warehouse deleted successfully.');
    }


    // show form
    public function showFormUpdate(Product $id)
    {
        $item = Product::find($id)->first();
        return view('dashboard.pages.warehouses.update-quantity', compact('item'));
    }


    // update quantity
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|int|min:1',
        ]);

        $productWarehouse = ProductWarehouse::where('product_id', $id)->first();

        $productWarehouse->import_quantity += $request->input('quantity');
        $productWarehouse->quantity += $request->input('quantity');

        $productWarehouse->save();

        return redirect()->back()->with('success', 'Quantities updated successfully!');
    }
}
