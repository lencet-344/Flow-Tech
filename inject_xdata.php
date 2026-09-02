<?php
$content = file_get_contents('resources/views/public/profile.blade.php');

$content = str_replace('<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 pb-20">', '<div x-data="{ tab: \'productos\', isFavorite: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 pb-20">', $content);

file_put_contents('resources/views/public/profile.blade.php', $content);
echo "Injected x-data.\n";
?>
