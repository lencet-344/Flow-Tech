<?php
$file = 'resources/views/welcome.blade.php';
$content = file_get_contents($file);

$search = '<button class="bg-white text-[#2563eb] font-bold px-8 py-2.5 rounded-full hover:bg-gray-100 transition duration-300 text-sm shadow-md">
                    Registrar mi negocio
                </button>';

$replace = '<a href="{{ route(\'register\') }}" class="inline-block bg-white text-[#2563eb] font-bold px-8 py-2.5 rounded-full hover:bg-gray-100 transition duration-300 text-sm shadow-md text-center">
                    Registrar mi negocio
                </a>';

// Using str_replace because it's exact, but if there's any carriage returns we can use regex
$regex = '/<button class="bg-white text-\[#2563eb\] font-bold px-8 py-2.5 rounded-full hover:bg-gray-100 transition duration-300 text-sm shadow-md">\s*Registrar mi negocio\s*<\/button>/is';

$content = preg_replace($regex, $replace, $content);

file_put_contents($file, $content);
echo "Button successfully converted to link.\n";
?>
