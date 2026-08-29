<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string'
        ]);

        $apiKey = config('services.gemini.key');

        // Endpoint actualizado al modelo gemini-3.6-flash
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key={$apiKey}";

        $response = Http::post($url, [
            'system_instruction' => [
                'parts' => [
                    [
                        'text' => 'Eres el asistente oficial de Singky en Estelí, Nicaragua. Ayudas a gestionar inventarios, pedidos de supermercados y logística con proveedores. Responde de forma concisa y profesional.'
                    ]
                ]
            ],
            'contents' => [
                [
                    'parts' => [
                        ['text' => $request->prompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No se obtuvo respuesta.';
            return response()->json(['reply' => $reply]);
        }

        return response()->json(['error' => $response->body()], 500);
    }
}