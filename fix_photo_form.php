<?php
$content = file_get_contents('resources/views/admin/perfil.blade.php');

$searchPhotoSection = '/<div class="flex flex-col md:flex-row gap-8">(.*?)<\/div>\s*<\/div>\s*<div x-data/is';
$replacePhotoSection = <<<'HTML'
        <form action="{{ route('companies.update', $company->id ?? 1) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-8">
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
                <p class="text-[12px] text-gray-500 mb-4">Formatos aceptados: JPG, PNG, WEBP. Tamaño máximo: 5 MB.</p>
                <button type="submit" class="bg-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm hover:bg-blue-600 transition">
                    Guardar foto
                </button>
            </div>
        </form>
    </div>
    <div x-data
HTML;

// Actually wait, let's just use strpos to replace it carefully.
$posStart = strpos($content, '<div class="flex flex-col md:flex-row gap-8">');
$posEnd = strpos($content, '<!-- 3. SECCI');

if ($posStart !== false && $posEnd !== false) {
    $before = substr($content, 0, $posStart);
    $after = substr($content, $posEnd);
    
    $newForm = <<<'HTML'
        <form action="{{ route('companies.update', $company->id ?? 1) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-8">
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
                <p class="text-[12px] text-gray-500 mb-4">Formatos aceptados: JPG, PNG, WEBP. Tamaño máximo: 5 MB.</p>
                <button type="submit" class="bg-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm hover:bg-blue-600 transition">
                    Guardar foto
                </button>
            </div>
        </form>
    </div>

    
HTML;
    $content = $before . $newForm . $after;
    file_put_contents('resources/views/admin/perfil.blade.php', $content);
    echo "Replaced photo section successfully.\n";
} else {
    echo "Could not find photo section.\n";
}

?>
