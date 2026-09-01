<?php

namespace App\Http\Controllers;
use App\Models\Buy_verification;
use App\Http\Requests\Buy_verificationRequest;
use App\Models\Order;
use Illuminate\View\view;

use Illuminate\Http\Request;

class Buy_verificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buy_verifications = Buy_verification::with("order")->get();
        return view("buy_verifications.index", compact("buy_verifications"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buy_verification = new Buy_verification();
        $orders = Order::all();
        return view("buy_verifications.create", compact('buy_verification', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Buy_verificationRequest $request)
    {
        $verification = Buy_verification::create($request->validated());
        
        if ($request->has('order_id') && $request->order_id) {
            $order = Order::find($request->order_id);
            if ($order) {
                $order->buy_verifications_id = $verification->id;
                $order->save();
            }
        }

        return redirect()->route("buy_verifications.index")->with('success', 'Verificacion de compra ha sido creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buy_verification $buy_verification)
    {
    
        $buy_verification = Buy_verification::with('order')->findOrFail($buy_verification->id);
        return view("buy_verifications.show", compact('buy_verification'));  
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buy_verification = Buy_verification::with('order')->findOrFail($id);
        $orders = Order::all();
        return view('buy_verifications.edit', compact('buy_verification', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Buy_verificationRequest $request, string $id)
    {
        $buy_verification = Buy_verification::with('order')->findOrFail($id);
        $buy_verification->update($request->validated());
        
        if ($request->has('order_id') && $request->order_id) {
            if ($buy_verification->order && $buy_verification->order->id != $request->order_id) {
                $oldOrder = $buy_verification->order;
                $oldOrder->buy_verifications_id = null;
                $oldOrder->save();
            }
            
            $order = Order::find($request->order_id);
            if ($order) {
                $order->buy_verifications_id = $buy_verification->id;
                $order->save();
            }
        } else {
            if ($buy_verification->order) {
                $oldOrder = $buy_verification->order;
                $oldOrder->buy_verifications_id = null;
                $oldOrder->save();
            }
        }

        return redirect()->route('buy_verifications.index')->with('success', 'Verificacion de compra ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buy_verification = Buy_verification::with('order')->findOrFail($id);
        $buy_verification->delete();
        return redirect()->route('buy_verifications.index')->with('success', 'Verificacion de compra ha sido eliminada correctamente.');
    }
}
