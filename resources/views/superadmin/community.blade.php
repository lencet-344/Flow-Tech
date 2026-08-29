@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <!-- Icono de Estrella -->
            <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Comunidad de Crecimiento</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-10">Preguntas de emprendedores Premium — solo el administrador puede responder</p>
    </div>

    <!-- 3 Tarjetas de Métricas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div class="text-[36px] font-bold text-[#040116] leading-none mb-2">4</div>
            <div class="text-[13px] text-gray-500 font-medium">Total preguntas</div>
        </div>
        <!-- Pendientes -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div class="text-[36px] font-bold text-[#040116] leading-none mb-2">2</div>
            <div class="text-[13px] text-gray-500 font-medium">Pendientes</div>
        </div>
        <!-- Respondidas -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div class="text-[36px] font-bold text-[#040116] leading-none mb-2">2</div>
            <div class="text-[13px] text-gray-500 font-medium">Respondidas</div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="flex items-center gap-3 mb-8 overflow-x-auto pb-2 md:pb-0">
        <button id="btn-todos" onclick="filtrarComunidad('todos')" class="filter-btn bg-[#2563eb] text-white border border-transparent px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm transition whitespace-nowrap">Todas</button>
        <button id="btn-pendiente" onclick="filtrarComunidad('pendiente')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap flex items-center gap-2">
            Pendientes <span class="bg-yellow-400 text-white text-[11px] font-bold px-2 py-0.5 rounded-full">2</span>
        </button>
        <button id="btn-respondida" onclick="filtrarComunidad('respondida')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Respondidas</button>
    </div>

    <!-- Lista de Preguntas -->
    <div class="flex flex-col gap-5">
        
        <!-- Pregunta 1 (Respondida) -->
        <div class="community-card bg-white rounded-2xl border border-gray-100 shadow-sm p-7" data-estado="respondida">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full border border-[#d8b4fe] text-[#9333ea] text-[11px] font-semibold bg-white">Marketing</span>
                    <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-[11px] font-semibold">Respondida</span>
                </div>
                <span class="text-[13px] text-gray-500 font-medium">2026-08-20</span>
            </div>
            <h3 class="text-[17px] font-medium text-gray-900 mb-1">¿Cuál es la mejor estrategia para dar a conocer mi negocio en SINGKI y atraer más clientes?</h3>
            <p class="text-[13px] text-gray-500 mb-6 font-light">Carlos Pérez · TechSolutions GT</p>

            <!-- Caja de Respuesta -->
            <div class="border border-gray-100 rounded-xl p-5 bg-white shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-[#8b5cf6] text-white flex items-center justify-center text-[11px] font-bold">S</div>
                        <span class="text-[#8b5cf6] text-[13px] font-bold">Respuesta oficial de SINGKI</span>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-21</span>
                </div>
                <p class="text-[14px] text-gray-700 leading-relaxed font-light">Te recomendamos mantener tu perfil completo y actualizado, subir fotos de calidad de tus productos y responder rápidamente los chats. Publicar ofertas periódicas también aumenta tu visibilidad.</p>
            </div>
        </div>

        <!-- Pregunta 2 (Respondida) -->
        <div class="community-card bg-white rounded-2xl border border-gray-100 shadow-sm p-7" data-estado="respondida">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full border border-[#d8b4fe] text-[#9333ea] text-[11px] font-semibold bg-white">Precios</span>
                    <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-[11px] font-semibold">Respondida</span>
                </div>
                <span class="text-[13px] text-gray-500 font-medium">2026-08-21</span>
            </div>
            <h3 class="text-[17px] font-medium text-gray-900 mb-1">¿Cómo establezco precios competitivos cuando hay otros negocios del mismo rubro con precios muy bajos?</h3>
            <p class="text-[13px] text-gray-500 mb-6 font-light">Sofía Mejía · Moda Express</p>

            <!-- Caja de Respuesta -->
            <div class="border border-gray-100 rounded-xl p-5 bg-white shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-[#8b5cf6] text-white flex items-center justify-center text-[11px] font-bold">S</div>
                        <span class="text-[#8b5cf6] text-[13px] font-bold">Respuesta oficial de SINGKI</span>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-22</span>
                </div>
                <p class="text-[14px] text-gray-700 leading-relaxed font-light">Diferenciarte por valor es clave. Destaca la calidad, el servicio al cliente y la confiabilidad. Evita competir solo por precio; en cambio, asegúrate de que tu propuesta de valor sea clara en tu perfil.</p>
            </div>
        </div>

        <!-- Pregunta 3 (Pendiente) -->
        <div class="community-card bg-white rounded-2xl border border-gray-100 shadow-sm p-7" data-estado="pendiente">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full border border-[#d8b4fe] text-[#9333ea] text-[11px] font-semibold bg-white">Finanzas</span>
                    <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-600 text-[11px] font-semibold">Pendiente</span>
                </div>
                <div class="flex items-center gap-5">
                    <span class="text-[13px] text-gray-500 font-medium hidden sm:inline-block">2026-08-22</span>
                    <button class="bg-[#8b5cf6] hover:bg-[#7c3aed] text-white px-6 py-2.5 rounded-xl text-[13px] font-semibold transition shadow-sm">Responder</button>
                </div>
            </div>
            <h3 class="text-[17px] font-medium text-gray-900 mb-1">¿Cómo puedo gestionar mejor el flujo de caja de mi negocio en temporadas bajas?</h3>
            <p class="text-[13px] text-gray-500 font-light">Diego Torres · Construcciones Sólidas</p>
        </div>

        <!-- Pregunta 4 (Pendiente) -->
        <div class="community-card bg-white rounded-2xl border border-gray-100 shadow-sm p-7" data-estado="pendiente">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full border border-[#d8b4fe] text-[#9333ea] text-[11px] font-semibold bg-white">Ventas</span>
                    <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-600 text-[11px] font-semibold">Pendiente</span>
                </div>
                <div class="flex items-center gap-5">
                    <span class="text-[13px] text-gray-500 font-medium hidden sm:inline-block">2026-08-23</span>
                    <button class="bg-[#8b5cf6] hover:bg-[#7c3aed] text-white px-6 py-2.5 rounded-xl text-[13px] font-semibold transition shadow-sm">Responder</button>
                </div>
            </div>
            <h3 class="text-[17px] font-medium text-gray-900 mb-1">¿Hay alguna recomendación para aumentar la cantidad de reservas a través de SINGKI?</h3>
            <p class="text-[13px] text-gray-500 font-light">Ana Rodríguez · Distribuidora Alimentos Norte</p>
        </div>

    </div>
</div>

<!-- Lógica de Filtrado -->
<script>
    function filtrarComunidad(estado) {
        // 1. Reseteamos los botones
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        // 2. Pintamos de azul el botón activo
        const botonActivo = document.getElementById('btn-' + estado);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        // 3. Filtramos las preguntas instantáneamente
        const cartas = document.querySelectorAll('.community-card');
        cartas.forEach(carta => {
            if (estado === 'todos' || carta.getAttribute('data-estado') === estado) {
                carta.style.display = 'block'; 
            } else {
                carta.style.display = 'none'; 
            }
        });
    }
</script>
@endsection
