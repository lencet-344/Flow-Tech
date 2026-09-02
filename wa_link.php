<?php
$file = 'resources/views/public/profile.blade.php';
$content = file_get_contents($file);

// Ensure we find the Consultar button inside the forelse loop
$search = '<button class="border border-[#2563eb] text-[#2563eb] hover:bg-blue-50 text-xs font-semibold px-5 py-2 rounded-lg transition-colors">Consultar</button>';

$replace = '<a href="https://wa.me/{{ preg_replace(\'/[^0-9]/\', \'\', $company->telephone ?? \'\') }}?text={{ urlencode(\'Hola, vi tu perfil en SINGKI. Me interesa consultar sobre el producto: \' . ($item->product->name ?? \'Producto\')) }}" target="_blank" class="inline-block border border-[#2563eb] text-[#2563eb] hover:bg-blue-50 text-xs font-semibold px-5 py-2 rounded-lg transition-colors text-center">Consultar</a>';

$content = str_replace($search, $replace, $content);

file_put_contents($file, $content);
echo "Consultar button transformed to intelligent WhatsApp link.\n";
?>
