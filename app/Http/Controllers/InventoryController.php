<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Http\Request\InventoryRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\http\redirectResponse;
use Illuminate\view\View;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with("product", "supplier")->get();
        return view("inventories.index", compact("inventories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventory = new Inventory();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view("inventories.create", compact("inventory", "products", "suppliers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request)
    {
        Inventory::create($request->validated());
        return redirect()->route("inventories.index")->with("success", "Inventario a sido creado correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        $inventory = Inventory::with("product", "supplier")->findOrFail($inventory->id);
        return view("inventories.show", compact("inventory"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventory = Inventory::with("product", "supplier")->findOrFail($id);
        $products = Product::all();
        $suppliers = Supplier::all();
        return view("inventories.edit", compact("inventory", "products", "suppliers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, string $id)RedirectResponse
    {
        $inventory = Inventory::with("product")->findOrFail($id);
        $inventory->update($request->validated());
        return redirect()->route("inventories.index")->with("success", "Inventario a sido actualizado correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory = Inventory::with("product")->findOrFail($id);
        $inventory->delete();
        return redirect()->route("inventories.index")->with("success", "Inventario a sido eliminado correctamente.");
    }
}
