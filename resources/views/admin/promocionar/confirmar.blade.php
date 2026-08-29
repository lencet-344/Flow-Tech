@extends('layouts.admin')

@section('content')
<div class="p-10 max-w-5xl">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#040116] flex items-center gap-2">
            <svg class="w-6 h-6 text-[#040116]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            Promocionar mi negocio
        </h1>
        <p class="text-sm text-gray-600 mt-1 ml-8">Aumenta la visibilidad de tu negocio en SINGKI</p>
    </div>

    <!-- Tarjeta Principal -->
    <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-gray-100 max-w-3xl mt-8">
        
        <h2 class="text-xl font-bold text-[#040116] mb-6">Confirmar publicidad</h2>

        <!-- Filas de Datos -->
        <div class="flex justify-between items-center py-4 border-b border-gray-100">
            <span class="text-gray-600">Objetivo</span>
            <span class="font-semibold text-[#040116]">Atraer más clientes</span>
        </div>
        
        <div class="flex justify-between items-center py-4 border-b border-gray-100">
            <span class="text-gray-600">Duración</span>
            <span class="font-semibold text-[#040116]">3 días</span>
        </div>
        
        <div class="flex justify-between items-center py-4 border-b border-gray-100">
            <span class="text-gray-600">Costo por día</span>
            <span class="font-semibold text-[#040116]">C$ 40</span>
        </div>
        
        <div class="flex justify-between items-center py-4 border-b border-gray-100">
            <span class="text-gray-600">Costo total</span>
            <span class="font-semibold text-[#040116]">C$ 120</span>
        </div>
        
        <div class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0">
            <span class="text-gray-600">Alcance estimado</span>
            <span class="font-semibold text-[#040116]">Hasta 300 personas</span>
        </div>

        <!-- Caja de Advertencia -->
        <div class="bg-[#F4F7FF] rounded-xl p-5 mt-6">
            <p class="text-sm text-gray-600 leading-relaxed">
                El alcance indicado es estimado y no representa una garantía de visitas o ventas. Los resultados pueden variar según la demanda de la plataforma.
            </p>
        </div>

        <!-- Botones de Acción -->
        <div class="grid grid-cols-2 gap-4 mt-8">
            <a href="{{ url('/admin/promocionar') }}" class="w-full bg-white border border-gray-200 text-[#040116] font-semibold py-3.5 rounded-xl hover:bg-gray-50 transition-colors text-center block block text-center flex items-center justify-center">Editar</a>
            <a href="{{ url('/admin/dashboard') }}" class="w-full bg-[#1F51FF] text-white font-semibold py-3.5 rounded-xl hover:bg-blue-700 transition-colors text-center block flex items-center justify-center">Confirmar y activar</a>
        </div>

    </div>

</div>
@endsection
