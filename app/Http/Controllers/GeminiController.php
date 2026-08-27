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
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        $response = Http::post($url, [
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
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No se generó respuesta.';
            return response()->json(['reply' => $reply]);
        }

        return response()->json(['error' => 'Error al conectar con la API de Gemini.'], 500);
    }
}