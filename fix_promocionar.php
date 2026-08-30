<?php
$content = <<<'HTML'
@extends('layouts.admin')

@section('content')
<div class="p-10 max-w-5xl" x-data="{ 
    paso: 1, 
    objetivo: 'Atraer más clientes', 
    duracion: 3, 
    costoDia: 40, 
    alcanceDia: 100, 
    customDuracion: '' 
}" x-init="$watch('customDuracion', value => { if(value) duracion = parseInt(value) || duracion })">
    
    <!-- Encabezado Global -->
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-[#040116] flex items-center gap-2">
            <svg class="w-6 h-6 text-[#040116]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            Promocionar mi negocio
        </h1>
        <p class="text-sm text-gray-600 mt-1 ml-8">Aumenta la visibilidad de tu negocio en SINGKI</p>
    </div>

    <!-- PASO 1: CONFIGURAR -->
    <div x-show="paso === 1" x-transition.opacity>
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
                <div @click="objetivo = 'Atraer más clientes'" 
                     :class="objetivo === 'Atraer más clientes' ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="p-4 rounded-xl font-medium cursor-pointer transition-colors">
                    Atraer más clientes
                </div>
                <div @click="objetivo = 'Dar a conocer mi negocio'" 
                     :class="objetivo === 'Dar a conocer mi negocio' ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="p-4 rounded-xl font-medium cursor-pointer transition-colors">
                    Dar a conocer mi negocio
                </div>
                <div @click="objetivo = 'Aumentar reservas'" 
                     :class="objetivo === 'Aumentar reservas' ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="p-4 rounded-xl font-medium cursor-pointer transition-colors">
                    Aumentar reservas
                </div>
                <div @click="objetivo = 'Promocionar un producto'" 
                     :class="objetivo === 'Promocionar un producto' ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="p-4 rounded-xl font-medium cursor-pointer transition-colors">
                    Promocionar un producto
                </div>
            </div>

            <!-- Sección "Duración" -->
            <h3 class="text-sm font-semibold mb-3 mt-8">Duración</h3>
            <div class="flex flex-wrap gap-3 mb-6 items-center">
                <div @click="duracion = 1; customDuracion = ''" 
                     :class="duracion === 1 ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="px-6 py-2 rounded-xl font-medium cursor-pointer transition-colors">1 día</div>
                <div @click="duracion = 3; customDuracion = ''" 
                     :class="duracion === 3 ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="px-6 py-2 rounded-xl font-medium cursor-pointer transition-colors">3 días</div>
                <div @click="duracion = 7; customDuracion = ''" 
                     :class="duracion === 7 ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="px-6 py-2 rounded-xl font-medium cursor-pointer transition-colors">7 días</div>
                <div @click="duracion = 14; customDuracion = ''" 
                     :class="duracion === 14 ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="px-6 py-2 rounded-xl font-medium cursor-pointer transition-colors">14 días</div>
                <div @click="duracion = 30; customDuracion = ''" 
                     :class="duracion === 30 ? 'border-2 border-[#1F51FF] bg-blue-50 text-[#1F51FF]' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" 
                     class="px-6 py-2 rounded-xl font-medium cursor-pointer transition-colors">30 días</div>
            </div>

            <!-- Input manual -->
            <div class="flex items-center text-sm text-gray-600 mb-6 mt-4">
                <span>O ingresa una duración personalizada:</span>
                <input type="number" x-model="customDuracion" class="w-20 border border-gray-200 rounded-lg text-center mx-2 py-1.5 focus:border-[#1F51FF] focus:outline-none" placeholder="ej. 5">
                <span>días</span>
            </div>

            <!-- Caja de Resumen Interior -->
            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 mt-8 flex justify-between items-center text-center">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500 mb-1">Duración</span>
                    <span class="font-bold text-lg text-[#040116]" x-text="duracion + (duracion === 1 ? ' día' : ' días')">3 días</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500 mb-1">Costo total</span>
                    <span class="text-[#1F51FF] font-bold text-xl" x-text="'C$ ' + (duracion * costoDia)">C$ 120</span>
                    <span class="text-xs text-gray-500 mt-1" x-text="'C$ ' + costoDia + '/día'">C$ 40/día</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500 mb-1">Alcance estimado</span>
                    <span class="font-bold text-xl text-[#040116]" x-text="'~' + (duracion * alcanceDia)">~300</span>
                    <span class="text-xs text-gray-500 mt-1">personas</span>
                </div>
            </div>

            <p class="text-xs text-gray-400 mt-4">* El alcance indicado es un estimado y no garantiza interacciones directas. Puede variar según los intereses del público.</p>

            <!-- Botón principal -->
            <button @click="paso = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-4 rounded-xl mt-6 block text-center transition-colors">
                Continuar &rarr; Ver resumen
            </button>
        </div>
    </div>

    <!-- PASO 2: RESUMEN / CONFIRMAR -->
    <div x-show="paso === 2" x-transition.opacity style="display: none;">
        <!-- Tarjeta Principal -->
        <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-gray-100 max-w-3xl mt-2">
            
            <h2 class="text-xl font-bold text-[#040116] mb-6">Confirmar publicidad</h2>

            <!-- Filas de Datos -->
            <div class="flex justify-between items-center py-4 border-b border-gray-100">
                <span class="text-gray-600">Objetivo</span>
                <span class="font-semibold text-[#040116]" x-text="objetivo">Atraer más clientes</span>
            </div>
            
            <div class="flex justify-between items-center py-4 border-b border-gray-100">
                <span class="text-gray-600">Duración</span>
                <span class="font-semibold text-[#040116]" x-text="duracion + (duracion === 1 ? ' día' : ' días')">3 días</span>
            </div>
            
            <div class="flex justify-between items-center py-4 border-b border-gray-100">
                <span class="text-gray-600">Costo por día</span>
                <span class="font-semibold text-[#040116]" x-text="'C$ ' + costoDia">C$ 40</span>
            </div>
            
            <div class="flex justify-between items-center py-4 border-b border-gray-100">
                <span class="text-gray-600">Costo total</span>
                <span class="font-semibold text-lg text-[#1F51FF]" x-text="'C$ ' + (duracion * costoDia)">C$ 120</span>
            </div>
            
            <div class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0">
                <span class="text-gray-600">Alcance estimado</span>
                <span class="font-semibold text-[#040116]" x-text="'Hasta ' + (duracion * alcanceDia) + ' personas'">Hasta 300 personas</span>
            </div>

            <!-- Caja de Advertencia -->
            <div class="bg-[#F4F7FF] rounded-xl p-5 mt-6">
                <p class="text-sm text-gray-600 leading-relaxed">
                    El alcance indicado es estimado y no representa una garantía de visitas o ventas. Los resultados pueden variar según la demanda de la plataforma.
                </p>
            </div>

            <!-- Botones de Acción -->
            <div class="grid grid-cols-2 gap-4 mt-8">
                <button @click="paso = 1" class="w-full bg-white border border-gray-200 text-[#040116] font-semibold py-3.5 rounded-xl hover:bg-gray-50 transition-colors text-center block flex items-center justify-center">
                    Editar
                </button>
                <button @click="paso = 3" class="w-full bg-[#1F51FF] text-white font-semibold py-3.5 rounded-xl hover:bg-blue-700 transition-colors text-center block flex items-center justify-center">
                    Confirmar y activar
                </button>
            </div>
        </div>
    </div>

    <!-- PASO 3: ÉXITO -->
    <div x-show="paso === 3" x-transition.opacity style="display: none;">
        <!-- Tarjeta de Éxito -->
        <div class="bg-white rounded-[2rem] p-12 shadow-sm border border-gray-100 max-w-3xl mt-2 text-center flex flex-col items-center justify-center min-h-[400px]">
            
            <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-[#040116] mb-4">¡Promoción activada con éxito!</h2>
            
            <p class="text-gray-500 text-base max-w-md mx-auto mb-10 leading-relaxed">
                Tu negocio ahora tiene mayor visibilidad en SINGKI. Tu campaña orientada a <span class="font-bold text-gray-700" x-text="objetivo"></span> estará activa durante los próximos <span class="font-bold text-gray-700" x-text="duracion + (duracion === 1 ? ' día' : ' días')"></span>.
            </p>

            <a href="{{ url('/admin/dashboard') }}" class="inline-flex items-center bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold px-8 py-3.5 rounded-xl transition-colors shadow-sm">
                Volver al Panel Principal
            </a>

        </div>
    </div>

</div>
@endsection
HTML;
file_put_contents('resources/views/admin/promocionar/configurar.blade.php', $content);
echo "Promocionar configured completely.\n";
?>
