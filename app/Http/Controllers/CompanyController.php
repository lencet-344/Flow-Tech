<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        $company = Company::first() ?? new Company();
        $categories = \App\Models\Category::all();
        return view('admin.perfil', compact('company', 'categories'));
    }

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
        $companies = new Company();
        return view("companies.create", compact("companies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());
        return redirect()->route("companies.index")->with("success", 'Empresa ha sido creado correctamente.');
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
        $data = $request->validated();
        $company->update($data);

        if ($request->hasFile('logo')) {
            if ($company->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($company->logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($company->logo);
            }
            $path = $request->file('logo')->store('companies', 'public');
            $company->logo = $path;
            $company->save();
        }
        
        return back()->with("success", "Empresa actualizada correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route("companies.index")->with("success", 'Empresa ha sido eliminado correctamente.');
    }

    /**
     * Muestra el perfil público del negocio a los clientes.
     */
    public function publicProfile(Request $request)
    {
        // 1. Capturamos el nombre del negocio de la URL (?negocio=Lebron-Clemente)
        $nombreNegocio = $request->query('negocio');
        
        $negocio = null;

        // 2. Buscamos en la base de datos (modelo Company) donde el nombre coincida
        if ($nombreNegocio) {
            $negocio = Company::where('name', $nombreNegocio)->first();
        }

        // Fallback 1: Si no hay negocio por URL, buscamos el del usuario autenticado por correo
        if (!$negocio && auth()->check()) {
            $negocio = Company::where('email', auth()->user()->email)->first();
        }

        // Fallback 2: Si aún no hay negocio (o no está logueado), tomamos el primero de la BD
        if (!$negocio) {
            $negocio = Company::first();
        }

        // Si definitivamente no hay ninguna empresa registrada en toda la BD
        if (!$negocio) {
            abort(404, 'No hay negocios registrados en el sistema.');
        }

        // 3. Retornamos la vista pública enviándole la variable $negocio
        return view('public.profile', compact('negocio'));
    }
}
