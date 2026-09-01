<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $products = Product::where('nombre', 'like', "%$search%")->orderByDesc('id')->get();
        } else {
            $products = Product::orderByDesc("id")->get();
        }
        return view("products.index", compact("products", "search"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = new Product();
        $brands = \App\Models\Brand::all();
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();
        return view("products.create", compact("products", "brands", "categories", "suppliers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['code_bar'] = 'PRD-' . strtoupper(\Illuminate\Support\Str::random(6));
        $data['state'] = 'Activo';
        
        
        unset($data['brand_id']); 
        unset($data['category_id']);
        unset($data['supplier_id']); 
        
        Product::create($data);
        return redirect()->route("products.index")->with("success", 'Producto ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view("products.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $brands = \App\Models\Brand::all();
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();
        return view("products.edit", compact("product", "brands", "categories", "suppliers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        
        
        unset($data['brand_id']); 
        unset($data['category_id']);
        unset($data['supplier_id']); 
        
        $product->update($data);
        return redirect()->route("products.index")->with("success", 'Producto ha sido actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route("products.index")->with("success", 'Producto ha sido eliminado correctamente.');
    }
}
