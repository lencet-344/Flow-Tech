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
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Mis Favoritos</h1>
        <p class="text-gray-500 text-sm mt-1">Los negocios y productos que has guardado</p>
    </div>

    <!-- Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total Favoritos</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $favorites->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Recientes</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $favorites->where('created_at', '>=', now()->subDays(7))->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Notificaciones</span>
            <span class="text-3xl font-bold text-[#040116]">0</span>
        </div>
    </div>

    <!-- Tabla Principal -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto / Negocio</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha de guardado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($favorites ?? [] as $favorite)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden">
                                    <img src="https://via.placeholder.com/50" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-[#040116]">{{ $favorite->product->name ?? 'Sin nombre' }}</h4>
                                    <p class="text-[13px] text-gray-500">{{ $favorite->product->supplier->name ?? 'Proveedor' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $favorite->created_at ? $favorite->created_at->format('Y-m-d') : date('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('favorites.destroy', $favorite->id ?? 0) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-lg text-xs font-semibold transition-colors">Eliminar</button>
                                </form>
                                <a href="{{ route('products.show', $favorite->product_id ?? 0) }}" class="bg-[#2563eb] hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors">Ver detalles</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">No tienes favoritos guardados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection