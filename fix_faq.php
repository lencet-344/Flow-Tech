<?php
$welcome = file_get_contents('resources/views/welcome.blade.php');

$startPos = strpos($welcome, '<div class="space-y-5 max-w-3xl mx-auto">');
$endPos = strpos($welcome, '</section>', $startPos);

$newContent = <<<'HTML'
<div class="space-y-5 max-w-3xl mx-auto">
            @php
                $faqList = [
                    [
                        'q' => '¿Cómo funciona SINGKI?',
                        'a' => 'SINGKI es un ecosistema comercial que conecta usuarios con empresas locales. Puedes explorar negocios, buscar productos específicos, guardar tus favoritos y realizar reservas directamente desde nuestra plataforma.'
                    ],
                    [
                        'q' => '¿Cómo busco un negocio?',
                        'a' => 'Puedes usar la barra de búsqueda principal en el inicio o navegar a través de la sección de "Categorías". También puedes explorar el directorio completo desde el menú superior para ver todas las empresas registradas.'
                    ],
                    [
                        'q' => '¿Cómo encuentro un producto?',
                        'a' => 'Escribe el nombre del artículo que necesitas en la barra de búsqueda y presiona "Buscar". El sistema filtrará el inventario de todos los proveedores para mostrarte las mejores coincidencias y su disponibilidad.'
                    ],
                    [
                        'q' => '¿Cómo contacto a un negocio?',
                        'a' => 'Al entrar al perfil de una empresa o ver los detalles de un producto, encontrarás su información de contacto directo (como teléfono y correo), además de botones rápidos para interactuar con ellos.'
                    ],
                    [
                        'q' => '¿Cómo puedo registrar mi negocio?',
                        'a' => 'Para unirte a SINGKI como proveedor, debes crear una cuenta y luego solicitar acceso desde el Panel de Administración, o contactar a nuestro equipo para que activen tu perfil de negocio y puedas subir tu inventario.'
                    ]
                ];
            @endphp

            @foreach($faqList as $faq)
            <div x-data="{ open: false }" class="border border-blue-500 rounded-2xl bg-white overflow-hidden transition-all duration-300">
                <!-- Botón de pregunta -->
                <button @click="open = !open" class="w-full px-8 py-[18px] flex justify-between items-center text-left hover:bg-blue-50/40 transition duration-300 group focus:outline-none">
                    <span class="font-bold text-[#0f172a] text-[15px]">{{ $faq['q'] }}</span>
                    
                    <!-- Ícono animado -->
                    <div class="shrink-0 w-7 h-7 rounded-full border-[2px] border-[#0f172a] flex items-center justify-center text-[#0f172a] group-hover:bg-[#0f172a] group-hover:text-white transition-all duration-300" :class="{'bg-[#0f172a] text-white rotate-180': open}">
                        <!-- Icono + -->
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        <!-- Icono - -->
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"></path>
                        </svg>
                    </div>
                </button>
                
                <!-- Respuesta -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200" 
                     x-transition:enter-start="opacity-0 -translate-y-2" 
                     x-transition:enter-end="opacity-100 translate-y-0" 
                     x-transition:leave="transition ease-in duration-150" 
                     x-transition:leave-start="opacity-100 translate-y-0" 
                     x-transition:leave-end="opacity-0 -translate-y-2" 
                     class="px-8 pb-6 pt-2 text-gray-600 font-light text-sm leading-relaxed" 
                     style="display: none;">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </section>
HTML;

$newWelcome = substr($welcome, 0, $startPos) . $newContent . substr($welcome, $endPos + 10);
file_put_contents('resources/views/welcome.blade.php', $newWelcome);
echo "FAQ updated successfully!\n";
?>
