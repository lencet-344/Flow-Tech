<?php
$content = file_get_contents('resources/views/admin/perfil.blade.php');

// Fix "Ver perfil público" button
$searchBtn = <<<'HTML'
            <button class="bg-transparent border border-gray-800 text-[#040116] font-medium px-5 py-2.5 rounded-xl text-sm transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Ver perfil público
            </button>
HTML;
$replaceBtn = <<<'HTML'
            <a href="{{ route('companies.show', $company->id ?? 1) }}" target="_blank" class="bg-transparent border border-gray-800 text-[#040116] font-medium px-5 py-2.5 rounded-xl text-sm transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Ver perfil público
            </a>
HTML;
// Note: Due to character encoding the original file has 'Ver perfil p??blico' or similar, let's use regex.

$content = preg_replace(
    '/<button class="bg-transparent border border-gray-800[^>]*>.*?Ver perfil.*?<\/button>/is',
    '<a href="{{ route(\'companies.show\', $company->id ?? 1) }}" target="_blank" class="bg-transparent border border-gray-800 text-[#040116] font-medium px-5 py-2.5 rounded-xl text-sm transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Ver perfil público
            </a>',
    $content
);

// Fix the file upload label
$searchUpload = <<<'HTML'
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 flex items-center justify-center gap-3 text-gray-500 bg-gray-50/50 hover:bg-gray-50 cursor-pointer transition mb-3 relative overflow-hidden">
                    <input type="file" name="logo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".jpg,.png,.webp">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span class="text-sm font-medium">Subir nueva foto</span>
                </div>
HTML;
$replaceUpload = <<<'HTML'
                <label for="logo_upload" class="cursor-pointer block border-2 border-dashed border-gray-200 rounded-xl p-4 flex items-center justify-center gap-3 text-gray-500 bg-gray-50/50 hover:bg-gray-50 transition mb-3">
                    <input type="file" name="logo" id="logo_upload" class="hidden" accept="image/png, image/jpeg, image/webp">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span class="text-sm font-medium">Subir nueva foto</span>
                </label>
HTML;

$content = str_replace($searchUpload, $replaceUpload, $content);
file_put_contents('resources/views/admin/perfil.blade.php', $content);
echo "Fixed profile upload box and link!\n";
?>
