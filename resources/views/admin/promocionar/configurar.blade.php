@extends('layouts.admin')

@section('content')
<div class="p-10 max-w-5xl">
    
    <!-- Encabezado -->
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-[#040116] flex items-center gap-2">
            <svg class="w-6 h-6 text-[#040116]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            Promocionar mi negocio
        </h1>
        <p class="text-sm text-gray-600 mt-1 ml-8">Aumenta la visibilidad de tu negocio en SINGKI</p>
    </div>

    <!-- Banner de aviso -->
    <div class="bg-green-50 border border-green-300 rounded-xl p-4 mb-6">
        <p class="text-green-700 font-bold">Disponible para todos los negocios</p>
        <p class="text-green-700 text-sm mt-1">La publicidad en SINGKI no requiere Premium, puedes promocionarte en cualquier momento.</p>
    </div>

    <!-- Tarjeta Principal -->
    <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-gray-100 max-w-3xl mt-2">
        
        <h2 class="text-xl font-bold text-[#040116] mb-6">Configura tu campaña</h2>

        <!-- Sección "Objetivo de la campaña" -->
        <h3 class="text-sm font-semibold mb-3">Objetivo de la campaña</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF] p-4 rounded-xl font-medium cursor-pointer">
                Atraer más clientes
            </div>
            <div class="border border-gray-200 text-gray-700 p-4 rounded-xl font-medium hover:bg-gray-50 cursor-pointer">
                Dar a conocer mi negocio
            </div>
            <div class="border border-gray-200 text-gray-700 p-4 rounded-xl font-medium hover:bg-gray-50 cursor-pointer">
                Aumentar reservas
            </div>
            <div class="border border-gray-200 text-gray-700 p-4 rounded-xl font-medium hover:bg-gray-50 cursor-pointer">
                Promocionar un producto
            </div>
        </div>

        <!-- Sección "Duración" -->
        <h3 class="text-sm font-semibold mb-3 mt-8">Duración</h3>
        <div class="flex flex-wrap gap-3 mb-6 items-center">
            <div class="border border-gray-200 text-gray-700 px-6 py-2 rounded-xl font-medium cursor-pointer">1 día</div>
            <div class="border-2 border-[#1F51FF] text-[#1F51FF] px-6 py-2 rounded-xl font-medium cursor-pointer">3 días</div>
            <div class="border border-gray-200 text-gray-700 px-6 py-2 rounded-xl font-medium cursor-pointer">7 días</div>
            <div class="border border-gray-200 text-gray-700 px-6 py-2 rounded-xl font-medium cursor-pointer">14 días</div>
            <div class="border border-gray-200 text-gray-700 px-6 py-2 rounded-xl font-medium cursor-pointer">30 días</div>
        </div>

        <!-- Input manual -->
        <div class="flex items-center text-sm text-gray-600 mb-6 mt-4">
            <span>O ingresa una duración personalizada:</span>
            <input type="text" class="w-20 border border-gray-200 rounded-lg text-center mx-2 py-1.5 focus:border-[#1F51FF] focus:outline-none" placeholder="ej. 5">
            <span>días</span>
        </div>

        <!-- Caja de Resumen Interior -->
        <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 mt-8 flex justify-between items-center text-center">
            <div class="flex flex-col">
                <span class="text-sm text-gray-500 mb-1">Duración</span>
                <span class="font-bold text-lg text-[#040116]">3 días</span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm text-gray-500 mb-1">Costo total</span>
                <span class="text-[#1F51FF] font-bold text-xl">C$ 120</span>
                <span class="text-xs text-gray-500 mt-1">C$ 40/día</span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm text-gray-500 mb-1">Alcance estimado</span>
                <span class="font-bold text-xl text-[#040116]">~300</span>
                <span class="text-xs text-gray-500 mt-1">personas</span>
            </div>
        </div>

        <p class="text-xs text-gray-400 mt-4">* El alcance indicado es un estimado y no garantiza interacciones directas. Puede variar según los intereses del público.</p>

        <!-- Botón principal -->
        <a href="{{ url('/admin/promocionar/confirmar') }}" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-4 rounded-xl mt-6 block text-center transition-colors">
            Continuar &rarr; Ver resumen
        </a>

    </div>

</div>
@endsection
