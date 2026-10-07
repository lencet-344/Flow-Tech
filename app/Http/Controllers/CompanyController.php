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
        $company = Company::where('email', auth()->user()->email)->first() 
                ?? auth()->user()->company 
                ?? Company::where('name', 'wawastech')->first() 
                ?? Company::latest('id')->first();
                
        if ($company && empty($company->name)) {
            $company->name = 'wawastech';
            $company->description = 'nolose9';
            $company->save();
        }

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
    public function update(Request $request, Company $company)
    {
        if ($request->hasFile('logo')) {
            $request->validate(['logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120']);
            if ($company->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($company->logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($company->logo);
            }
            $company->logo = $request->file('logo')->store('companies', 'public');
            $company->save();
            return back()->with("success", "¡Foto del negocio actualizada correctamente!");
        }

        if ($request->hasFile('banner')) {
            $request->validate(['banner' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120']);
            
            if (!is_dir(public_path('images/banners'))) {
                mkdir(public_path('images/banners'), 0755, true);
            }

            $ext = $request->file('banner')->getClientOriginalExtension() ?: 'jpg';
            
            array_map('unlink', glob(public_path('images/banners/company_' . $company->id . '.*')) ?: []);
            
            $filename = 'company_' . $company->id . '.' . $ext;
            $request->file('banner')->move(public_path('images/banners'), $filename);

            return back()->with("success", "¡Banner del negocio actualizado correctamente!");
        }

        $request->validate([
            'name' => 'sometimes|nullable|string|max:255',
            'category_id' => 'sometimes|nullable|integer',
            'description' => 'sometimes|nullable|string',
            'telephone' => 'sometimes|nullable|string|max:20',
            'email' => 'sometimes|nullable|email|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'website' => 'sometimes|nullable|string|max:255',
            'horario' => 'sometimes|nullable|string|max:255',
        ]);

        $company->name = $request->filled('name') ? $request->name : $company->name;
        $company->category_id = $request->filled('category_id') ? $request->category_id : $company->category_id;
        $company->description = $request->filled('description') ? $request->description : $company->description;
        $company->telephone = $request->filled('telephone') ? $request->telephone : $company->telephone;
        $company->email = $request->filled('email') ? $request->email : $company->email;
        $company->address = $request->filled('address') ? $request->address : $company->address;
        $company->website = $request->filled('website') ? $request->website : $company->website;
        $company->horario = $request->filled('horario') ? $request->horario : $company->horario;

        $company->save();
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
            
            if (!$negocio) {
                $desc = "Negocio registrado en la plataforma SINGKI.";
                $cat = 'Comercio / Servicios';
                $email = 'contacto@' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nombreNegocio)) . '.com';
                $dir = 'No especificada';
                $tel = 'No disponible';

                if ($nombreNegocio == 'Moda Express') {
                    $cat = 'Moda';
                    $desc = "Ropa y accesorios al por mayor. Colecciones para dama y caballero.";
                    $dir = "Av. Central, Estelí";
                    $tel = "8888-1020";
                    $email = "contacto@modaexpress.com";
                } elseif ($nombreNegocio == 'TechSolutions GT') {
                    $cat = 'Tecnología';
                    $desc = "Soluciones tecnológicas para empresas. Hardware y soporte.";
                    $dir = "Zona Centro, Estelí";
                    $tel = "8888-3040";
                    $email = "carlos@techsolutions.com";
                } elseif ($nombreNegocio == 'Distribuidora Alimentos Norte') {
                    $cat = 'Alimentos';
                    $desc = "Distribución mayorista de alimentos secos y enlatados.";
                    $dir = "Carretera Norte, Estelí";
                    $tel = "8888-5060";
                    $email = "ventas@alimentosnorte.com";
                }

                $negocio = (object)[
                    'id' => rand(1000, 9000),
                    'name' => $nombreNegocio,
                    'description' => $desc,
                    'category' => (object)['name' => $cat],
                    'address' => $dir,
                    'telephone' => $tel,
                    'email' => $email,
                    'horario' => 'Lunes a Viernes, 8:00 AM - 5:00 PM',
                    'created_at' => now(),
                    'logo' => null,
                    'website' => null,
                    'products' => collect([]),
                    'inventories' => collect([]),
                    'offers' => collect([]),
                ];
            }
        } else {
            // Fallback 1: Si no hay negocio por URL, buscamos el del usuario autenticado por correo
            if (auth()->check()) {
                $negocio = Company::where('email', auth()->user()->email)->first();
            }

            // Fallback 2: Si aún no hay negocio (o no está logueado), tomamos el primero de la BD
            if (!$negocio) {
                $negocio = Company::first();
            }
        }

        // Si definitivamente no hay ninguna empresa registrada en toda la BD
        if (!$negocio) {
            abort(404, 'No hay negocios registrados en el sistema.');
        }

        // 3. Retornamos la vista pública enviándole la variable $negocio
        return view('public.profile', compact('negocio'));
    }
}
