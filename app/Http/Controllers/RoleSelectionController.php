<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleSelectionController extends Controller
{
    public function assignRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:cliente,proveedor,prestador_servicios',
        ]);

        $user = Auth::user();
        $user->role = $request->role;
        $user->save();

        // Redirigir al panel correspondiente según el rol elegido
        return match ($user->role) {
            'proveedor'           => redirect()->route('proveedor.dashboard'),
            'prestador_servicios' => redirect()->route('servicios.dashboard'),
            default               => redirect()->route('cliente.dashboard'),
        };
    }
}