<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;


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
        $suppliers = new Supplier();
        return view("suppliers.create", compact("suppliers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $data = $request->validated();
        $data['code_company'] = 'SUP-' . strtoupper(\Illuminate\Support\Str::random(6));
        Supplier::create($data);
        return redirect()->route("suppliers.index")->with("success", 'Proveedor ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view("suppliers.show", compact("supplier"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view("suppliers.edit", compact("supplier"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return redirect()->route("suppliers.index")->with("success", 'Proveedor ha sido actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route("suppliers.index")->with("success", 'Proveedor ha sido eliminado correctamente.');
    }
}
