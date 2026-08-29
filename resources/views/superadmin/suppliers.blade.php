@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <svg class="w-8 h-8 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Proveedores</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-11">3 proveedores y emprendedores registrados</p>
    </div>

    <!-- Lista de Tarjetas de Proveedores -->
    <div class="flex flex-col gap-6">
        
        <!-- Tarjeta 1: Carlos -->
        <div class="bg-white rounded-[1.5rem] border border-gray-100 shadow-sm p-8 hover:shadow-md transition-shadow">
            <!-- Info Personal -->
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 font-bold text-xl flex items-center justify-center">C</div>
                    <div>
                        <h3 class="text-[17px] font-bold text-gray-900">Carlos Pérez</h3>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">carlos@techsolutions.com</p>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">Registrado: 2026-06-28</p>
                    </div>
                </div>
                <span class="px-4 py-1.5 bg-green-50 text-green-500 text-[11px] font-bold rounded-full">Activo</span>
            </div>
            <!-- Divisor y Info del Negocio -->
            <div class="border-t border-gray-50 pt-6">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[12px] text-gray-500 mb-1">Negocio asociado</p>
                        <h4 class="text-[16px] font-bold text-gray-900">TechSolutions GT</h4>
                        <p class="text-[13.5px] text-gray-600 mt-0.5">Tecnología · 6 productos</p>
                    </div>
                    <button class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-5 py-2.5 rounded-xl text-[13px] font-semibold transition-colors">
                        Ver negocio
                    </button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2: Ana -->
        <div class="bg-white rounded-[1.5rem] border border-gray-100 shadow-sm p-8 hover:shadow-md transition-shadow">
            <!-- Info Personal -->
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 font-bold text-xl flex items-center justify-center">A</div>
                    <div>
                        <h3 class="text-[17px] font-bold text-gray-900">Ana Rodríguez</h3>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">ana@modaexpress.com</p>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">Registrado: 2026-07-03</p>
                    </div>
                </div>
                <span class="px-4 py-1.5 bg-green-50 text-green-500 text-[11px] font-bold rounded-full">Activo</span>
            </div>
            <!-- Divisor y Info del Negocio -->
            <div class="border-t border-gray-50 pt-6">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[12px] text-gray-500 mb-1">Negocio asociado</p>
                        <h4 class="text-[16px] font-bold text-gray-900">Distribuidora Alimentos Norte</h4>
                        <p class="text-[13.5px] text-gray-600 mt-0.5">Alimentos · 14 productos</p>
                    </div>
                    <button class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-5 py-2.5 rounded-xl text-[13px] font-semibold transition-colors">
                        Ver negocio
                    </button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3: Diego -->
        <div class="bg-white rounded-[1.5rem] border border-gray-100 shadow-sm p-8 hover:shadow-md transition-shadow">
            <!-- Info Personal -->
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 font-bold text-xl flex items-center justify-center">D</div>
                    <div>
                        <h3 class="text-[17px] font-bold text-gray-900">Diego Torres</h3>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">diego@construcciones.com</p>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">Registrado: 2026-05-15</p>
                    </div>
                </div>
                <span class="px-4 py-1.5 bg-green-50 text-green-500 text-[11px] font-bold rounded-full">Activo</span>
            </div>
            <!-- Divisor y Info del Negocio -->
            <div class="border-t border-gray-50 pt-6">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[12px] text-gray-500 mb-1">Negocio asociado</p>
                        <h4 class="text-[16px] font-bold text-gray-900">Construcciones Sólidas</h4>
                        <p class="text-[13.5px] text-gray-600 mt-0.5">Construcción · 8 productos</p>
                    </div>
                    <button class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-5 py-2.5 rounded-xl text-[13px] font-semibold transition-colors">
                        Ver negocio
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
