@extends('layouts.admin')

@section('content')
<!-- Contenedor Principal de la Derecha -->
<div class="p-8 w-full bg-[#f0f4f8] min-h-screen">

    <!-- Encabezado de la página -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <!-- Ícono de la tiendita / anuncio -->
            <svg class="w-7 h-7 text-[#0f172a]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <h1 class="text-[24px] font-bold text-[#0f172a] tracking-tight">Promocionar mi negocio</h1>
        </div>
        <p class="text-[14px] text-gray-500 font-light ml-10">Aumenta la visibilidad de tu negocio en SINGKI</p>
    </div>

    <!-- Tarjeta Blanca de Éxito (Centrada) -->
    <div class="bg-white rounded-[16px] shadow-sm border border-gray-100 max-w-3xl mt-10">
        <div class="px-8 py-16 text-center flex flex-col items-center justify-center">

            <!-- Ícono de Check Verde (Ajustado al Figma) -->
            <div class="w-20 h-20 bg-[#6ee7b7] rounded-full flex items-center justify-center mb-8 shadow-sm">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Textos dinámicos -->
            <h2 class="text-[22px] font-bold text-[#0f172a] mb-4">¡Publicidad activada, {{ Auth::user()->name }}!</h2>
            <p class="text-[#475569] text-[15px] font-light mb-6">
                Tu negocio comenzará a aparecer como destacado en SINGKI.
            </p>

            <!-- Detalles de la campaña (Costos y tiempo) -->
            <div class="text-[14.5px] text-[#334155] mb-2">
                Duración: <span class="font-bold text-[#0f172a]">3 días</span> · Costo total: <span class="font-bold text-[#0f172a]">C$ 120</span>
            </div>
            <p class="text-[#64748b] text-[13px] font-light mb-10">
                Alcance estimado: hasta 300 personas
            </p>

            <!-- Botón -->
            <button class="bg-white text-[#0f172a] border border-gray-200 hover:bg-gray-50 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm transition-all">
                Nueva campaña
            </button>
        </div>
    </div>
</div>
@endsection