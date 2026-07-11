<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request\FavoriteRequest;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Product;
use Illuminate\http\redirectResponse;
use Illuminate\view\view;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Favorite::with("product")->get();
        return view("favorites.index", compact("favorites"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $favorite = new Favorite();
        $users = User::all();
        $products = Product::class();
        return view('favorites.create',compact('favorite','users', 'products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(favoriteRequest $request)
    {
        Favorite::create($request->validated());
        return redirect()->route('favorites.index')->with('success', 'favoritos a sido creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        $favorite = Favorite::with('product')->findOrFail($favorite->id);
        return view('favorites.show', compact('favorite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $favorite = Favorite::with('product')->findOrFail($id);
        $users = User::all();
        $products = Product::all();
        return view('favorites.edit', compact('favorite', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FavoriteRequest $request, string $id)RedirectResponse
    {
        $favorite = Favorite::with('product')->findOrFail($id);
        $favorite->update($request->validated());
        return redirect()->route('favorites.index')->with('success', 'Favoritos a sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $favorite = Favorite::with('product')->findOrFail($id);
        $favorite->delete();
        return redirect()->route('favorites.index')->with('success', 'Favoritos a sido eliminada correctamente.');
    }
}
