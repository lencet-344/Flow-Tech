@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10">
    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Inventario</h1>
            <p class="text-gray-500 text-sm mt-1">6 productos en catálogo</p>
        </div>
        <button class="bg-[#2563eb] hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm shadow-sm transition-colors flex items-center gap-2">
            + Agregar producto
        </button>
    </div>

    <!-- 3 Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total</span>
            <span class="text-4xl font-bold text-[#040116]">6</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Disponibles</span>
            <span class="text-4xl font-bold text-[#040116]">4</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Agotados</span>
            <span class="text-4xl font-bold text-[#040116]">2</span>
        </div>
    </div>

    <!-- Buscador y Filtros -->
    <div class="flex flex-col md:flex-row items-center gap-4 mb-6">
        <div class="w-full md:w-80">
            <input type="text" placeholder="Buscar por nombre o SKU..." class="w-full pl-4 pr-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-[#2563eb] focus:border-[#2563eb] text-sm outline-none text-gray-700">
        </div>
        <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
            <button class="bg-[#2563eb] text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm whitespace-nowrap">Todos</button>
            <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-sm whitespace-nowrap">Disponibles</button>
            <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-sm whitespace-nowrap">Agotados</button>
        </div>
    </div>

    <!-- Tabla de Inventario -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Exist. Inicial</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Stock Actual</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Saldo Mín.</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <!-- Fila 1: Laptop -->
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                    <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=100&q=80" alt="Laptop" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm font-semibold text-[#040116]">Laptop HP EliteBook 840</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">HP-840-G9</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">50</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">12</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">5</td>
                        <td class="px-6 py-4"><span class="inline-flex bg-green-50 text-green-600 border border-green-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span></td>
                        <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 28.500</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 text-gray-400">
                                <button class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                <button class="hover:text-gray-700 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                <button class="hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Fila 2: Monitor -->
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                    <img src="https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=100&q=80" alt="Monitor" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm font-semibold text-[#040116]">Monitor Dell 27'' 4K</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">DELL-27-4K</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">50</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">0</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">3</td>
                        <td class="px-6 py-4"><span class="inline-flex bg-red-50 text-red-600 border border-red-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Agotado</span></td>
                        <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 4200</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 text-gray-400">
                                <button class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                <button class="hover:text-gray-700 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                <button class="hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 3: Mouse -->
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                    <img src="https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=100&q=80" alt="Mouse" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm font-semibold text-[#040116]">Mouse Logitech MX Master 3</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">LOG-MXM3</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">50</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">35</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">10</td>
                        <td class="px-6 py-4"><span class="inline-flex bg-green-50 text-green-600 border border-green-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span></td>
                        <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 650</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 text-gray-400">
                                <button class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                <button class="hover:text-gray-700 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                <button class="hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 4: Switch -->
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=100&q=80" alt="Switch" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm font-semibold text-[#040116]">Switch Cisco 24 puertos</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">CSC-SW24</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">50</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">4</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">2</td>
                        <td class="px-6 py-4"><span class="inline-flex bg-green-50 text-green-600 border border-green-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span></td>
                        <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 3800</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 text-gray-400">
                                <button class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                <button class="hover:text-gray-700 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                <button class="hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 5: Teclado -->
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                    <img src="https://images.unsplash.com/photo-1595225476474-87563907a212?w=100&q=80" alt="Teclado" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm font-semibold text-[#040116]">Teclado Mecánico Keychron K2</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">KEY-K2-RGB</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">50</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">0</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">5</td>
                        <td class="px-6 py-4"><span class="inline-flex bg-red-50 text-red-600 border border-red-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Agotado</span></td>
                        <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 890</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 text-gray-400">
                                <button class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                <button class="hover:text-gray-700 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                <button class="hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 6: Disco SSD -->
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                    <img src="https://images.unsplash.com/photo-1531492746076-161ca9bcad58?w=100&q=80" alt="SSD" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm font-semibold text-[#040116]">Disco SSD Samsung 1TB</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">SAM-SSD-1T</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">50</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#040116] text-center">22</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">8</td>
                        <td class="px-6 py-4"><span class="inline-flex bg-green-50 text-green-600 border border-green-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span></td>
                        <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 1200</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 text-gray-400">
                                <button class="hover:text-[#2563eb] transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                <button class="hover:text-gray-700 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                <button class="hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
