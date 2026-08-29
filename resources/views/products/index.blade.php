@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Botón de Escape -->
    <div class="mb-6">
        <a href="{{ url('/') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold text-sm gap-2 transition-colors bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            &larr; Regresar al inicio
        </a>
    </div>

    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">
            {{ isset($search) && $search ? 'Búsqueda de Productos' : 'Todos los productos' }}
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            {{ isset($search) && $search ? 'Resultados para: "' . $search . '"' : 'Explora productos de proveedores verificados' }}
        </p>
    </div>

    <!-- Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total Productos</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $products->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Disponibles</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $products->where('state', 'Activo')->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Agotados</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $products->where('state', '!=', 'Activo')->count() }}</span>
        </div>
    </div>

    <!-- Tabla Principal -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto / Negocio</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products ?? [] as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden">
                                    <img src="https://via.placeholder.com/50" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-[#040116]">{{ $product->name ?? 'Sin nombre' }}</h4>
                                    <p class="text-[13px] text-gray-500">{{ $product->supplier->name ?? 'Proveedor' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">
                            ${{ number_format($product->cost ?? 0, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            @if(isset($product->state) && $product->state == 'Activo')
                            <span class="inline-flex items-center gap-1 bg-green-50 border border-green-200 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Activo</span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-gray-50 border border-gray-200 text-gray-500 px-3 py-1 rounded-full text-xs font-semibold">{{ $product->state ?? 'Inactivo' }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('products.show', $product->id ?? 0) }}" class="bg-[#2563eb] hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors">Ver detalles</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <p class="text-lg font-medium">No se encontraron productos</p>
                                <p class="text-sm mt-1">Intenta con otros términos de búsqueda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection