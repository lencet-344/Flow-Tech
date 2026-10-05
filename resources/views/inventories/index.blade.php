@extends('layouts.admin')

@section('content')
<div x-data="{ showDeleteModal: false, deleteFormId: null }" class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Inventario</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $inventories->count() }} productos en catálogo</p>
        </div>
        <a href="{{ route('inventories.create') }}" class="bg-[#2563eb] hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm shadow-sm transition-colors flex items-center gap-2">+ Agregar producto</a>
    </div>

    <!-- 3 Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total</span>
            <span class="text-4xl font-bold text-[#040116]">{{ $inventories->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Disponibles</span>
            <span class="text-4xl font-bold text-[#040116]">{{ $inventories->where('quantity', '>', 0)->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Agotados</span>
            <span class="text-4xl font-bold text-[#040116]">{{ $inventories->where('quantity', '<=', 0)->count() }}</span>
        </div>
    </div>

    <div x-data="{ 
        filter: 'todos', 
        totalAgotados: {{ $inventories->where('quantity', '<=', 0)->count() }}, 
        totalDisponibles: {{ $inventories->where('quantity', '>', 0)->count() }} 
    }">
        <!-- Buscador y Filtros -->
        <div class="flex flex-col md:flex-row items-center gap-4 mb-6">
            <div class="w-full md:w-80">
                <input type="text" placeholder="Buscar por nombre o SKU..." class="w-full pl-4 pr-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-[#2563eb] focus:border-[#2563eb] text-sm outline-none text-gray-700">
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                <button @click="filter = 'todos'" :class="filter === 'todos' ? 'bg-[#2563eb] text-white shadow-sm border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="border px-5 py-2.5 rounded-xl text-sm font-medium transition whitespace-nowrap">Todos</button>
                <button @click="filter = 'disponibles'" :class="filter === 'disponibles' ? 'bg-[#2563eb] text-white shadow-sm border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="border px-5 py-2.5 rounded-xl text-sm font-medium transition whitespace-nowrap">Disponibles</button>
                <button @click="filter = 'agotados'" :class="filter === 'agotados' ? 'bg-[#2563eb] text-white shadow-sm border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="border px-5 py-2.5 rounded-xl text-sm font-medium transition whitespace-nowrap">Agotados</button>
            </div>
        </div>

        <!-- Tabla de Inventario -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Lote</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Stock Actual</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($inventories ?? [] as $item)
                        <tr x-show="filter === 'todos' || (filter === 'disponibles' && {{ $item->quantity ?? 0 }} > 0) || (filter === 'agotados' && {{ $item->quantity ?? 0 }} <= 0)" 
                            x-transition
                            class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-[#eff6ff] text-[#2563eb] rounded-lg shrink-0 flex items-center justify-center font-bold text-lg border border-blue-100">
                                        {{ strtoupper(substr($item->product->name ?? 'P', 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-semibold text-[#040116]">{{ $item->product->name ?? 'Sin nombre' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">{{ $item->batch_number ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">{{ $item->quantity ?? 0 }}</td>
                            <td class="px-6 py-4">
                                @if(($item->quantity ?? 0) > 0)
                                    <span class="inline-flex bg-green-50 text-green-600 border border-green-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span>
                                @else
                                    <span class="inline-flex bg-red-50 text-red-600 border border-red-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Agotado</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">${{ number_format($item->unit_cost ?? 0, 2) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3 text-gray-400">
                                    <a href="{{ route('inventories.show', $item->id) }}" class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></a>
                                    <a href="{{ route('inventories.edit', $item->id) }}" class="hover:text-gray-700 transition-colors bg-gray-50 border border-gray-200 p-1.5 rounded-lg flex items-center gap-1 text-xs font-semibold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg> Editar</a>
                                    <form id="delete-inventory-{{ $item->id }}" action="{{ route('inventories.destroy', $item->id) }}" method="POST" class="inline">@csrf @method("DELETE")<button type="button" @click="deleteFormId = 'delete-inventory-{{ $item->id }}'; showDeleteModal = true;" class="hover:text-red-500 transition-colors" title="Eliminar"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>
                                </div>
                            </td>
                        </tr>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- MODAL DE CONFIRMACIÓN DE ELIMINACIÓN ESTILO SINGKI -->
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-8 max-w-md w-full mx-4 text-center" @click.away="showDeleteModal = false">
            <div class="w-16 h-16 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-[#0f172a] mb-2">¿Eliminar del inventario?</h3>
            <p class="text-sm text-gray-500 mb-7">Esta acción eliminará permanentemente el producto del catálogo. ¿Deseas continuar?</p>
            <div class="flex gap-3">
                <button type="button" @click="showDeleteModal = false" class="flex-1 py-3 px-4 rounded-xl border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition">No, conservar</button>
                <button type="button" @click="if(deleteFormId) document.getElementById(deleteFormId).submit()" class="flex-1 py-3 px-4 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold text-sm shadow-sm transition">Sí, eliminar</button>
            </div>
        </div>
    </div>
@endsection