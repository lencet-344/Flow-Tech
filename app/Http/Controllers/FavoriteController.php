<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FavoriteRequest;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Product;
use Illuminate\view\view;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $rawFavorites = Favorite::where('user_id', $userId)->get();

        $companyIds = [];
        $productIds = [];
        $favMap = [];

        foreach ($rawFavorites as $fav) {
            if (str_starts_with($fav->name, "U:{$userId}|C:")) {
                $cId = (int) explode('|C:', $fav->name)[1];
                $companyIds[] = $cId;
                $favMap['company_'.$cId] = $fav->id;
            } elseif (str_starts_with($fav->name, "U:{$userId}|P:")) {
                $pId = (int) explode('|P:', $fav->name)[1];
                $productIds[] = $pId;
                $favMap['product_'.$pId] = $fav->id;
            }
        }

        $companies = \App\Models\Company::whereIn('id', $companyIds)->get();
        foreach ($companies as $c) {
            $c->favorite_id = $favMap['company_'.$c->id];
        }

        $products = \App\Models\Product::with(['supplier', 'brand', 'category'])->whereIn('id', $productIds)->get();
        foreach ($products as $p) {
            $p->favorite_id = $favMap['product_'.$p->id];
        }

        return view("favorites.index", compact('companies', 'products'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|in:company,product',
            'id' => 'required|integer'
        ]);

        $userId = auth()->id();
        $type = $request->type;
        $targetId = $request->id;
        
        $nameVal = "U:{$userId}|" . ($type === 'company' ? 'C' : 'P') . ":{$targetId}";
        
        $favorite = Favorite::where('user_id', $userId)->where('name', $nameVal)->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
            $favorited = false;
        } else {
            $productId = ($type === 'product') ? $targetId : \App\Models\Product::value('id');
            if (!$productId) $productId = 1;

            Favorite::create([
                'user_id' => $userId,
                'name' => $nameVal,
                'type_product' => $type,
                'product_id' => $productId,
            ]);
            $status = 'added';
            $favorited = true;
        }

        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => $status, 'favorited' => $favorited]);
        }

        return back();
    }

    public function create()
    {
        $favorite = new Favorite();
        $users = User::all();
        $products = Product::all();
        return view('favorites.create',compact('favorite','users', 'products'));
    }

    public function store(FavoriteRequest $request)
    {
        Favorite::create($request->validated());
        return redirect()->route('favorites.index')->with('success', 'Favoritos ha sido creada correctamente.');
    }

    public function show(Favorite $favorite)
    {
        $favorite = Favorite::with('product')->findOrFail($favorite->id);
        return view('favorites.show', compact('favorite'));
    }

    public function edit(string $id)
    {
        $favorite = Favorite::with('product')->findOrFail($id);
        $users = User::all();
        $products = Product::all();
        return view('favorites.edit', compact('favorite', 'users', 'products'));
    }

    public function update(FavoriteRequest $request, string $id)
    {
        $favorite = Favorite::with('product')->findOrFail($id);
        $favorite->update($request->validated());
        return redirect()->route('favorites.index')->with('success', 'Favoritos ha sido actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();
        return redirect()->route('favorites.index')->with('success', 'Favorito eliminado correctamente.');
    }
}
