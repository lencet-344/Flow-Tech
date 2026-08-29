<?php
$content = file_get_contents('resources/views/admin/perfil.blade.php');

$searchUploadRegex = '/<div class="border-2 border-dashed border-gray-200 rounded-xl p-4 flex items-center justify-center gap-3 text-gray-500 bg-gray-50\/50 hover:bg-gray-50 cursor-pointer transition mb-3[^>]*>.*?<svg.*?<\/svg>.*?<span[^>]*>Subir nueva foto<\/span>.*?<\/div>/is';

$replaceUpload = <<<'HTML'
                <label for="logo_upload" class="cursor-pointer block border-2 border-dashed border-gray-200 rounded-xl p-4 flex items-center justify-center gap-3 text-gray-500 bg-gray-50/50 hover:bg-gray-50 transition mb-3">
                    <input type="file" name="logo" id="logo_upload" class="hidden" accept="image/png, image/jpeg, image/webp">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span class="text-sm font-medium">Subir nueva foto</span>
                </label>
HTML;

$content = preg_replace($searchUploadRegex, $replaceUpload, $content);

// Ensure the save button has type="submit"
$content = preg_replace(
    '/<button class="bg-\[#3b82f6\].*?>\s*Guardar foto\s*<\/button>/is',
    '<button type="submit" class="bg-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm hover:bg-blue-600 transition">
                    Guardar foto
                </button>',
    $content
);

file_put_contents('resources/views/admin/perfil.blade.php', $content);
echo "Updated upload box.\n";
?>
