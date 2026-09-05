<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use Exception;

class GeminiController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function resetChat(Request $request)
    {
        session()->forget('gemini_chat_history');
        return response()->json(['status' => 'success']);
    }

    public function ask(Request $request)
    {
        try {
            $request->validate([
                'prompt' => 'nullable|string',
                'message' => 'nullable|string',
            ]);

            $promptText = $request->input('prompt') ?? $request->input('message');

            if (!$promptText) {
                return response()->json(['reply' => 'Por favor, escribe un mensaje válido.'], 422);
            }

            $apiKey = config('services.gemini.key');
            if (!$apiKey) {
                return response()->json(['reply' => 'Error de configuración: La API Key de Gemini no está definida.'], 500);
            }

            $stopWords = ['el', 'la', 'los', 'las', 'un', 'una', 'unos', 'unas', 'y', 'o', 'de', 'del', 'a', 'en', 'por', 'para', 'con', 'sin', 'es', 'que', 'como', 'cual', 'cuales', 'donde', 'quien', 'me', 'te', 'se', 'le', 'nos', 'os', 'les', 'mi', 'tu', 'su', 'hay', 'tiene', 'tienen', 'quiero', 'quisiera', 'necesito', 'busco', 'mostrar', 'muestrame', 'sobre'];
            
            $words = collect(explode(' ', mb_strtolower($promptText)))
                ->map(fn($w) => trim($w, ".,?!¿¡()[]{}\"'"))
                ->filter(fn($w) => mb_strlen($w) > 2 && !in_array($w, $stopWords));

            $relevantProducts = collect();
            if ($words->isNotEmpty()) {
                $relevantProducts = Product::with(['supplier', 'category'])
                    ->where(function($query) use ($words) {
                        foreach ($words as $word) {
                            $query->orWhere('name', 'like', "%{$word}%");
                        }
                    })
                    ->take(5)
                    ->get();
            }

            if ($relevantProducts->isEmpty()) {
                $relevantProducts = Product::with('supplier', 'category')->latest()->take(3)->get();
            }

            $productosContexto = $relevantProducts->map(function($p) {
                $supplierName = $p->supplier->name ?? 'Local';
                $categoryName = $p->category->name ?? 'General';
                return "- {$p->name} | Categoría: {$categoryName} | Precio: C$ {$p->cost} | Proveedor: {$supplierName}";
            })->implode("\n");

            $totalProductos = Product::count();
            $categorias = Category::pluck('name')->implode(', ');
            $proveedoresActivos = Company::where('status', 'activo')->take(5)->pluck('name')->implode(', ');

            $systemInstruction = "Eres Ki, el asistente virtual oficial de SINKI en Estelí, Nicaragua. " .
                "Ayudas a gestionar inventarios, pedidos mayoristas, supermercados y logística B2B con proveedores locales. " .
                "Usa esta información de la base de datos para responder de forma precisa:\n" .
                "• Total de productos en catálogo: {$totalProductos}\n" .
                "• Categorías disponibles: {$categorias}\n" .
                "• Proveedores activos: {$proveedoresActivos}\n" .
                "• Productos relevantes detectados para esta consulta:\n{$productosContexto}\n\n" .
                "Sé amable, conciso, profesional y céntrate en el mercado de Estelí.";

            $history = session()->get('gemini_chat_history', []);
            
            if (!empty($history) && $history[0]['role'] !== 'user') {
                array_shift($history);
            }

            $currentMessage = [
                'role' => 'user',
                'parts' => [['text' => $promptText]]
            ];

            $contents = $history;
            $contents[] = $currentMessage;

            $payload = [
                'system_instruction' => [
                    'parts' => [['text' => $systemInstruction]]
                ],
                'contents' => $contents
            ];

            // Usamos el modelo exacto que indicó el mensaje de error de Google
            $modelName = 'gemini-3.6-flash';
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$modelName}:generateContent?key={$apiKey}";
            
            $response = Http::withoutVerifying()->post($url, $payload);

            if ($response && $response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No se obtuvo respuesta.';

                $history[] = $currentMessage;
                $history[] = [
                    'role' => 'model',
                    'parts' => [['text' => $reply]]
                ];

                if (count($history) > 10) {
                    $history = array_slice($history, -10);
                }

                session()->put('gemini_chat_history', $history);

                return response()->json(['reply' => $reply]);
            }

            $apiError = $response ? $response->json() : 'No se pudo conectar con Google';
            
            return response()->json([
                'reply' => '⚠️ ERROR DETALLADO DE GEMINI: ' . json_encode($apiError)
            ], 500);

        } catch (Exception $e) {
            return response()->json([
                'reply' => 'Excepción en el Servidor: ' . $e->getMessage()
            ], 500);
        }
    }
}