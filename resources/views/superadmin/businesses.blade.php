@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-1">
            <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Negocios</h1>
        </div>
        <p class="text-gray-500 text-sm font-light ml-9">4 negocios registrados en la plataforma</p>
    </div>

    <!-- Filtros -->
    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2 md:pb-0">
        <button id="btn-todos" onclick="filtrarNegocios('todos')" class="filter-btn bg-[#2563eb] text-white border border-transparent px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm transition whitespace-nowrap">Todos</button>
        <button id="btn-activo" onclick="filtrarNegocios('activo')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Activos</button>
        <button id="btn-pendiente" onclick="filtrarNegocios('pendiente')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Pendientes</button>
        <button id="btn-suspendido" onclick="filtrarNegocios('suspendido')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Suspendidos</button>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-[1.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-5">Negocio</th>
                        <th class="px-6 py-5">Propietario</th>
                        <th class="px-6 py-5">Categoría</th>
                        <th class="px-6 py-5">Productos</th>
                        <th class="px-6 py-5">Reportes</th>
                        <th class="px-6 py-5">Estado</th>
                        <th class="px-6 py-5 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-[13.5px] text-gray-700 divide-y divide-gray-50" id="tabla-negocios">
                    
                    <!-- Fila 1 -->
                    <tr class="business-row hover:bg-gray-50/50 transition" data-estado="activo">
                        <td class="px-6 py-4 font-medium text-[#040116]">TechSolutions GT</td>
                        <td class="px-6 py-4 text-gray-600">Carlos Pérez</td>
                        <td class="px-6 py-4 text-gray-600">Tecnología</td>
                        <td class="px-6 py-4 font-medium">6</td>
                        <td class="px-6 py-4 text-gray-400">—</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-500 px-5 py-1.5 rounded-full text-[11.5px] font-bold tracking-wide w-24 inline-block text-center">Activo</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="bg-gray-50 text-gray-600 hover:bg-gray-100 px-3 py-1.5 rounded-md text-xs font-semibold transition border border-gray-200">Ver</button>
                                <button class="bg-red-50 text-red-500 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-semibold transition">Suspender</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 2 -->
                    <tr class="business-row hover:bg-gray-50/50 transition" data-estado="activo">
                        <td class="px-6 py-4 font-medium text-[#040116]">Distribuidora Alimentos Norte</td>
                        <td class="px-6 py-4 text-gray-600">Ana Rodríguez</td>
                        <td class="px-6 py-4 text-gray-600">Alimentos</td>
                        <td class="px-6 py-4 font-medium">14</td>
                        <td class="px-6 py-4">
                            <span class="bg-red-50 text-red-500 px-3 py-1 rounded-md text-[12px] font-bold inline-block w-14 text-left">1</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-500 px-5 py-1.5 rounded-full text-[11.5px] font-bold tracking-wide w-24 inline-block text-center">Activo</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="bg-gray-50 text-gray-600 hover:bg-gray-100 px-3 py-1.5 rounded-md text-xs font-semibold transition border border-gray-200">Ver</button>
                                <button class="bg-red-50 text-red-500 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-semibold transition">Suspender</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 3 -->
                    <tr class="business-row hover:bg-gray-50/50 transition" data-estado="pendiente">
                        <td class="px-6 py-4 font-medium text-[#040116]">Construcciones Sólidas</td>
                        <td class="px-6 py-4 text-gray-600">Diego Torres</td>
                        <td class="px-6 py-4 text-gray-600">Construcción</td>
                        <td class="px-6 py-4 font-medium">8</td>
                        <td class="px-6 py-4 text-gray-400">—</td>
                        <td class="px-6 py-4">
                            <span class="bg-yellow-50 text-yellow-600 px-5 py-1.5 rounded-full text-[11.5px] font-bold tracking-wide w-24 inline-block text-center">Pendiente</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="bg-gray-50 text-gray-600 hover:bg-gray-100 px-3 py-1.5 rounded-md text-xs font-semibold transition border border-gray-200">Ver</button>
                                <button class="bg-green-50 text-green-600 hover:bg-green-100 px-4 py-1.5 rounded-md text-xs font-semibold transition">Activar</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 4 -->
                    <tr class="business-row hover:bg-gray-50/50 transition" data-estado="activo">
                        <td class="px-6 py-4 font-medium text-[#040116]">Moda Express</td>
                        <td class="px-6 py-4 text-gray-600">Sofía Mejía</td>
                        <td class="px-6 py-4 text-gray-600">Moda</td>
                        <td class="px-6 py-4 font-medium">23</td>
                        <td class="px-6 py-4">
                            <span class="bg-red-50 text-red-500 px-3 py-1 rounded-md text-[12px] font-bold inline-block w-14 text-left">2</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-500 px-5 py-1.5 rounded-full text-[11.5px] font-bold tracking-wide w-24 inline-block text-center">Activo</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="bg-gray-50 text-gray-600 hover:bg-gray-100 px-3 py-1.5 rounded-md text-xs font-semibold transition border border-gray-200">Ver</button>
                                <button class="bg-red-50 text-red-500 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-semibold transition">Suspender</button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Lógica de Filtrado por Estado -->
<script>
    function filtrarNegocios(estado) {
        // 1. Reseteamos el estilo de todos los botones de filtro al estado inactivo
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        // 2. Pintamos de azul el botón que acabamos de clickear
        const botonActivo = document.getElementById('btn-' + estado);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        // 3. Filtramos las filas de la tabla instantáneamente
        const filas = document.querySelectorAll('.business-row');
        filas.forEach(fila => {
            if (estado === 'todos' || fila.getAttribute('data-estado') === estado) {
                fila.style.display = ''; // Mostrar
            } else {
                fila.style.display = 'none'; // Ocultar
            }
        });
    }
</script>
@endsection
