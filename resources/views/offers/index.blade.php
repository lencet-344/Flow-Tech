@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10">
    
    <!-- ENCABEZADO -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div class="flex items-start gap-3">
            <!-- Ícono de Ticket -->
            <div class="text-[#2563eb] mt-1">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z"></path></svg>
            </div>
            <div>
                <h1 class="text-[28px] font-bold text-[#040116] tracking-tight leading-none mb-2">Ofertas</h1>
                <p class="text-gray-600 text-sm">Gestiona las ofertas y promociones de tu negocio</p>
            </div>
        </div>
        <a href="{{ route('offers.create') }}" class="bg-[#2563eb] text-white font-medium px-5 py-2.5 rounded-xl text-sm shadow-sm transition-colors flex items-center gap-2">
            + Nueva oferta
        </a>
    </div>

    <!-- TARJETAS DE RESUMEN -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total</span>
            <span class="text-4xl font-bold text-[#040116]">{{ $offers->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Activas</span>
            <span class="text-4xl font-bold text-[#040116]">{{ $offers->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Expiradas</span>
            <span class="text-4xl font-bold text-[#040116]">0</span>
        </div>
    </div>

    <!-- LISTA DE OFERTAS -->
    <div class="flex flex-col gap-4">
        @forelse($offers ?? [] as $offer)
        <!-- Tarjeta de Oferta -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <!-- Información -->
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-lg font-medium text-[#040116]">{{ $offer->title ?? 'Sin título' }}</h3>
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-xs font-medium">Activa</span>
                    <span class="bg-[#eff6ff] text-[#2563eb] px-3 py-1 rounded-full text-xs font-medium">{{ $offer->discount ?? '0' }}%</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">{{ $offer->description ?? 'Sin descripción' }}</p>
            </div>
            <!-- Acciones -->
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('offers.edit', $offer->id ?? 0) }}" class="bg-white border border-gray-200 text-gray-700 font-medium px-5 py-2 rounded-xl text-sm hover:bg-gray-50 transition shadow-sm">
                    Editar
                </a>
                <form action="{{ route('offers.destroy', $offer->id ?? 0) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 text-red-500 font-medium px-5 py-2 rounded-xl text-sm hover:bg-red-100 transition shadow-sm">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-500 bg-white rounded-2xl border border-gray-100 shadow-sm">No hay ofertas creadas</div>
        @endforelse
    </div>
</div>
@endsection
