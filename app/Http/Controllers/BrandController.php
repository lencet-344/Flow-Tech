<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use App\Models\Product;
use illuminate\view\View;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with("category")->get();
        return view("brands.index", compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = \App\Models\Category::all();
        return view('brands.create', compact('categories'));
    }

    public function store(BrandRequest $request) {
        Brand::create($request->validated());
        return redirect()->route('brands.index')->with('success', 'Marca creada exitosamente.');
    }

    public function show(Brand $brand)
    {
        $brand = Brand::with("category")->findOrFail($brand->id);
        return view("brands.show", compact("brand"));
    }

    public function edit($id) {
        $brand = Brand::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('brands.edit', compact('brand', 'categories'));
    }

    public function update(BrandRequest $request, $id) {
        $brand = Brand::findOrFail($id);
        $brand->update($request->validated());
        return redirect()->route('brands.index')->with('success', 'Marca actualizada exitosamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route("brands.index")->with("success", 'Marca ha sido eliminada correctamente.');
    }
}
