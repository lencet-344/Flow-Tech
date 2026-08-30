<?php
$file = 'resources/views/superadmin/publications.blade.php';
$content = file_get_contents($file);

$searchRegex = '/<td class="px-6 py-4 text-right">\s*<button class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">Moderar<\/button>\s*<\/td>/is';

$replace = <<<'HTML'
<td class="px-6 py-4 text-right">
                            <div x-data="{ modalOpen: false }">
                                <button @click="modalOpen = true" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">Moderar</button>

                                <!-- Modal de Moderación -->
                                <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>
                                    <div @click.away="modalOpen = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 text-left relative mx-4 whitespace-normal">
                                        <!-- Cabecera -->
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">Moderar Contenido</h3>
                                        <p class="text-sm text-gray-500 mb-6">
                                            ¿Qué acción deseas tomar sobre la publicación de <strong>{{ $item->product->name ?? 'Producto' }}</strong> del negocio <strong>{{ $item->company->name ?? 'Desconocido' }}</strong>?
                                        </p>

                                        <!-- Controles -->
                                        <div class="flex justify-end gap-3 mt-6">
                                            <button @click="modalOpen = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Mantener (OK)</button>
                                            
                                            <form action="{{ route('inventories.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 font-semibold text-white rounded-lg hover:bg-red-700 transition shadow-sm">Eliminar Publicación</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
HTML;

$content = preg_replace($searchRegex, $replace, $content);
file_put_contents($file, $content);

echo "Modal of moderation injected successfully.\n";
?>
