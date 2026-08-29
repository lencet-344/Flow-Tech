@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10">
    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Reservas</h1>
        <p class="text-gray-500 text-sm mt-1">Clientes que reservaron productos agotados</p>
    </div>

    <!-- 3 Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total reservas</span>
            <span class="text-3xl font-bold text-[#040116]">2</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Pendientes</span>
            <span class="text-3xl font-bold text-[#040116]">1</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Notificados</span>
            <span class="text-3xl font-bold text-[#040116]">1</span>
        </div>
    </div>

    <!-- Tabla Principal -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Notificación</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($reservas ?? [] as $reserva)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0">
                                    <img src="{{ $reserva->producto->img ?? 'https://via.placeholder.com/100' }}" class="w-full h-full object-cover rounded-lg">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-[#040116]">{{ $reserva->producto->nombre ?? 'Producto no encontrado' }}</h4>
                                    <p class="text-[13px] text-gray-500">{{ $reserva->producto->proveedor->nombre ?? 'Proveedor' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $reserva->fecha ?? date('Y-m-d') }}</td>
                        <td class="px-6 py-4">
                            @if(isset($reserva->notificacion) && $reserva->notificacion)
                            <span class="inline-flex items-center gap-1 bg-green-50 border border-green-200 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg> Activada
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-gray-50 border border-gray-200 text-gray-500 px-3 py-1 rounded-full text-xs font-semibold">Desactivada</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if(isset($reserva->estado) && $reserva->estado == 'Pendiente')
                            <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded text-xs font-semibold">Pendiente</span>
                            @else
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded text-xs font-semibold">{{ $reserva->estado ?? 'Desconocido' }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('reservas.update', $reserva->id ?? 0) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="estado" value="Disponible">
                                    <button type="submit" class="bg-[#2563eb] hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors">Marcar disponible</button>
                                </form>
                                <a href="{{ route('productos.show', $reserva->producto_id ?? 0) }}" class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 text-xs font-medium px-4 py-2 rounded-lg transition-colors">Ver producto</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No hay reservas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
