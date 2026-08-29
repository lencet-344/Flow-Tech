<?php

function hydrateFile($path, $type) {
    if (!file_exists($path)) return;
    $content = file_get_contents($path);

    if ($type == 'inventario') {
        $start = strpos($content, '<tbody');
        $end = strpos($content, '</tbody>');
        if ($start !== false && $end !== false) {
            $tbodyStartEnd = strpos($content, '>', $start);
            $tbodyInnerStart = $tbodyStartEnd + 1;
            $tbodyInnerLength = $end - $tbodyInnerStart;
            
            $tbody = substr($content, $tbodyInnerStart, $tbodyInnerLength);
            
            $trStart = strpos($tbody, '<tr');
            $trEnd = strpos($tbody, '</tr>') + 5;
            
            if ($trStart !== false) {
                $row = substr($tbody, $trStart, $trEnd - $trStart);
                
                // Replace values
                $row = preg_replace('/<span class="text-sm font-semibold text-\\[#040116\\]">.*?<\\/span>/s', '<span class="text-sm font-semibold text-[#040116]">{{ $producto->nombre ?? \'Sin nombre\' }}</span>', $row);
                $row = preg_replace('/<td class="px-6 py-4 text-xs text-gray-500">.*?<\\/td>/s', '<td class="px-6 py-4 text-xs text-gray-500">{{ $producto->sku ?? \'N/A\' }}</td>', $row);
                
                // For numeric columns
                $row = preg_replace('/<td class="px-6 py-4 text-sm text-gray-600 text-center">\s*\d+\s*<\/td>/', '<td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $producto->stock_inicial ?? 0 }}</td>', $row, 1);
                $row = preg_replace('/<td class="px-6 py-4 text-sm font-bold text-\\[#040116\\] text-center">\s*\d+\s*<\/td>/', '<td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">{{ $producto->stock_actual ?? 0 }}</td>', $row, 1);
                $row = preg_replace('/<td class="px-6 py-4 text-sm text-gray-600 text-center">\s*\d+\s*<\/td>/', '<td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $producto->reservas ?? 0 }}</td>', $row, 1);
                
                // Price
                $row = preg_replace('/<td class="px-6 py-4 text-sm font-bold text-\\[#2563eb\\]">.*?<\\/td>/s', '<td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ {{ $producto->precio ?? 0 }}</td>', $row);
                
                // Action buttons
                $form = '<form action="{{ route(\'productos.destroy\', $producto->id ?? 0) }}" method="POST" class="inline">@csrf @method("DELETE")<button type="submit" class="hover:text-red-500 transition-colors" title="Eliminar"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>';
                $row = preg_replace('/<button class="hover:text-red-500 transition-colors">.*?<\\/button>/s', $form, $row);
                
                $newTbody = "\n@forelse(\$inventario ?? [] as \$producto)\n" . $row . "\n@empty\n<tr><td colspan='8' class='text-center py-4'>No hay productos</td></tr>\n@endforelse\n";
                
                $content = substr_replace($content, $newTbody, $tbodyInnerStart, $tbodyInnerLength);
                file_put_contents($path, $content);
                echo "Hydrated $path\n";
            }
        }
    }
}

hydrateFile('resources/views/admin/inventario.blade.php', 'inventario');
?>
