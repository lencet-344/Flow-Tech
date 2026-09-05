<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    /**
     * Muestra la pantalla para que el usuario ingrese el código
     */
    public function index()
    {
        // IMPORTANTE: Asegúrate de poner aquí la ruta real de tu archivo blade.
        // Por ejemplo, si está en resources/views/auth/2fa.blade.php, pones 'auth.2fa'
        return view('auth.2fa'); 
    }

    /**
     * Valida el código ingresado contra la base de datos
     */
    public function verify(Request $request)
    {
        // Validamos que el campo 'code' venga en la petición
        $request->validate(['code' => 'required|numeric']);
        
        $user = auth()->user();

        // Verificamos si el código coincide y si no ha expirado
        if ($request->code == $user->two_factor_code && now()->lessThan($user->two_factor_expires_at)) {
            
            // ¡Éxito! Limpiamos los campos en la BD para dejarlo pasar
            $user->update([
                'two_factor_code' => null,
                'two_factor_expires_at' => null
            ]);

            return redirect()->route('dashboard'); // Entra al sistema
        }

        // Si falla, lo regresamos con un error
        return back()->withErrors(['code' => 'El código es incorrecto o ha expirado.']);
    }
}