<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trade;
use App\Http\Request\TradeRequest;
use App\Models\Product;

use Illuminate\http\redirectResponse;
use Illuminate\view\View;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trades = Trade::with("product")->get();
        return view("trades.index", compact("trades"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trade = new Trade();
        $products = Product::all();
        return view("trades.create", compact("trade", "products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TradeRequest $request)
    {
        Trade::create($request->validated());
        return redirect()->route("trades.index")->with("success", "Comercio a sido creado correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $trade = Trade::with("product")->findOrFail($id);
        $products = Product::all();
        return view("trades.edit", compact("trade", "products"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TradeRequest $request, string $id) RedirectResponse
    {
        $trade = Trade::with("product")->findOrFail($id);
        $trade->update($request->validated());
        return redirect()->route("trades.index")->with("success", "Comercio a sido actualizado correctamente.");
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trade = Trade::with("product")->findOrFail($id);
        $trade->delete();
        return redirect()->route("trades.index")->with("success", "Comercio a sido eliminado correctamente.");
    }
}
