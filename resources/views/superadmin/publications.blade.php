@extends('layouts.superadmin')

@section('content')
@php
    $publications = \App\Models\Inventory::with(['product', 'company'])->orderBy('created_at', 'desc')->get();
    $totalContent = $publications->count();
    $reportedCount = 0;
    $approvedCount = $totalContent;
@endphp

<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <!-- Icono de Cámara -->
            <svg class="w-8 h-8 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" class="hidden"></path><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Publicaciones y fotografías</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-11">Resumen del contenido publicado por los negocios</p>
    </div>

    <!-- 3 Tarjetas de Métricas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Tarjeta 1: Total -->
        <div class="bg-blue-50 border-2 border-blue-500 rounded-xl p-6 shadow-sm">
            <div class="text-[32px] font-bold text-blue-600 leading-none mb-1">{{ $totalContent }}</div>
            <div class="text-[13px] text-blue-500 font-medium">Total de contenido</div>
        </div>
        <!-- Tarjeta 2: Reportados -->
        <div class="bg-red-50 border border-red-200 rounded-xl p-6 shadow-sm">
            <div class="text-[32px] font-bold text-red-600 leading-none mb-1">{{ $reportedCount }}</div>
            <div class="text-[13px] text-red-500 font-medium">Reportados</div>
        </div>
        <!-- Tarjeta 3: Aprobados -->
        <div class="bg-green-50 border border-green-200 rounded-xl p-6 shadow-sm">
            <div class="text-[32px] font-bold text-green-700 leading-none mb-1">{{ $approvedCount }}</div>
            <div class="text-[13px] text-green-600 font-medium">Aprobados</div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-[1.2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto w-full bg-white rounded-lg shadow">
<table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11.5px] font-bold text-gray-900 uppercase tracking-wider">
                        <th class="px-6 py-5">Contenido</th>
                        <th class="px-6 py-5">Negocio</th>
                        <th class="px-6 py-5">Tipo</th>
                        <th class="px-6 py-5">Subido</th>
                        <th class="px-6 py-5">Estado</th>
                        <th class="px-6 py-5 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-[13.5px] text-gray-800 divide-y divide-gray-50">
                    @forelse($publications as $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->product->name ?? 'Producto') }}&background=random" alt="Foto principal" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                <span class="font-medium text-gray-900">{{ $item->product->name ?? 'Sin nombre' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-blue-600 hover:underline cursor-pointer">
                            @if($item->company)
                                <a href="{{ url('/companies/' . $item->company->id) }}" target="_blank">{{ $item->company->name }}</a>
                            @else
                                Desconocido
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-semibold">Producto</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-500 px-4 py-1.5 rounded-full text-xs font-semibold">OK</span>
                        </td>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12">
                            <div class="p-8 text-center text-gray-500">No hay publicaciones recientes.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
</div>
        </div>
    </div>
</div>
@endsection
