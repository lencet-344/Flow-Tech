<?php
$profile_file = 'resources/views/public/profile.blade.php';
$profile = file_get_contents($profile_file);

// 1. Barra de metadatos
$profile = str_replace(
    '<div class="flex items-center gap-6">',
    '<div class="flex flex-wrap items-center gap-4 md:gap-6">',
    $profile
);

// 2. Botones de pestaas
$profile = preg_replace(
    '/<div class="flex gap-3 mb-8">/',
    '<div class="flex flex-wrap gap-3 mb-8">',
    $profile
);

// 3. Tabla de Productos (Solucin de Scroll Horizontal)
// The structure starts right after: <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
$search_table = '<div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
                <div class="grid grid-cols-6 gap-4 p-4 border-b border-gray-100 text-xs font-bold text-gray-500 tracking-wider">';

$replace_table = '<div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto w-full pb-4 scrollbar-hide">
                    <div class="min-w-[700px] md:min-w-0">
                        <div class="grid grid-cols-6 gap-4 p-4 border-b border-gray-100 text-xs font-bold text-gray-500 tracking-wider">';

$profile = str_replace($search_table, $replace_table, $profile);

// Close the two divs before the end of the products section
// The section ends right before: <!-- PESTAA: RESEAS -->
$search_end = '              </div>
          </div>

          <!-- PESTAA: RESEAS -->';
// Depending on encoding it could be different
$profile = preg_replace(
    '/(\s*)<\/div>\s*<\/div>\s*<!-- PESTA.A: RESE.AS -->/is',
    '$1    </div>
                </div>
            </div>
          </div>

          <!-- PESTAÑA: RESEÑAS -->',
    $profile
);

file_put_contents($profile_file, $profile);
echo "PROFILE OK\n";
?>
