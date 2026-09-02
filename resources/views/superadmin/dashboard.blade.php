@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-1">Panel de Administración</h1>
        <p class="text-gray-500 text-sm font-light">Resumen general de la plataforma SINGKI</p>
    </div>

    <!-- 1. GRID DE MÉTRICAS (5 Columnas) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Usuarios -->
        <a href="{{ route('superadmin.users') }}" class="block bg-white border border-blue-400 rounded-xl p-5 shadow-sm hover:shadow-md transition cursor-pointer hover:-translate-y-1 hover:bg-blue-50/50">
            <svg class="w-6 h-6 text-blue-500 mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <div class="text-[40px] leading-none font-bold text-blue-500 mb-2">6</div>
            <div class="text-sm font-medium text-blue-500">Usuarios registrados</div>
        </a>
        <!-- Negocios -->
        <a href="{{ route('superadmin.businesses') }}" class="block bg-white border border-green-400 rounded-xl p-5 shadow-sm hover:shadow-md transition cursor-pointer hover:-translate-y-1 hover:bg-green-50/50">
            <svg class="w-6 h-6 text-green-500 mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <div class="text-[40px] leading-none font-bold text-green-500 mb-2">4</div>
            <div class="text-sm font-medium text-green-500">Negocios registrados</div>
        </a>
        <!-- Reportes -->
        <a href="{{ route('superadmin.reports') }}" class="block bg-white border border-red-400 rounded-xl p-5 shadow-sm hover:shadow-md transition cursor-pointer hover:-translate-y-1 hover:bg-red-50/50">
            <svg class="w-6 h-6 text-red-500 mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
            <div class="text-[40px] leading-none font-bold text-red-500 mb-2">3</div>
            <div class="text-sm font-medium text-red-500">Reportes pendientes</div>
        </a>
        <!-- Consultas Abiertas -->
        <a href="{{ route('superadmin.queries') }}" class="block bg-white border border-yellow-400 rounded-xl p-5 shadow-sm hover:shadow-md transition cursor-pointer hover:-translate-y-1 hover:bg-yellow-50/50">
            <svg class="w-6 h-6 text-yellow-500 mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            <div class="text-[40px] leading-none font-bold text-yellow-500 mb-2">4</div>
            <div class="text-sm font-medium text-yellow-500">Consultas abiertas</div>
        </a>
        <!-- Contenido (Moderación) -->
        <a href="{{ route('superadmin.moderation') }}" class="block bg-white border border-purple-400 rounded-xl p-5 shadow-sm hover:shadow-md transition cursor-pointer hover:-translate-y-1 hover:bg-purple-50/50">
            <svg class="w-6 h-6 text-purple-500 mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div class="text-[40px] leading-none font-bold text-purple-500 mb-2">2</div>
            <div class="text-sm font-medium text-purple-500">Contenido pendiente</div>
        </a>
    </div>

    <!-- 2. GRID CENTRAL (Reportes y Servicio) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Reportes Pendientes -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    <h2 class="text-lg font-bold text-gray-900">Reportes pendientes</h2>
                </div>
                <a href="{{ route('superadmin.reports') }}" class="text-[13px] text-blue-600 font-medium hover:underline">Ver todos &rarr;</a>
            </div>
            <div class="space-y-6">
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <span class="px-3 py-1 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full mt-0.5">Negocio</span>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">Moda Express</h4>
                            <p class="text-[12px] text-gray-500">Información falsa en el perfil</p>
                        </div>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-18</span>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <span class="px-3 py-1 bg-purple-50 text-purple-600 text-[11px] font-bold rounded-full mt-0.5">Contenido</span>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">Foto de producto - Laptop HP</h4>
                            <p class="text-[12px] text-gray-500">Imagen inapropiada</p>
                        </div>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-20</span>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <span class="px-3 py-1 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full mt-0.5">Negocio</span>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">Distribuidora Alimentos Norte</h4>
                            <p class="text-[12px] text-gray-500">Negocio no existe</p>
                        </div>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-21</span>
                </div>
            </div>
        </div>

        <!-- Servicio al cliente -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <h2 class="text-lg font-bold text-gray-900">Servicio al cliente</h2>
                </div>
                <a href="{{ route('superadmin.support') }}" class="text-[13px] text-blue-600 font-medium hover:underline">Ver todos &rarr;</a>
            </div>
            <div class="space-y-6">
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <span class="px-3 py-1 bg-red-50 text-red-500 text-[11px] font-bold rounded-full mt-0.5">Alta</span>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">No puedo completar mi registro</h4>
                            <p class="text-[12px] text-gray-500">Diego Torres</p>
                        </div>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-21</span>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <span class="px-3 py-1 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full mt-0.5">Media</span>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">Mi negocio no aparece en los resultados de búsqueda</h4>
                            <p class="text-[12px] text-gray-500">Ana Rodríguez</p>
                        </div>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-20</span>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-bold rounded-full mt-0.5">Baja</span>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">¿Cómo elimino una reserva de un cliente?</h4>
                            <p class="text-[12px] text-gray-500">Carlos Pérez</p>
                        </div>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-19</span>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-bold rounded-full mt-0.5">Baja</span>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">¿Puedo tener más de un negocio registrado?</h4>
                            <p class="text-[12px] text-gray-500">Roberto Lima</p>
                        </div>
                    </div>
                    <span class="text-[12px] text-gray-500">2026-08-17</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. GRID INFERIOR (Negocios y Usuarios) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Negocios Registrados -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <h2 class="text-lg font-bold text-gray-900">Negocios registrados</h2>
                </div>
                <a href="{{ route('superadmin.businesses') }}" class="text-[13px] text-blue-600 font-medium hover:underline">Ver todos &rarr;</a>
            </div>
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-[14px] font-bold text-gray-900">TechSolutions GT</h4>
                        <p class="text-[12px] text-gray-500">Tecnología · 2026-06-28</p>
                    </div>
                    <span class="px-4 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Activo</span>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-[14px] font-bold text-gray-900">Distribuidora Alimentos Norte</h4>
                        <p class="text-[12px] text-gray-500">Alimentos · 2026-07-03</p>
                    </div>
                    <span class="px-4 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Activo</span>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-[14px] font-bold text-gray-900">Construcciones Sólidas</h4>
                        <p class="text-[12px] text-gray-500">Construcción · 2026-05-15</p>
                    </div>
                    <span class="px-4 py-1 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full">Pendiente</span>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-[14px] font-bold text-gray-900">Moda Express</h4>
                        <p class="text-[12px] text-gray-500">Moda · 2026-04-20</p>
                    </div>
                    <span class="px-4 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Activo</span>
                </div>
            </div>
        </div>

        <!-- Usuarios Recientes -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <h2 class="text-lg font-bold text-gray-900">Usuarios recientes</h2>
                </div>
                <a href="{{ route('superadmin.users') }}" class="text-[13px] text-blue-600 font-medium hover:underline">Ver todos &rarr;</a>
            </div>
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">M</div>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">María González</h4>
                            <p class="text-[12px] text-gray-500">Cliente</p>
                        </div>
                    </div>
                    <span class="px-4 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Activo</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">C</div>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">Carlos Pérez</h4>
                            <p class="text-[12px] text-gray-500">Proveedor</p>
                        </div>
                    </div>
                    <span class="px-4 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Activo</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">A</div>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">Ana Rodríguez</h4>
                            <p class="text-[12px] text-gray-500">Proveedor</p>
                        </div>
                    </div>
                    <span class="px-4 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Activo</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">R</div>
                        <div>
                            <h4 class="text-[14px] font-bold text-gray-900">Roberto Lima</h4>
                            <p class="text-[12px] text-gray-500">Cliente</p>
                        </div>
                    </div>
                    <span class="px-4 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Activo</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
