<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Http\Requests\OfferRequest;
use App\Models\Product;
use Illuminate\view\View;

class OfferController extends Controller
{
    public function success()
    {
        return view('offers.success');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::with("product")->get();
        return view("offers.index", compact("offers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offer = new Offer();
        $products = Product::all();
        return view("offers.create", compact("offer", "products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {
        Offer::create($request->validated());
        return redirect()->route("offers.index")->with("success", "Oferta a sido creada correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $offer = Offer::with("product")->findOrFail($offer->id);
        return view("offers.show", compact("offer"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offer = Offer::with("product")->findOrFail($id);
        $products = Product::all();
        return view("offers.edit", compact("offer", "products"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, string $id)
    {
        $offer = Offer::with("product")->findOrFail($id);
        $offer->update($request->validated());
        return redirect()->route("offers.index")->with("success", "Oferta a sido actualizada correctamente.");
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = Offer::with("product")->findOrFail($id);
        $offer->delete();
        return redirect()->route("offers.index")->with("success", "Oferta a sido eliminada correctamente.");
    }
}
