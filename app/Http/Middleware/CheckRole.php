<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Verificamos si el usuario está logueado y si su rol en la BD coincide con el que pedimos
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request); // ¡Adelante, puedes pasar!
        }

        // Si no tiene el rol correcto, le mostramos un error 403 (Acceso Denegado)
        abort(403, 'No tienes permisos de ' . $role . ' para acceder a esta área.');
    }
}