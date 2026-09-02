<?php
$content = file_get_contents('resources/views/public/profile.blade.php');

// 1. Envolver en Alpine.js
$content = str_replace('<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10">', '<div x-data="{ tab: \'productos\', isFavorite: false }" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10">', $content);

// 2. Fix the buttons in Action Header
$btnSearch = <<<'HTML'
            <!-- Botones de Acci??n -->
            <div class="flex flex-wrap items-center gap-3 mt-6 pb-6 border-b border-gray-100">
                <button class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>Favorito</button>
                <button class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>Ver ubicaci??n</button>
                <button class="flex items-center gap-2 px-8 py-2.5 rounded-full bg-[#2563eb] text-white font-medium hover:bg-blue-700 transition text-sm shadow-md"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>Chatear</button>
            </div>
HTML;
// Note: character encoding might fail the exact search. Let's use regex.
$btnRegex = '/<!-- Botones de Acci.*?n -->.*?<div class="flex flex-wrap items-center gap-3 mt-6 pb-6 border-b border-gray-100">(.*?)<\/div>/is';

$btnReplace = <<<'HTML'
            <!-- Botones de Acción -->
            <div class="flex flex-wrap items-center gap-3 mt-6 pb-6 border-b border-gray-100">
                <button @click="isFavorite = !isFavorite" class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm group">
                    <svg :class="isFavorite ? 'text-red-500 scale-125' : 'text-gray-400 group-hover:scale-110'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isFavorite" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        <path x-show="isFavorite" style="display: none;" fill="currentColor" stroke="none" d="M3.172 5.172a4 4 0 015.656 0L12 8.343l3.172-3.171a4 4 0 115.656 5.656L12 21.657l-8.828-8.829a4 4 0 010-5.656z"></path>
                    </svg>
                    Favorito
                </button>
                <a href="https://maps.google.com/?q={{ urlencode($company->address ?? 'Nicaragua') }}" target="_blank" class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Ver ubicación
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->telephone ?? '') }}" target="_blank" class="flex items-center gap-2 px-8 py-2.5 rounded-full bg-[#2563eb] text-white font-medium hover:bg-blue-700 transition text-sm shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Chatear
                </a>
            </div>
HTML;
$content = preg_replace($btnRegex, $btnReplace, $content);

// 3. System tabs
$tabsRegex = '/<!-- 3. Pesta.*?as \(Tabs\) -->.*?<div class="flex items-center gap-2 mb-8">(.*?)<\/div>/is';
$tabsReplace = <<<'HTML'
        <!-- 3. Pestañas (Tabs) -->
        <div class="flex items-center gap-2 mb-8">
            <button @click="tab = 'productos'" :class="tab === 'productos' ? 'bg-[#2563eb] text-white shadow-md' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 shadow-sm'" class="px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Productos y Stock
            </button>
            <button @click="tab = 'reseñas'" :class="tab === 'reseñas' ? 'bg-[#2563eb] text-white shadow-md' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 shadow-sm'" class="px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Reseñas
            </button>
            <button @click="tab = 'informacion'" :class="tab === 'informacion' ? 'bg-[#2563eb] text-white shadow-md' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 shadow-sm'" class="px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Información
            </button>
        </div>
HTML;
$content = preg_replace($tabsRegex, $tabsReplace, $content);


// 4. Products Table replacement
$tableRegex = '/<!-- 4. Secci.*?n de Tabla de Productos -->.*?<\/table>\s*<\/div>\s*<\/div>/is';
$tableReplace = <<<'HTML'
        <!-- 4. Contenedores de Pestañas -->
        
        <!-- Pestaña: PRODUCTOS -->
        <div x-show="tab === 'productos'" x-transition>
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
                <h2 class="text-xl font-bold text-[#040116]">Productos y disponibilidad</h2>
                <div class="flex gap-2">
                    <span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-lg text-xs font-bold">{{ $company->products ? $company->products->where('quantity', '>', 0)->count() : 0 }} disponibles</span>
                    <span class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-lg text-xs font-bold">{{ $company->products ? $company->products->where('quantity', '<=', 0)->count() : 0 }} agotados</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-12">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/50">
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Marca</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Precio</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @if(isset($company->products) && $company->products->count() > 0)
                                @foreach($company->products as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&color=2563eb&background=eff6ff" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-bold text-[#040116]">{{ $item->name }}</h4>
                                                @if($item->code_bar)
                                                    <p class="text-xs text-gray-500">{{ $item->code_bar }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->brand->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold {{ $item->quantity > 0 ? 'text-gray-800' : 'text-gray-400' }}">{{ $item->quantity > 0 ? $item->quantity : '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if($item->quantity > 0)
                                            <span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span>
                                        @else
                                            <span class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Agotado</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ {{ number_format($item->cost ?? 0, 2) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        @if($item->quantity > 0)
                                            <button class="border border-[#2563eb] text-[#2563eb] hover:bg-blue-50 text-xs font-semibold px-5 py-2 rounded-lg transition-colors">Consultar</button>
                                        @else
                                            <button class="bg-gray-100 text-gray-400 text-xs font-semibold px-5 py-2 rounded-lg cursor-not-allowed" disabled>Agotado</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-sm">
                                        Este negocio aún no tiene productos publicados.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pestaña: RESEÑAS -->
        <div x-show="tab === 'reseñas'" x-transition style="display: none;">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center text-gray-500 mb-12">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Aún no hay reseñas</h3>
                <p class="text-sm">Sé el primero en compartir tu experiencia con este negocio.</p>
            </div>
        </div>

        <!-- Pestaña: INFORMACIÓN -->
        <div x-show="tab === 'informacion'" x-transition style="display: none;">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center text-gray-500 mb-12">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Acerca de {{ $company->name ?? 'este negocio' }}</h3>
                <p class="max-w-2xl mx-auto text-sm">{{ $company->description ?? 'No hay información adicional disponible por el momento.' }}</p>
            </div>
        </div>
HTML;
$content = preg_replace($tableRegex, $tableReplace, $content);

file_put_contents('resources/views/public/profile.blade.php', $content);
echo "Public profile wired up properly.\n";
?>
