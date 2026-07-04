<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Request\SupplierRequest;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
        $suppliers = Supplier::orderByDesc("id")->get();
        return view("suppliers.index", compact("suppliers"));
    }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = new Supplier::all();
        return view("suppliers.create", compact("suppliers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        Supplier::create($request->validated());
        return redirect()->route("suppliers.index")->with("success", "Proveedor a sido creado correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Supplier::findOrFail($id);
        return view("suppliers.show", compact("customer"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Supplier::findOrFail($id);
        return view("suppliers.edit", compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return redirect()->route("suppliers.index")->with("success", "Proveedor a sido actualizado correctamente.");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route("suppliers.index")->with("success", "Proveedor a sido eliminado correctamente.");
    }
}
