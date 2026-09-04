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
            <a href="{{ url('/perfil-publico') }}" class="bg-transparent border border-gray-800 text-[#040116] font-medium px-5 py-2.5 rounded-xl text-sm transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Ver perfil público
            </a>
            
        </div>
    </div>

    <!-- 2. SECCIÓN: FOTO DEL NEGOCIO -->
    <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-8 mb-8">
        <h2 class="text-lg font-bold text-[#040116] mb-1">Foto del negocio</h2>
        <p class="text-gray-500 text-sm mb-6">Esta imagen aparecerá en el perfil público de tu negocio</p>
        
        <form action="{{ route('admin.perfil.update', $company->id ?? 1) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-8">
            @csrf
            @method('PUT')
            
            <!-- Foto Actual -->
            <div class="w-full md:w-48 shrink-0">
                <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Foto Actual</span>
                <div class="w-full h-32 rounded-xl overflow-hidden border border-gray-100">
                    <img src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80' }}" alt="Foto Actual" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Opciones / Subida -->
            <div class="flex-1">
                <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Opciones</span>
                <label for="logo_upload" class="cursor-pointer block border-2 border-dashed border-gray-200 rounded-xl p-4 flex items-center justify-center gap-3 text-gray-500 bg-gray-50/50 hover:bg-gray-50 transition mb-3">
                    <input type="file" name="logo" id="logo_upload" class="hidden" accept="image/png, image/jpeg, image/webp">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span class="text-sm font-medium">Subir nueva foto</span>
                </label>
                @error('logo') <span class="text-red-500 text-sm mb-3 block">{{ $message }}</span> @enderror
                <p class="text-[12px] text-gray-500 mb-4">Formatos aceptados: JPG, PNG, WEBP. Tamaño máximo: 5 MB.</p>
                <button type="submit" class="bg-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm hover:bg-blue-600 transition">
                    Guardar foto
                </button>
            </div>
        </form>
    </div>

    <!-- 3. SECCIÓN: FORMULARIO Y VISTA PREVIA -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- COLUMNA IZQUIERDA: Formulario -->
        <div class="lg:col-span-2 bg-white rounded-[20px] shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.perfil.update', $company->id ?? 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nombre del negocio</label>
                        <input type="text" name="name" x-model="name" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Categoría -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Categoría</label>
                        <div class="relative">
                           <select name="category_id" style="background-image: none;" x-model="category" onfocus="document.getElementById('cat-arrow').classList.add('rotate-180')" onblur="document.getElementById('cat-arrow').classList.remove('rotate-180')" onchange="document.getElementById('cat-arrow').classList.remove('rotate-180')" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] appearance-none outline-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $company->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg id="cat-arrow" class="h-4 w-4 pointer-events-none transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('category_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Descripción -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Descripción</label>
                        <textarea name="description" x-model="desc" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none resize-none"></textarea>
                        @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Teléfono -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Teléfono</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $company->telephone ?? '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                        @error('telephone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Correo -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Correo electrónico</label>
                        <input type="text" name="email" value="{{ old('email', $company->email ?? '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                        @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Ubicación -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Ubicación</label>
                        <input type="text" name="address" value="{{ old('address', $company->address ?? '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                        @error('address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Sitio Web -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Sitio Web</label>
                        <input type="text" name="website" value="{{ old('website', $company->website ?? '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                        @error('website') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Horario -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Horario de Atención</label>
                        <input type="text" name="horario" value="{{ old('horario', $company->horario ?? '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                        @error('horario') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-[#3b82f6] text-white font-bold px-8 py-3 rounded-xl hover:bg-blue-600 transition shadow-sm text-sm">Guardar cambios</button>
                </div>
            </form>
        </div>

        <!-- COLUMNA DERECHA: Vista Previa -->
        <div class="lg:col-span-1">
            <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-4">Vista Previa Pública</span>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="h-32 overflow-hidden bg-gray-100">
                    <img src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80' }}" alt="Cover" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-[#040116] text-lg mb-3" x-text="name"></h3>
                    <span class="inline-block bg-[#eff6ff] text-[#2563eb] text-[11px] font-medium px-3 py-1 rounded-full mb-4">Categoría</span>
                    <p class="text-gray-500 text-xs leading-relaxed mb-6" x-text="desc"></p>
                    
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ old('address', $company->address ?? 'Ubicación') }}
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
    </div> <!-- /x-data -->
</div>
@endsection