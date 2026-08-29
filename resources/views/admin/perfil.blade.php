@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10">
    
    <!-- 1. CABECERA -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-[28px] font-bold text-[#040116] tracking-tight">Perfil Público del Negocio</h1>
            <p class="text-gray-500 text-sm mt-1">Administra la información que ven los clientes</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="bg-transparent border border-gray-800 text-[#040116] font-medium px-5 py-2.5 rounded-xl text-sm transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Ver perfil público
            </button>
            <button class="bg-[#2563eb] text-white font-medium px-5 py-2.5 rounded-xl text-sm shadow-sm transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Editar perfil
            </button>
        </div>
    </div>

    <!-- 2. SECCIÓN: FOTO DEL NEGOCIO -->
    <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-8 mb-8">
        <h2 class="text-lg font-bold text-[#040116] mb-1">Foto del negocio</h2>
        <p class="text-gray-500 text-sm mb-6">Esta imagen aparecerá en el perfil público de tu negocio</p>
        
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Foto Actual -->
            <div class="w-full md:w-48 shrink-0">
                <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Foto Actual</span>
                <div class="w-full h-32 rounded-xl overflow-hidden border border-gray-100">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80" alt="Foto Actual" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Opciones / Subida -->
            <div class="flex-1">
                <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Opciones</span>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 flex items-center justify-center gap-3 text-gray-500 bg-gray-50/50 hover:bg-gray-50 cursor-pointer transition mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span class="text-sm font-medium">Subir nueva foto</span>
                </div>
                <p class="text-[12px] text-gray-500 mb-4">Formatos aceptados: JPG, PNG, WEBP. Tamaño máximo: 5 MB.</p>
                <button class="bg-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm hover:bg-blue-600 transition">
                    Guardar foto
                </button>
            </div>
        </div>
    </div>

    <!-- 3. SECCIÓN: FORMULARIO Y VISTA PREVIA -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- COLUMNA IZQUIERDA: Formulario -->
        <div class="lg:col-span-2 bg-white rounded-[20px] shadow-sm border border-gray-100 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nombre del negocio</label>
                    <input type="text" value="TechSolutions GT" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                </div>
                <!-- Categoría -->
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Categoría</label>
                    <div class="relative">
                        <select class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] appearance-none outline-none">
                            <option>Tecnología</option>
                            <option>Salud</option>
                            <option>Alimentos</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                <!-- Descripción -->
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Descripción</label>
                    <textarea rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none resize-none">Soluciones tecnológicas para empresas. Hardware, software y soporte técnico especializado.</textarea>
                </div>
                <!-- Teléfono -->
                <div class="col-span-1">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Teléfono</label>
                    <input type="text" value="+502 2234-5678" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                </div>
                <!-- Correo -->
                <div class="col-span-1">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Correo electrónico</label>
                    <input type="text" value="info@techsolutionsgt.com" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                </div>
                <!-- Ubicación -->
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Ubicación</label>
                    <input type="text" value="Ciudad de Guatemala, Zona 10" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                </div>
                <!-- Sitio Web -->
                <div class="col-span-1">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Sitio Web</label>
                    <input type="text" value="www.techsolutionsgt.com" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                </div>
                <!-- Horario -->
                <div class="col-span-1">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Horario de Atención</label>
                    <input type="text" value="Lun-Vie 8:00-18:00" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA: Vista Previa -->
        <div class="lg:col-span-1">
            <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-4">Vista Previa Pública</span>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="h-32 overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80" alt="Cover" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-[#040116] text-lg mb-3">TechSolutions GT</h3>
                    <span class="inline-block bg-[#eff6ff] text-[#2563eb] text-[11px] font-medium px-3 py-1 rounded-full mb-4">Tecnología</span>
                    <p class="text-gray-500 text-xs leading-relaxed mb-6">Soluciones tecnológicas para empresas. Hardware, software y soporte técnico especializado.</p>
                    
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Estelí
                        </div>
                        <div class="flex items-center gap-1 text-xs">
                            <span class="text-yellow-400 text-sm">★</span>
                            <span class="font-bold text-gray-900">4.8</span>
                            <span class="text-gray-500">(124 reseñas)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
