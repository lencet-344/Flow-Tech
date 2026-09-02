<?php
$filepath = 'resources/views/welcome.blade.php';
$content = file_get_contents($filepath);

$new_grid = <<<'EOT'
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach($categorias as $cat)
            <!-- Envolvemos la tarjeta en un enlace con la variable de categoría -->
            <a href="{{ url('/explorar?categoria=' . $cat['nombre']) }}" class="bg-white border border-gray-100 rounded-[20px] p-8 text-center hover:shadow-lg hover:border-blue-100 transition duration-300 cursor-pointer group flex flex-col items-center block">
                <div class="text-[40px] mb-4 text-[#2563eb] group-hover:-translate-y-2 transition duration-300">{{ $cat['icono'] ?? '≡' }}</div>
                <h3 class="font-bold text-gray-900 text-base">{{ $cat['nombre'] }}</h3>
                <p class="text-xs text-[#2563eb] mt-2 font-medium">{{ $cat['negocios'] ?? 0 }} negocios</p>
            </a>
            @endforeach
        </div>
EOT;

// I need to replace the <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6"> block in Section 3.
$pattern = '/<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">.*?<\/div>\s*<\/div>\s*<\/section>/s';
$replacement = $new_grid . "\n        </div>\n    </section>";
$content = preg_replace($pattern, $replacement, $content, 1);

file_put_contents($filepath, $content);
echo "REPLACED WELCOME GRID\n";
?>
