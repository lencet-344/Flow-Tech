<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RoleRequest;  
use App\Models\User;

use Illuminate\view\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with("user")->get();
        return view("roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = new Role();
        $users = User::all();
        return view("roles.create", compact("role", "users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->validated());
        return redirect()->route("roles.index")->with("success", 'Rol ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role = Role::with("user")->findOrFail($role->id);
        return view("roles.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::with("user")->findOrFail($id);
        $users = User::all();
        return view("roles.edit", compact("role", "users"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::with('user')->findOrFail($id);
        $role->update($request->validated());
        return redirect()->route('roles.index')->with('success', 'Rol ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::with('user')->findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Roles ha sido eliminada correctamente.');
    }
}
