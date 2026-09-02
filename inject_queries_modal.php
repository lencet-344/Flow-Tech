<?php
$file = 'resources/views/superadmin/queries.blade.php';
$content = file_get_contents($file);

// Add $item = null at top to prevent undefined errors
if (strpos($content, '$item = null;') === false) {
    $content = str_replace("@section('content')", "@section('content')\n@php \$item = null; @endphp", $content);
}

$searchRegex = '/<td class="px-6 py-4 text-center">\s*<button class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1\.5 rounded-xl text-xs font-semibold transition">Abrir<\/button>\s*<\/td>/is';

$replace = <<<'HTML'
<td class="px-6 py-4 text-center">
                            <div x-data="{ openConsulta: false }">
                                <button @click="openConsulta = true" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>

                                <!-- Modal de Consulta -->
                                <div x-show="openConsulta" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50" x-transition>
                                    <div @click.away="openConsulta = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 text-left relative mx-4 whitespace-normal">
                                        
                                        <!-- Cabecera -->
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item?->subject ?? 'Detalle de la consulta' }}</h3>
                                        
                                        <!-- Metadatos -->
                                        <p class="text-sm text-gray-500 mb-6">
                                            Enviado por: <strong>{{ $item?->user?->name ?? 'Usuario' }}</strong> el {{ isset($item) && $item->created_at ? $item->created_at->format('Y-m-d') : 'fecha' }}
                                        </p>

                                        <!-- Cuerpo del mensaje -->
                                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 mb-6 border border-gray-100 text-sm leading-relaxed">
                                            {{ $item?->message ?? 'El usuario no proporcionó más detalles en su consulta inicial.' }}
                                        </div>

                                        <!-- Controles -->
                                        <div class="flex justify-end gap-3 mt-4">
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Volver</button>
                                            
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Marcar como Resuelta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
HTML;

$content = preg_replace($searchRegex, $replace, $content);
file_put_contents($file, $content);

echo "Queries modal injected.\n";
?>
