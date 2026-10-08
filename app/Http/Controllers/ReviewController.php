<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar los datos recibidos
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // 2. Guardar en la base de datos
        Review::create([
            'user_id' => auth()->id(),
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        // 3. Regresar a la página anterior con un mensaje de éxito
        return back()->with('success', '¡Gracias por compartir tu experiencia!');
    }
}