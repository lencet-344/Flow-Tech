<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Request\BrandRequest;
use App\Models\Product;
use illuminate\http\redirectResponse;
use illuminate\view\View;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with("product")->get();
        return view("brands.index", compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = new Brand();
        $products = Product::all();
        return view("brands.create", compact("brand", "products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        Brand::create($request->validated());
        return redirect()->route("brands.index")->with("success", "Marca a sido creada correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        $brand = Brand::with("product")->findOrFail($brand->id);
        return view("brands.show", compact("brand"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::with("product")->findOrFail($id);
        $products = Product::all();
        return view("brands.edit", compact("brand", "products"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id) RedirectResponse
    {
        $brand = Brand::with("product")->findOrFail($id);
        $brand->update($request->validated());
        return redirect()->route("brands.index")->with("success", "Marca a sido actualizada correctamente.");
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::with("product")->findOrFail($id);
        $brand->delete();
        return redirect()->route("brands.index")->with("success", "Marca a sido eliminada correctamente.");
    }
}
