<?php
$content = file_get_contents('resources/views/inventories/index.blade.php');

$loopStart = <<<'HTML'
@forelse($inventories ?? [] as $item)
<tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-[#eff6ff] text-[#2563eb] rounded-lg shrink-0 flex items-center justify-center font-bold text-lg border border-blue-100">
                                    {{ strtoupper(substr($item->product->name ?? 'P', 0, 1)) }}
                                </div>
                                <span class="text-sm font-semibold text-[#040116]">{{ $item->product->name ?? 'Sin nombre' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">{{ $item->batch_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $item->quantity ?? 0 }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">{{ $item->quantity ?? 0 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">-</td>
                        <td class="px-6 py-4"><span class="inline-flex bg-green-50 text-green-600 border border-green-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $item->status ?? 'Activo' }}</span></td>
                        <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">${{ number_format($item->unit_cost ?? 0, 2) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 text-gray-400">
                                <a href="{{ route('inventories.show', $item->id) }}" class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></a>
                                <a href="{{ route('inventories.edit', $item->id) }}" class="hover:text-gray-700 transition-colors bg-gray-50 border border-gray-200 p-1.5 rounded-lg flex items-center gap-1 text-xs font-semibold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg> Editar</a>
                                <form action="{{ route('inventories.destroy', $item->id) }}" method="POST" class="inline">@csrf @method("DELETE")<button type="submit" class="hover:text-red-500 transition-colors" title="Eliminar"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>
                            </div>
                        </td>
                    </tr>
@empty
<tr><td colspan='8' class='text-center py-12 text-gray-500'>No hay productos en inventario. <a href="{{ route('inventories.create') }}" class="text-[#2563eb] hover:underline font-semibold">Agrega uno nuevo</a></td></tr>
@endforelse
HTML;

$start = strpos($content, '@forelse');
$end = strpos($content, '@endforelse') + strlen('@endforelse');

$newContent = substr($content, 0, $start) . $loopStart . substr($content, $end);
file_put_contents('resources/views/inventories/index.blade.php', $newContent);
echo "Fixed inventories.index loop.\n";
?>
