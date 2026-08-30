<?php
$content = file_get_contents('resources/views/public/profile.blade.php');

$tableRegex = '/<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">.*?<\/table>\s*<\/div>\s*<\/div>/is';

$tableReplace = <<<'HTML'
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
                <h2 class="text-xl font-bold text-[#040116]">Productos y disponibilidad</h2>
                <div class="flex gap-2">
                    <span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-lg text-xs font-bold">{{ isset($company) && $company->id ? $company->products()->where('quantity', '>', 0)->count() : 0 }} disponibles</span>
                    <span class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-lg text-xs font-bold">{{ isset($company) && $company->id ? $company->products()->where('quantity', '<=', 0)->count() : 0 }} agotados</span>
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
                            @forelse(isset($company) && $company->id ? $company->products : [] as $item)
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
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-sm">
                                        Este negocio aún no tiene productos publicados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
HTML;

$content = preg_replace($tableRegex, str_replace('$', '\$', $tableReplace), $content); 
// wait preg_replace will interpret $ as backreference. If I use str_replace it's safer. Let's do regex match then str_replace!

if(preg_match($tableRegex, $content, $matches)){
    $content = str_replace($matches[0], $tableReplace, $content);
}

file_put_contents('resources/views/public/profile.blade.php', $content);
echo "Restored and blinded correctly.\n";
?>
