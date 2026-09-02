<?php
$content = file_get_contents('resources/views/welcome.blade.php');

// Remove Block 1
$content = preg_replace('/<!-- Botonera de.*?<\/section>/s', '', $content);

// In Block 2, find the Buscar button
$old_buscar = '<a href="#" class="bg-[#1F51FF] text-white px-6 py-2.5 rounded-full font-medium flex items-center gap-2 text-sm shadow-sm hover:opacity-90">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Buscar
                </a>';

$new_buscar = '<a href="{{ route(\'products.index\') }}" class="bg-[#1F51FF] text-white px-6 py-2.5 rounded-full font-medium flex items-center gap-2 text-sm shadow-sm hover:opacity-90">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Buscar
                </a>';

$content = str_replace($old_buscar, $new_buscar, $content);

file_put_contents('resources/views/welcome.blade.php', $content);
echo "SUCCESS\n";
?>
