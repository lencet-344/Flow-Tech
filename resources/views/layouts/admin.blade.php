@extends('layouts.admin')

@section('content')
<div class="p-8">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <svg class="w-7 h-7 text-[#0f172a]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h1 class="text-[26px] font-bold text-[#0f172a] tracking-tight">Negocios</h1>
        </div>
        <p class="text-[14px] text-gray-500 font-light ml-10">4 negocios registrados en la plataforma</p>
    </div>

    <!-- Filtros (Pestañas) -->
    <div class="flex items-center gap-3 mb-6 ml-1">
        <button class="bg-[#2563eb] text-white px-5 py-2 rounded-full text-[13px] font-medium shadow-sm transition hover:bg-blue-700">Todos</button>
        <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-5 py-2 rounded-full text-[13px] font-medium shadow-sm transition">Activos</button>
        <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-5 py-2 rounded-full text-[13px] font-medium shadow-sm transition">Pendientes</button>
        <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-5 py-2 rounded-full text-[13px] font-medium shadow-sm transition">Suspendidos</button>
    </div>

    <!-- Tabla de Datos -->
    <div class="bg-white rounded-[12px] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-100 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Negocio</th>
                        <th class="px-6 py-4">Propietario</th>
                        <th class="px-6 py-4">Categoría</th>
                        <th class="px-6 py-4 text-center">Productos</th>
                        <th class="px-6 py-4 text-center">Reportes</th>
                        <th class="px-6 py-4">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] text-gray-700 divide-y divide-gray-50">
                    
                    <!-- Fila 1 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-[#0f172a]">TechSolutions GT</td>
                        <td class="px-6 py-4">Carlos Pérez</td>
                        <td class="px-6 py-4">Tecnología</td>
                        <td class="px-6 py-4 text-center">6</td>
                        <td class="px-6 py-4 text-center text-gray-400">—</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-600 px-3 py-1 rounded-md text-[11px] font-bold tracking-wide border border-green-100">Activo</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <button class="text-gray-500 hover:text-[#2563eb] font-medium transition">Ver</button>
                            <button class="text-red-500 hover:text-red-700 font-medium transition">Suspender</button>
                        </td>
                    </tr>
                    
                    <!-- Fila 2 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-[#0f172a]">Distribuidora Alimentos Norte</td>
                        <td class="px-6 py-4">Ana Rodríguez</td>
                        <td class="px-6 py-4">Alimentos</td>
                        <td class="px-6 py-4 text-center">14</td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-red-50 text-red-600 px-2.5 py-0.5 rounded text-[11px] font-bold border border-red-100">1</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-600 px-3 py-1 rounded-md text-[11px] font-bold tracking-wide border border-green-100">Activo</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <button class="text-gray-500 hover:text-[#2563eb] font-medium transition">Ver</button>
                            <button class="text-red-500 hover:text-red-700 font-medium transition">Suspender</button>
                        </td>
                    </tr>
                    
                    <!-- Fila 3 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-[#0f172a]">Construcciones Sólidas</td>
                        <td class="px-6 py-4">Diego Torres</td>
                        <td class="px-6 py-4">Construcción</td>
                        <td class="px-6 py-4 text-center">8</td>
                        <td class="px-6 py-4 text-center text-gray-400">—</td>
                        <td class="px-6 py-4">
                            <span class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-md text-[11px] font-bold tracking-wide border border-yellow-100">Pendiente</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <button class="text-gray-500 hover:text-[#2563eb] font-medium transition">Ver</button>
                            <button class="text-green-600 hover:text-green-700 font-medium transition">Activar</button>
                        </td>
                    </tr>

                    <!-- Fila 4 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-[#0f172a]">Moda Express</td>
                        <td class="px-6 py-4">Sofía Mejía</td>
                        <td class="px-6 py-4">Moda</td>
                        <td class="px-6 py-4 text-center">23</td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-red-50 text-red-600 px-2.5 py-0.5 rounded text-[11px] font-bold border border-red-100">2</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-600 px-3 py-1 rounded-md text-[11px] font-bold tracking-wide border border-green-100">Activo</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <button class="text-gray-500 hover:text-[#2563eb] font-medium transition">Ver</button>
                            <button class="text-red-500 hover:text-red-700 font-medium transition">Suspender</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection