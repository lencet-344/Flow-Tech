<?php
$content = file_get_contents('resources/views/admin/perfil.blade.php');

$searchMain = <<<'HTML'
    <!-- 2. SECCI"N: FOTO DEL NEGOCIO -->
    <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-8 mb-8">
        <div class="flex flex-col md:flex-row gap-8 items-start">
            <!-- Foto Actual -->
            <div class="shrink-0">
                <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Foto Actual</span>
                <div class="w-32 h-32 rounded-2xl overflow-hidden bg-gray-100 border border-gray-200 shadow-inner">
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
                <p class="text-[12px] text-gray-500 mb-4">Formatos aceptados: JPG, PNG, WEBP. Tamao mǭximo: 5 MB.</p>
                <button class="bg-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm hover:bg-blue-600 transition">
                    Guardar foto
                </button>
            </div>
        </div>
    </div>
HTML;
$replaceMain = <<<'HTML'
    <div x-data="{ name: '{{ $company->name ?? 'TechSolutions GT' }}', category: '{{ $company->category->name ?? 'Tecnología' }}', desc: '{{ $company->description ?? '' }}' }">
    <!-- 2. SECCIÓN: FOTO DEL NEGOCIO -->
    <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-8 mb-8">
        <form action="{{ route('companies.update', $company->id ?? 1) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-8 items-start">
            @csrf
            @method('PUT')
            
            <!-- Foto Actual -->
            <div class="shrink-0">
                <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Foto Actual</span>
                <div class="w-32 h-32 rounded-2xl overflow-hidden bg-gray-100 border border-gray-200 shadow-inner">
                    <img src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80' }}" alt="Foto Actual" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Opciones / Subida -->
            <div class="flex-1">
                <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Opciones</span>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 flex items-center justify-center gap-3 text-gray-500 bg-gray-50/50 hover:bg-gray-50 cursor-pointer transition mb-3 relative overflow-hidden">
                    <input type="file" name="logo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".jpg,.png,.webp">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span class="text-sm font-medium">Subir nueva foto</span>
                </div>
                <p class="text-[12px] text-gray-500 mb-4">Formatos aceptados: JPG, PNG, WEBP. Tamaño máximo: 5 MB.</p>
                <button type="submit" class="bg-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm hover:bg-blue-600 transition">
                    Guardar foto
                </button>
            </div>
        </form>
    </div>
HTML;
$content = str_replace($searchMain, $replaceMain, $content);


// Wait, I need to match carefully for the form and preview. I will just rewrite the whole grid.
$startGrid = strpos($content, '<!-- 3. SECCI"N: FORMULARIO Y VISTA PREVIA -->');
if ($startGrid === false) {
    // If charset differences broke the match:
    $startGrid = strpos($content, '<!-- 3. SECCI');
}

$endGrid = strpos($content, '</div>', strrpos($content, '</div>', strrpos($content, '</div>', strrpos($content, '</div>') - 1) - 1) - 1);
// Instead of risky strpos, let's just do a clean string replacement of the rest of the file since it's the bottom.

$newFormSection = <<<'HTML'
    <!-- 3. SECCIÓN: FORMULARIO Y VISTA PREVIA -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- COLUMNA IZQUIERDA: Formulario -->
        <div class="lg:col-span-2 bg-white rounded-[20px] shadow-sm border border-gray-100 p-8">
            <form action="{{ route('companies.update', $company->id ?? 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nombre del negocio</label>
                        <input type="text" name="name" x-model="name" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                        @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <!-- Categoría -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Categoría</label>
                        <div class="relative">
                            <select name="category_id" x-model="category" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] appearance-none outline-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $company->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <!-- Descripción -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Descripción</label>
                        <textarea name="description" x-model="desc" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none resize-none"></textarea>
                    </div>
                    <!-- Teléfono -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Teléfono</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $company->telephone) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                    </div>
                    <!-- Correo -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Correo electrónico</label>
                        <input type="text" name="email" value="{{ old('email', $company->email) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                    </div>
                    <!-- Ubicación -->
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Ubicación</label>
                        <input type="text" name="address" value="{{ old('address', $company->address) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                    </div>
                    <!-- Sitio Web -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Sitio Web</label>
                        <input type="text" name="website" value="{{ old('website', $company->website) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
                    </div>
                    <!-- Horario -->
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Horario de Atención</label>
                        <input type="text" name="horario" value="{{ old('horario', $company->horario) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none">
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
HTML;

$content = substr($content, 0, $startGrid) . $newFormSection;

// Save file
file_put_contents('resources/views/admin/perfil.blade.php', $content);
echo "Profile view updated perfectly!\n";
?>
