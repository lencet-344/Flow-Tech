@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-[#f0f4f8] p-8">
    
    <!-- Encabezado -->
    <div>
        <h1 class="text-[#0f172a] font-bold text-[24px]">Promocionar mi negocio</h1>
        <p class="text-gray-500 mt-1">Aumenta la visibilidad de tu negocio en SINGKI</p>
    </div>

    <!-- Tarjeta central -->
    <div class="bg-white max-w-3xl mx-auto mt-10 rounded-[16px] py-16 px-8 text-center shadow-sm">
        
        <!-- Círculo e Ícono Check -->
        <div class="bg-[#6ee7b7] w-20 h-20 rounded-full mx-auto flex items-center justify-center mb-6">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Título Dinámico -->
        <h2 class="text-2xl font-bold text-gray-800 mb-2">¡Publicidad activada, {{ Auth::user()->name }}!</h2>

        <!-- Párrafo -->
        <p class="text-gray-600 mb-4">Tu negocio comenzará a aparecer como destacado en SINGKI.</p>

        <!-- Detalles -->
        <p class="text-sm text-gray-500 mb-8">Duración: 3 días · Costo total: C$ 120</p>

        <!-- Botón -->
        <button class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-50 transition shadow-sm">
            Nueva campaña
        </button>

    </div>
</div>
@endsection
