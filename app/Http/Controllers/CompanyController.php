<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\CompanyRequest;
use App\Models\Company;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::orderByDesc("id")->get();
        return view("companies.index", compact("companies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = new Company::all();
        return view("companies.create", compact("companies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());
        return redirect()->route("companies.index")->with("success", "Empresa a sido creado correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view("companies.show", compact("company"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view("companies.edit", compact("company"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect()->route("companies.index")->with("success", "Empresa a sido actualizado correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route("companies.index")->with("success", "Empresa a sido eliminado correctamente.");
    }
}
