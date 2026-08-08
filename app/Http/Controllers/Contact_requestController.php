<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact_request;
use App\Http\Request\Contact_request_Request;
use App\Models\Company;
use Illuminate\view\View;

class Contact_requestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact_requests = Contact_request::with('company')->get();
        return view('contact_requests.index', compact('contact_requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contact_request = new Contact_request();
        $companies = Company::all();
        return view('contact_requests.create', compact('contact_request', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Contact_requestRequest $request)
    {
        Contact_request::create($request->validated());
        return redirect()->route('contact_requests.index')->with('succes','Contacto a sido creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact_request $contact_request)
    {
        $contact_request = Contact_request::with('company')->findOrFail($contact_request->id);
        return view('contact_requests.show', compact('contact_request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact_request = Contact_request::with('company')->findOrFail($id);
        $companies = Company::all();
        return view('contact_requests.edit', compact('contact_request', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Contact_requestsRequest $request, string $id)
    {
        $contact_request = Contact_request::with('company')->findOrFail($id);
        $contact_request->update($request->validated());
        return redirect()->route('contact_requests.index')->with('success', 'Contacto a sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact_request = Contact_request::with('company')->findOrFail($id);
        $contact_request->delete();
        return redirect()->route('contact_requests.index')->with('success', 'Contacto a sido eliminada correctamente.');
    }
}
