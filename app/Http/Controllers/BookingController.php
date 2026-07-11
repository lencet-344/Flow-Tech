<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Request\BookingRequest;   
use App\Models\Supplier;
use Illuminate\http\redirectResponse;
use Illuminate\view\View;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with("supplier")->get();
        return view("bookings.index", compact("bookings"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $booking = new Booking();
        $suppliers = Supplier::all();
        return view("bookings.create", compact("booking", "suppliers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        Booking::create($request->validated());
        return redirect()->route("bookings.index")->with("success", "Reserva a sido creada correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking = Booking::with("supplier")->findOrFail($booking->id);
        return view("bookings.show", compact("booking"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::with("supplier")->findOrFail($id);
        $suppliers = Supplier::all();
        return view("bookings.edit", compact("booking", "suppliers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, string $id) RedirectResponse
    {
        $booking = Booking::with("supplier")->findOrFail($id);
        $booking->update($request->validated());
        return redirect()->route("bookings.index")->with("success", "Reserva a sido actualizada correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::with("supplier")->findOrFail($id);
        $booking->delete();
        return redirect()->route("bookings.index")->with("success", "Reserva a sido eliminada correctamente.");
    }
}
