<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Models\Company;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc("id")->get();
        return view("categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = new Category();
        return view("categories.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route("categories.index")->with("success", 'Categoria ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // 1. Traemos TODAS las categorías para que tu menú izquierdo siempre se dibuje
    $categories = Category::all(); 
    
    // 2. Buscamos la categoría específica a la que le dieron clic
    $categoriaActual = Category::findOrFail($id);
    
    // 3. Traemos las empresas que pertenecen solo a esta categoría
    $companies = Company::where('category_id', $id)->get();

    // 4. Retornamos la vista welcome enviando las 3 variables
    return view('usuario.explorar', compact('categories', 'categoriaActual', 'companies'));
}

/**
     * Display the explore page with filters.
     */
    public function explorar(Request $request)
    {
        // 1. Iniciamos la consulta base para los negocios
        $query = Company::query();

        // 2. Si la URL trae una categoría (ej. ?categoria=Salud)
        if ($request->filled('categoria')) {
            $nombreCategoria = $request->categoria;
            
            // Buscamos el ID de esa categoría en tu base de datos
            // Nota: El nombre en tu BD debe coincidir con el de la vista (ej. "Salud", "Tecnología")
            $categoriaBD = Category::where('name', $nombreCategoria)->first();

            if ($categoriaBD) {
                // Si la categoría existe, filtramos las empresas por su ID
                $query->where('category_id', $categoriaBD->id);
            } else {
                // Si la categoría no existe en la BD, forzamos a que devuelva 0 resultados
                $query->where('id', 0);
            }
        }

        // 3. Ejecutamos la consulta a MySQL
        $companies = $query->get();

        // 4. Retornamos la vista enviando solo los negocios filtrados
        return view('usuario.explorar', compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view("categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route("categories.index")->with("success", 'Categoria ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route("categories.index")->with("success", 'Categoria ha sido eliminado correctamente.');
    }
}
