import re
import os

def hydrate_welcome():
    path = "resources/views/welcome.blade.php"
    if not os.path.exists(path): return
    with open(path, "r", encoding="utf-8") as f:
        content = f.read()
    
    # Remove $negociosFigma definition
    content = re.sub(r'@php.*?\$negociosFigma.*?@endphp', '', content, flags=re.DOTALL)
    
    content = content.replace('@foreach($negociosFigma as $negocio)', '@forelse($negocios ?? [] as $negocio)')
    content = content.replace('@endforeach', '@empty\n<div class="col-span-full text-center text-gray-500 py-8">No hay negocios destacados</div>\n@endforelse')
    
    content = content.replace("$negocio['nombre']", "$negocio->nombre ?? 'Sin nombre'")
    content = content.replace("$negocio['categoria']", "$negocio->categoria ?? 'Sin categoría'")
    content = content.replace("$negocio['desc']", "$negocio->descripcion ?? 'Sin descripción'")
    content = content.replace("$negocio['rating']", "$negocio->rating ?? '0.0'")
    content = content.replace("$negocio['reviews']", "$negocio->reviews ?? '0'")
    content = content.replace("$negocio['img']", "$negocio->img ?? 'https://via.placeholder.com/500'")
    content = content.replace("$negocio['premium']", "$negocio->premium ?? false")

    with open(path, "w", encoding="utf-8") as f:
        f.write(content)

def hydrate_inventario():
    path = "resources/views/admin/inventario.blade.php"
    if not os.path.exists(path): return
    with open(path, "r", encoding="utf-8") as f:
        content = f.read()

    tbody_start = content.find('<tbody>')
    tbody_end = content.find('</tbody>')
    
    if tbody_start != -1 and tbody_end != -1:
        tbody_content = content[tbody_start+7:tbody_end]
        
        first_row_start = tbody_content.find('<tr')
        first_row_end = tbody_content.find('</tr>') + 5
        
        if first_row_start != -1:
            first_row = tbody_content[first_row_start:first_row_end]
            
            first_row = re.sub(r'<span class="text-sm font-semibold text-\[\#040116\]">.*?</span>', r'<span class="text-sm font-semibold text-[#040116]">{{ $producto->nombre ?? \'Sin nombre\' }}</span>', first_row)
            first_row = re.sub(r'<td class="px-6 py-4 text-xs text-gray-500">.*?</td>', r'<td class="px-6 py-4 text-xs text-gray-500">{{ $producto->sku ?? \'N/A\' }}</td>', first_row)
            first_row = re.sub(r'<td class="px-6 py-4 text-sm text-gray-600 text-center">50</td>', r'<td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $producto->stock_inicial ?? 0 }}</td>', first_row, count=1)
            first_row = re.sub(r'<td class="px-6 py-4 text-sm font-bold text-\[\#040116\] text-center">\d+</td>', r'<td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">{{ $producto->stock_actual ?? 0 }}</td>', first_row, count=1)
            first_row = re.sub(r'<td class="px-6 py-4 text-sm text-gray-600 text-center">\d+</td>', r'<td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $producto->reservas ?? 0 }}</td>', first_row, count=1)
            first_row = re.sub(r'<td class="px-6 py-4 text-sm font-bold text-\[\#2563eb\]">.*?</td>', r'<td class="px-6 py-4 text-sm font-bold text-[#2563eb]">{{ $producto->precio ?? 0 }}</td>', first_row)
            
            first_row = re.sub(r'<button class="hover:text-red-500 transition-colors">.*?</button>', r'<form action="{{ route(\'productos.destroy\', $producto->id ?? 0) }}" method="POST" class="inline">@csrf @method("DELETE")<button type="submit" class="hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>', first_row)

            new_tbody = '\n@forelse($inventario ?? [] as $producto)\n' + first_row + '\n@empty\n<tr><td colspan="8" class="text-center py-4">No hay productos</td></tr>\n@endforelse\n'
            
            content = content[:tbody_start+7] + new_tbody + content[tbody_end:]
            with open(path, "w", encoding="utf-8") as f:
                f.write(content)

def hydrate_dashboard():
    path = "resources/views/admin/dashboard.blade.php"
    if not os.path.exists(path): return
    with open(path, "r", encoding="utf-8") as f:
        content = f.read()

    # Find the Productos Recientes div
    start_prod = content.find('<div class="space-y-5">')
    if start_prod != -1:
        # Extract the first item
        item_start = content.find('<div class="flex items-center justify-between">', start_prod)
        item_end = content.find('</div>', content.find('</span>', item_start)) + 6
        if item_start != -1 and item_end != -1:
            first_item = content[item_start:item_end]
            # Replace
            first_item = re.sub(r'<h4 class="text-sm font-semibold text-\[\#040116\]">.*?</h4>', r'<h4 class="text-sm font-semibold text-[#040116]">{{ $producto->nombre ?? \'Sin nombre\' }}</h4>', first_item)
            first_item = re.sub(r'<p class="text-xs text-gray-500">.*?</p>', r'<p class="text-xs text-gray-500">Stock: {{ $producto->stock ?? 0 }} • C$ {{ $producto->precio ?? 0 }}</p>', first_item)
            
            # Now replace the entire space-y-5 block
            end_prod = content.find('</div>', item_end) # Not exact but let's just replace all items with forelse
            # Actually, using regex is safer for the block
            
            # Just do a rough replace for now
            pass

try:
    hydrate_welcome()
    hydrate_inventario()
    # hydrate_dashboard() is too complex for regex, skip or do it manually
    print("Hydrated welcome and inventario")
except Exception as e:
    print(f"Error: {e}")
