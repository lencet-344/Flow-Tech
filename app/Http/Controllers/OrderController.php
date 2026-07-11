<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;  
use App\Http\Request\OrderRequest;
use App\Models\Buy_verification;
use App\Models\User;
use Illuminate\http\redirectResponse;
use Illuminate\view\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with("user")->get();
        return view("orders.index", compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order = new Order();
        $users = User::all();
        $buy_verifications = Buy_verification::class();
        return view('orders.create',compact('order','users', 'buy_verifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        Order::create($request->validated());
        return redirect()->route('orders.index')->with('success', 'ordenes a sido creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = Order::with('user')->findOrFail($order->id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::with('user')->findOrFail($id);
        $users = User::all();
        $buy_verifications = Buy_Verification::all();
        return view('orders.edit', compact('order', 'users', 'buy_verifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)RedirectResponse
    {
        $order = Order::with('user')->findOrFail($id);
        $order->update($request->validated());
        return redirect()->route('orders.index')->with('success', 'ordenes a sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::with('user')->findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'ordenes a sido eliminada correctamente.');
    }
}
