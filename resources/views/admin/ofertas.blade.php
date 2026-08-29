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
        <button class="bg-[#2563eb] text-white font-medium px-5 py-2.5 rounded-xl text-sm shadow-sm transition-colors flex items-center gap-2">
            + Nueva oferta
        </button>
    </div>

    <!-- LISTA DE OFERTAS -->
    <div class="flex flex-col gap-4">
        
        <!-- Tarjeta 1: Oferta Activa -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <!-- Información -->
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-lg font-medium text-[#040116]">Descuento en laptops HP</h3>
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-xs font-medium">Activa</span>
                    <span class="bg-[#eff6ff] text-[#2563eb] px-3 py-1 rounded-full text-xs font-medium">20%</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">20% de descuento en todos los modelos HP EliteBook</p>
                <p class="text-gray-400 text-xs">Válida hasta: 2026-09-30</p>
            </div>
            <!-- Acciones -->
            <div class="flex items-center gap-3 shrink-0">
                <button class="bg-white border border-gray-200 text-gray-700 font-medium px-5 py-2 rounded-xl text-sm hover:bg-gray-50 transition">
                    Desactivar
                </button>
                <button class="bg-red-50 text-red-500 font-medium px-5 py-2 rounded-xl text-sm hover:bg-red-100 transition">
                    Eliminar
                </button>
            </div>
        </div>

        <!-- Tarjeta 2: Oferta Inactiva -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6 opacity-75">
            <!-- Información -->
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-lg font-medium text-gray-500">Combo monitores + teclado</h3>
                    <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-medium">Inactiva</span>
                    <span class="bg-[#eff6ff] text-[#2563eb] px-3 py-1 rounded-full text-xs font-medium">Precio especial</span>
                </div>
                <p class="text-gray-400 text-sm mb-1">Monitor Dell 27'' + Teclado Keychron al precio especial de temporada</p>
                <p class="text-gray-300 text-xs">Válida hasta: 2026-08-31</p>
            </div>
            <!-- Acciones -->
            <div class="flex items-center gap-3 shrink-0">
                <button class="bg-white border border-gray-200 text-gray-700 font-medium px-5 py-2 rounded-xl text-sm hover:bg-gray-50 transition">
                    Activar
                </button>
                <button class="bg-red-50 text-red-500 font-medium px-5 py-2 rounded-xl text-sm hover:bg-red-100 transition">
                    Eliminar
                </button>
            </div>
        </div>

    </div>
</div>
@endsection
