<?php
$content = file_get_contents('temp_inventories.blade.php');

$search = '<!-- Buscador y Filtros -->';
$replacement = <<<HTML
<div x-data="{ 
        filter: 'todos', 
        totalAgotados: {{ \$inventories->where('quantity', '<=', 0)->count() }}, 
        totalDisponibles: {{ \$inventories->where('quantity', '>', 0)->count() }} 
    }">
    <!-- Buscador y Filtros -->
HTML;

$content = str_replace($search, $replacement, $content);

// Buttons section
$searchBtns = <<<HTML
        <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
            <button class="bg-[#2563eb] text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm whitespace-nowrap">Todos</button>
            <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-sm whitespace-nowrap">Disponibles</button>
            <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-sm whitespace-nowrap">Agotados</button>
        </div>
HTML;
$replaceBtns = <<<HTML
        <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
            <button @click="filter = 'todos'" :class="filter === 'todos' ? 'bg-[#2563eb] text-white shadow-sm border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="border px-5 py-2.5 rounded-xl text-sm font-medium transition whitespace-nowrap">Todos</button>
            <button @click="filter = 'disponibles'" :class="filter === 'disponibles' ? 'bg-[#2563eb] text-white shadow-sm border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="border px-5 py-2.5 rounded-xl text-sm font-medium transition whitespace-nowrap">Disponibles</button>
            <button @click="filter = 'agotados'" :class="filter === 'agotados' ? 'bg-[#2563eb] text-white shadow-sm border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="border px-5 py-2.5 rounded-xl text-sm font-medium transition whitespace-nowrap">Agotados</button>
        </div>
HTML;
$content = str_replace($searchBtns, $replaceBtns, $content);

// Rows loop
$searchLoop = <<<'HTML'
@forelse($inventories ?? [] as $item)
<tr class="hover:bg-gray-50/50 transition-colors">
HTML;
$replaceLoop = <<<'HTML'
@forelse($inventories ?? [] as $item)
<tr x-show="filter === 'todos' || (filter === 'disponibles' && {{ $item->quantity ?? 0 }} > 0) || (filter === 'agotados' && {{ $item->quantity ?? 0 }} <= 0)" 
    x-transition
    class="hover:bg-gray-50/50 transition-colors">
HTML;
$content = str_replace($searchLoop, $replaceLoop, $content);

// Empty states
$searchEmpty = <<<'HTML'
@empty
<tr><td colspan='8' class='text-center py-12 text-gray-500'>No hay productos en inventario. <a href="{{ route('inventories.create') }}" class="text-[#2563eb] hover:underline font-semibold">Agrega uno nuevo</a></td></tr>
@endforelse
HTML;
$replaceEmpty = <<<'HTML'
@empty
<tr><td colspan='8' class='text-center py-12 text-gray-500'>No hay productos en inventario. <a href="{{ route('inventories.create') }}" class="text-[#2563eb] hover:underline font-semibold">Agrega uno nuevo</a></td></tr>
@endforelse
                    
                    <!-- Empty states de Alpine -->
                    <tr x-show="filter === 'agotados' && totalAgotados === 0" style="display: none;">
                        <td colspan="100%" class="px-6 py-12 text-center text-gray-500">
                            <p class="text-lg font-medium">No hay productos agotados</p>
                        </td>
                    </tr>
                    <tr x-show="filter === 'disponibles' && totalDisponibles === 0" style="display: none;">
                        <td colspan="100%" class="px-6 py-12 text-center text-gray-500">
                            <p class="text-lg font-medium">No hay productos disponibles</p>
                        </td>
                    </tr>
HTML;
$content = str_replace($searchEmpty, $replaceEmpty, $content);

// Close the div wrapping the section (before @endsection)
$searchEnd = <<<'HTML'
        </div>
    </div>
</div>
@endsection
HTML;
$replaceEnd = <<<'HTML'
        </div>
    </div>
</div> <!-- End x-data div -->
</div>
@endsection
HTML;
$content = str_replace($searchEnd, $replaceEnd, $content);

file_put_contents('resources/views/inventories/index.blade.php', $content);
echo "Alpine functionality added to inventories.index.\n";
?>
