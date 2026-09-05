<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Si el usuario está logueado pero aún tiene un código activo en la BD, no lo dejamos pasar
        if ($user && $user->two_factor_code) {
            
            // Excepción: Usamos routeIs() para verificar si ya está en CUALQUIER ruta que se llame '2fa.algo'
            if (!$request->routeIs('2fa.*')) {
                return redirect()->route('2fa.index');
            }
        }

        return $next($request);
    }
}