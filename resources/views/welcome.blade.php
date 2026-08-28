@php
    // ==========================================
    // DATOS TEMPORALES (SIMULANDO BASE DE DATOS)
    // ==========================================
    $categorias = [
        ['nombre' => 'Tecnología', 'icono' => '💻', 'negocios' => 48],
        ['nombre' => 'Alimentos', 'icono' => '☕', 'negocios' => 132],
        ['nombre' => 'Construcción', 'icono' => '🏗️', 'negocios' => 67],
        ['nombre' => 'Salud', 'icono' => '🏥', 'negocios' => 54],
        ['nombre' => 'Moda', 'icono' => '👕', 'negocios' => 89],
        ['nombre' => 'Hogar', 'icono' => '🏠', 'negocios' => 74],
        ['nombre' => 'Servicios', 'icono' => '⚙️', 'negocios' => 103],
        ['nombre' => 'Educación', 'icono' => '📚', 'negocios' => 41],
        ['nombre' => 'Automoción', 'icono' => '🚗', 'negocios' => 56],
        ['nombre' => 'Arte', 'icono' => '🎨', 'negocios' => 29],
    ];

    $negociosDestacados = [
        ['nombre' => 'TechSolutions GT', 'categoria' => 'Tecnología', 'desc' => 'Soluciones tecnológicas para empresas. Hardware y soporte.', 'rating' => 4.8, 'img' => 'https://images.unsplash.com/photo-1519389953888-91237a72c1c6?w=500&q=80', 'premium' => true],
        ['nombre' => 'Distribuidora Alimentos Norte', 'categoria' => 'Alimentos', 'desc' => 'Distribución mayorista de alimentos secos y enlatados.', 'rating' => 4.5, 'img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=500&q=80', 'premium' => false],
        ['nombre' => 'Construcciones Sólidas', 'categoria' => 'Construcción', 'desc' => 'Materiales de construcción, ferretería industrial.', 'rating' => 4.3, 'img' => 'https://images.unsplash.com/photo-1504307651254-35680f356f58?w=500&q=80', 'premium' => false],
        ['nombre' => 'Moda Express', 'categoria' => 'Moda', 'desc' => 'Ropa y accesorios al por mayor. Colecciones para dama y caballero.', 'rating' => 4.6, 'img' => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=500&q=80', 'premium' => true],
    ];

    $faqs = [
        '¿Cómo funciona SINGKI?', '¿Cómo busco un negocio?', '¿Cómo encuentro un producto?', '¿Cómo contacto a un negocio?', '¿Cómo puedo registrar mi negocio?'
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SINGKI - Conectamos negocios') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white selection:bg-[#3b82f6] selection:text-white relative">

    <!-- ========================================== -->
    <!-- SECCIÓN 1: BOTÓN FLOTANTE CHATBOT (Robot)  -->
    <!-- ========================================== -->
    <a href="/chat" class="fixed top-1/2 right-6 lg:right-32 -translate-y-1/2 z-50 bg-[#3b82f6] w-12 h-12 rounded-full shadow-[0_0_15px_rgba(59,130,246,0.5)] flex items-center justify-center hover:scale-110 transition-transform overflow-hidden border border-blue-400/30">
        <!-- Imagen encogida (w-6 h-6) dentro del círculo (w-12 h-12) para ocultar el error del recorte -->
        <img src="{{ asset('images/Robot.png') }}" alt="Chatbot" class="w-6 h-6 object-contain">
    </a>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 2: NAVBAR                          -->
    <!-- ========================================== -->
    <header class="bg-white sticky top-0 z-40 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto">
                    <span class="font-black text-2xl text-[#3b82f6] tracking-tight">SINGKI</span>
                </a>
            </div>
            
            <nav class="hidden md:flex space-x-10">
                <a href="#" class="text-[#0f172a] font-medium text-base hover:text-[#3b82f6] transition">Inicio</a>
                <a href="#" class="text-[#0f172a] font-medium text-base hover:text-[#3b82f6] transition">Categorías</a>
                <a href="#" class="text-[#0f172a] font-medium text-base hover:text-[#3b82f6] transition">Explorar</a>
            </nav>
            
            <div class="hidden md:flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Ir al Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#3b82f6] text-white px-6 py-2.5 rounded-lg font-medium text-base hover:bg-[#2563eb] transition shadow-sm">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 3: HERO SECTION (Fondo Azul)       -->
    <!-- ========================================== -->
    <section class="bg-gradient-to-r from-[#0a194f] via-[#163080] to-[#2563eb] pt-20 pb-28 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
            
            <div class="lg:col-span-7 z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#3b82f6]/30 text-blue-100 text-xs font-semibold mb-6 border border-blue-400/40 backdrop-blur-md">
                    Conectamos negocios con oportunidades 
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </div>
                <h1 class="text-5xl lg:text-[3.5rem] leading-[1.1] font-extrabold text-white mb-6 tracking-tight">
                    Encuentra lo que tu negocio <br>
                    <span class="text-[#38bdf8]">necesita, aquí y ahora.</span>
                </h1>
                <p class="text-lg text-blue-100/90 mb-10 max-w-lg font-light leading-relaxed">
                    Te ayudamos a que encuentres lo que necesites de forma rápida y confiable. Negocios, proveedores, productos y servicios en un solo lugar.
                </p>
                
                <div class="bg-white p-1 rounded-full flex items-center max-w-xl shadow-lg mt-8">
                    <input type="text" placeholder="Busca negocios, productos o servicios..." class="w-full pl-6 pr-4 bg-transparent border-none focus:ring-0 text-gray-500 text-sm outline-none">
                    <button class="bg-[#3b82f6] hover:bg-[#2563eb] text-white font-semibold px-6 py-2 rounded-full transition text-sm whitespace-nowrap">Buscar</button>
                </div>
            </div>

            <div class="lg:col-span-5 relative z-10 hidden lg:flex justify-end pr-10">
                <div class="w-[380px] relative drop-shadow-2xl">
                    <img src="{{ asset('images/ChicaSonriendo.png') }}" alt="Chica Emprendedora" class="w-full h-auto object-contain">
                </div>
            </div>
            
        </div>
    </section>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 4: CATEGORÍAS                      -->
    <!-- ========================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 bg-white">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-[32px] font-extrabold text-[#0f172a] mb-2 tracking-tight">Explorar por categoría</h2>
                <p class="text-[#3b82f6] font-medium text-sm">Encuentra negocios y proveedores según lo que necesitas</p>
            </div>
            <a href="#" class="text-[#3b82f6] font-medium hover:underline flex items-center gap-2 text-sm">Ver todas <span aria-hidden="true">&rarr;</span></a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
            
            <!-- 1. Tecnología -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 14h16M4 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM8 18h8M12 18v3M8 21h8"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Tecnología</h3>
                <p class="text-[13px] text-[#3b82f6]">48 negocios</p>
            </div>

            <!-- 2. Alimentos -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8h12v7a5 5 0 01-5 5H9a5 5 0 01-5-5V8zM16 10h1.5a2.5 2.5 0 012.5 2.5v0a2.5 2.5 0 01-2.5 2.5H16M6 4h8"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Alimentos</h3>
                <p class="text-[13px] text-[#3b82f6]">132 negocios</p>
            </div>

            <!-- 3. Construcción -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h11v12H3V5z M14 8h4l3 4v5h-7V8z M7 17a2 2 0 1 0 0 4 2 2 0 0 0 0-4z M17 17a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Construcción</h3>
                <p class="text-[13px] text-[#3b82f6]">67 negocios</p>
            </div>

            <!-- 4. Salud -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 3h4v7h7v4h-7v7h-4v-7H3v-4h7V3z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Salud</h3>
                <p class="text-[13px] text-[#3b82f6]">54 negocios</p>
            </div>

            <!-- 5. Moda (Camiseta Simple Corregida) -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M9 4c0 2.5 6 2.5 6 0h2.5l4 2.5-2 3.5-3-1.5v12h-9v-12l-3 1.5-2-3.5 4-2.5H9z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Moda</h3>
                <p class="text-[13px] text-[#3b82f6]">89 negocios</p>
            </div>

            <!-- 6. Hogar -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z M9 22V12h6v10"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Hogar</h3>
                <p class="text-[13px] text-[#3b82f6]">74 negocios</p>
            </div>

            <!-- 7. Servicios -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Servicios</h3>
                <p class="text-[13px] text-[#3b82f6]">103 negocios</p>
            </div>

            <!-- 8. Educación -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Educación</h3>
                <p class="text-[13px] text-[#3b82f6]">41 negocios</p>
            </div>

            <!-- 9. Automoción -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2 M7 17a2 2 0 1 0 0 4 2 2 0 0 0 0-4z M17 17a2 2 0 1 0 0 4 2 2 0 0 0 0-4z M7 17h10"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Automoción</h3>
                <p class="text-[13px] text-[#3b82f6]">56 negocios</p>
            </div>

            <!-- 10. Arte -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 1 0-18 9 9 0 0 1 9 9c0 1.5-1 2-2 2h-1c-1 0-2 1-2 2s1 2 1 3c0 1.1-.9 2-2 2z M7 9h.01 M10 6h.01 M14 6h.01 M17 9h.01"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Arte</h3>
                <p class="text-[13px] text-[#3b82f6]">29 negocios</p>
            </div>

            <!-- 11. Deporte -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18M7.5 4.2c2.5 3 2.5 12.6 0 15.6M16.5 4.2c-2.5 3-2.5 12.6 0 15.6"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Deporte</h3>
                <p class="text-[13px] text-[#3b82f6]">63 negocios</p>
            </div>

            <!-- 12. Belleza -->
            <div class="bg-white border border-gray-200 rounded-[16px] py-8 px-4 text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-[#3b82f6] transition duration-300 cursor-pointer group flex flex-col items-center">
                <div class="mb-4 text-[#2563eb] group-hover:-translate-y-1 transition duration-300">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M8.5 3.5c1.5 2 5.5 2 7 0l2 5.5-3.5 3h-4l-3.5-3z" />
                        <path d="M10 12l-4 9h12l-4-9" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Belleza</h3>
                <p class="text-[13px] text-[#3b82f6]">71 negocios</p>
            </div>

        </div>
    </section>
    <!-- ========================================== -->

   <!-- ========================================== -->
    <!-- SECCIÓN 5: CÓMO FUNCIONA                   -->
    <!-- ========================================== -->
    <!-- Fondo celeste ligeramente más marcado (bg-[#ebf4ff]) -->
    <section class="bg-[#ebf4ff] py-28 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            
            <span class="px-5 py-1.5 rounded-full border border-[#3b82f6] text-[#3b82f6] text-[11px] font-bold tracking-[0.15em] uppercase mb-6 inline-block bg-transparent">Simple y rápido</span>
            
            <h2 class="text-4xl lg:text-5xl font-extrabold text-[#0f172a] mb-4 tracking-tight">¿Cómo funciona SINGKI?</h2>
            <p class="text-gray-600 text-lg mb-20 font-light">En tres simples pasos encuentra lo que tu negocio necesita</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Tarjeta 1 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] text-left flex flex-col h-full border border-gray-50">
                    <div class="flex justify-between items-start mb-10">
                        <span class="text-[5.5rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2563eb] to-[#7dd3fc] leading-none tracking-tighter">01</span>
                        <div class="w-14 h-14 bg-[#2563eb] rounded-2xl flex items-center justify-center text-white shadow-md">
                           <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <h3 class="text-xl font-bold text-[#0f172a] mb-3">Busca o explora</h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed font-light mb-10">Usa la búsqueda o explora las categorías para encontrar lo que necesitas.</p>
                        <div class="w-full h-px bg-gradient-to-r from-blue-200 to-transparent"></div>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] text-left flex flex-col h-full border border-gray-50">
                    <div class="flex justify-between items-start mb-10">
                        <span class="text-[5.5rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2563eb] to-[#7dd3fc] leading-none tracking-tighter">02</span>
                        <div class="w-14 h-14 bg-[#2563eb] rounded-2xl flex items-center justify-center text-white shadow-md">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z M9 16l2 2 4-4"></path></svg>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <h3 class="text-xl font-bold text-[#0f172a] mb-3">Consulta y compara</h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed font-light mb-10">Revisa perfiles, disponibilidad de stock, precios, reseñas y toda la información necesaria antes de elegir.</p>
                        <div class="w-full h-px bg-gradient-to-r from-blue-200 to-transparent"></div>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] text-left flex flex-col h-full border border-gray-50">
                    <div class="flex justify-between items-start mb-10">
                        <span class="text-[5.5rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2563eb] to-[#7dd3fc] leading-none tracking-tighter">03</span>
                        <div class="w-14 h-14 bg-[#2563eb] rounded-2xl flex items-center justify-center text-white shadow-md">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <h3 class="text-xl font-bold text-[#0f172a] mb-3">Conecta</h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed font-light mb-10">Contacta directamente al negocio, proveedor o prestador y realiza la acción correspondiente, como reservar productos agotados o establecer una conexión.</p>
                        <div class="w-full h-px bg-gradient-to-r from-blue-200 to-transparent"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ========================================== -->

   <!-- ========================================== -->
    <!-- SECCIÓN 6: NEGOCIOS DESTACADOS             -->
    <!-- ========================================== -->
    @php
        $negociosFigma = [
            [
                'nombre' => 'TechSolutions GT', 'categoria' => 'Tecnología', 
                'desc' => 'Soluciones tecnológicas para empresas. Hardware, software y soporte técnico especializado.', 
                'rating' => '4.8', 'reviews' => '124', 
                'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80', 
                'premium' => true
            ],
            [
                'nombre' => 'Distribuidora Alimentos Norte', 'categoria' => 'Alimentos', 
                'desc' => 'Distribución mayorista de alimentos secos, enlatados y productos de limpieza a nivel nacional.', 
                'rating' => '4.5', 'reviews' => '89', 
                'img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=500&q=80', 
                'premium' => false
            ],
            [
                'nombre' => 'Construcciones Sólidas', 'categoria' => 'Construcción', 
                'desc' => 'Materiales de construcción, ferretería industrial y herramientas profesionales.', 
                'rating' => '4.3', 'reviews' => '57', 
                /* NUEVO ENLACE 100% FUNCIONAL DE CONSTRUCCIÓN */
                'img' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=500&q=80', 
                'premium' => false
            ],
            [
                'nombre' => 'Moda Express', 'categoria' => 'Moda', 
                'desc' => 'Ropa y accesorios al por mayor. Colecciones para dama, caballero y niños.', 
                'rating' => '4.6', 'reviews' => '201', 
                'img' => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=500&q=80', 
                'premium' => true
            ],
        ];
    @endphp

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 bg-white">
        <!-- Encabezado de la sección -->
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-[#0f172a] mb-2 tracking-tight">Negocios destacados</h2>
                <p class="text-gray-500 font-light text-sm">Proveedores verificados con los mejores productos y servicios</p>
            </div>
            <a href="#" class="text-[#3b82f6] font-medium hover:underline flex items-center gap-2 text-sm">Ver todos <span aria-hidden="true">&rarr;</span></a>
        </div>
        
        <!-- Cuadrícula de 4 tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($negociosFigma as $negocio)
            <!-- Borde índigo muy fino (border-[#818cf8]) como en el Figma -->
            <div class="bg-white border border-[#818cf8] rounded-[16px] overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition duration-300 group flex flex-col relative">
                
                @if($negocio['premium'])
                    <!-- Etiqueta PREMIUM Morada -->
                    <div class="absolute top-4 left-4 bg-[#8b5cf6] text-white text-[10px] font-bold px-3 py-1.5 rounded-md z-10 flex items-center gap-1 shadow-sm tracking-wide">
                        <span class="text-yellow-300 text-xs">★</span> PREMIUM
                    </div>
                @endif
                
                <!-- Imagen -->
                <div class="h-44 w-full overflow-hidden relative bg-gray-100">
                    <img src="{{ $negocio['img'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
                
                <!-- Contenido de la Tarjeta -->
                <div class="p-5 flex flex-col flex-grow">
                    
                    <!-- Título y Verificado -->
                    <div class="flex justify-between items-start gap-2 mb-3">
                        <h3 class="font-bold text-gray-900 text-[15px] leading-tight">{{ $negocio['nombre'] }}</h3>
                        <span class="shrink-0 inline-flex items-center gap-1 bg-[#dcfce7] text-[#16a34a] px-2 py-0.5 rounded text-[10px] font-bold border border-green-200">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            Verificado
                        </span>
                    </div>
                    
                    <!-- Pastilla de Categoría Celeste -->
                    <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[11px] font-medium px-3 py-1 rounded-full mb-3 self-start">
                        {{ $negocio['categoria'] }}
                    </span>
                    
                    <!-- Descripción -->
                    <p class="text-gray-500 text-[12px] mb-6 flex-grow leading-relaxed">
                        {{ $negocio['desc'] }}
                    </p>
                    
                    <!-- Footer: Rating y Ubicación -->
                    <div class="flex justify-between items-center mt-auto pt-1">
                        <div class="flex items-center gap-1 text-[13px]">
                            <span class="text-yellow-400 text-sm">★</span> 
                            <span class="font-bold text-gray-900">{{ $negocio['rating'] }}</span> 
                            <span class="text-gray-400 font-light text-[12px]">({{ $negocio['reviews'] }})</span>
                        </div>
                        <span class="text-[12px] text-[#fb923c] font-medium">Estelí</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 7: BANNER CALL TO ACTION           -->
    <!-- ========================================== -->
    <section class="bg-gradient-to-r from-[#46a8ff] to-[#2b5bf4] text-white">
        <!-- Redujimos el padding vertical (py-16 en lugar de py-24) para hacerlo menos alto -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            
            <!-- Columna Izquierda -->
            <div>
                <!-- Etiqueta superior delgada y transparente -->
                <span class="border border-white/40 rounded-full px-4 py-1 text-[10px] font-semibold tracking-wide uppercase mb-6 inline-block text-white/90">
                    Para emprendedores y proveedores
                </span>
                
                <h2 class="text-3xl lg:text-4xl font-extrabold mb-4 tracking-tight">Impulsa tu negocio con SINGKI</h2>
                
                <p class="mb-6 text-white/90 text-sm font-light leading-relaxed max-w-md">
                    Registra tu negocio, publica tu catálogo de productos o servicios, gestiona tu inventario y conecta con clientes que están buscando exactamente lo que tú ofreces.
                </p>
                
                <!-- Lista con checks de SVG sutiles y menos espaciado (mb-8 en lugar de mb-12) -->
                <ul class="space-y-3 mb-8 text-[13px] font-light text-white/90">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> 
                        Perfil de negocio visible para miles de clientes
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> 
                        Gestión de inventario y stock en tiempo real
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> 
                        Sistema de reservas para productos agotados
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> 
                        Chat directo con tus clientes
                    </li>
                </ul>
                
                <!-- Botón más compacto -->
                <button class="bg-white text-[#2563eb] font-bold px-8 py-2.5 rounded-full hover:bg-gray-100 transition duration-300 text-sm shadow-md">
                    Registrar mi negocio
                </button>
            </div>
            
            <!-- Columna Derecha: Tarjetas Transparentes con bordes finos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Tarjeta 1: Caja (Gestión de inventario) -->
                <div class="border border-white/30 rounded-[12px] p-5 hover:border-white/60 transition">
                    <svg class="w-6 h-6 text-white mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7.5v9l-8 4.5-8-4.5v-9l8-4.5 8 4.5zM12 12l8-4.5M12 12v9M12 12L4 7.5"></path>
                    </svg>
                    <h4 class="font-bold mb-1 text-[14px] leading-tight text-white">Gestión de inventario</h4>
                    <p class="text-[11px] text-white/70 font-light">Controla stock y disponibilidad</p>
                </div>

                <!-- Tarjeta 2: Usuarios (Conexión clientes) -->
                <div class="border border-white/30 rounded-[12px] p-5 hover:border-white/60 transition">
                    <svg class="w-6 h-6 text-white mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <h4 class="font-bold mb-1 text-[14px] leading-tight text-white">Conexión con clientes</h4>
                    <p class="text-[11px] text-white/70 font-light">Chat y contacto directo</p>
                </div>

                <!-- Tarjeta 3: Flecha (Visibilidad) -->
                <div class="border border-white/30 rounded-[12px] p-5 hover:border-white/60 transition">
                    <svg class="w-6 h-6 text-white mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <h4 class="font-bold mb-1 text-[14px] leading-tight text-white">Visibilidad</h4>
                    <p class="text-[11px] text-white/70 font-light">Perfil público completo</p>
                </div>

                <!-- Tarjeta 4: Campana (Notificaciones) -->
                <div class="border border-white/30 rounded-[12px] p-5 hover:border-white/60 transition">
                    <svg class="w-6 h-6 text-white mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <h4 class="font-bold mb-1 text-[14px] leading-tight text-white">Notificaciones</h4>
                    <p class="text-[11px] text-white/70 font-light">Alertas de reservas y pedidos</p>
                </div>

            </div>
        </div>
    </section>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 8: EXPERIENCIAS COMUNIDAD          -->
    <!-- ========================================== -->
    <section class="max-w-7xl mx-auto px-4 py-24 text-center bg-[#f8fafc] overflow-hidden">
        
        <!-- Encabezado -->
        <span class="px-5 py-1.5 rounded-full border border-blue-200 text-[#2563eb] text-[10px] font-bold tracking-[0.2em] uppercase mb-8 inline-block bg-transparent shadow-sm">COMUNIDAD SINGKI</span>
        <h2 class="text-4xl lg:text-5xl font-extrabold text-[#0f172a] mb-5 tracking-tight">Experiencias de nuestra comunidad</h2>
        <p class="text-gray-500 text-[15px] mb-16 font-light max-w-xl mx-auto leading-relaxed">Clientes, emprendedores y proveedores que ya confían en SINGKI para hacer crecer sus negocios.</p>
        
        <!-- Contenedor del Carrusel Falso (Visual) -->
        <div class="flex justify-center items-center gap-6 lg:gap-10 mb-12 relative w-full max-w-[1200px] mx-auto">
            
            <!-- Tarjeta Izquierda (Atenuada) -->
            <div class="hidden lg:block w-[300px] bg-[#2563eb] rounded-[32px] overflow-hidden opacity-40 scale-90 blur-[1px] select-none pointer-events-none">
                <div class="h-48 relative">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&q=80" class="w-full h-full object-cover grayscale">
                </div>
                <div class="p-6 text-left text-white h-48">
                    <div class="text-yellow-400 text-sm mb-3">★★★★★</div>
                    <p class="mb-4 font-light text-blue-50 text-[12px] line-clamp-3">"Encontré exactamente lo que necesitaba en minutos. SINGKI me conectó con un proveedor confiable que..."</p>
                    <div>
                        <p class="font-bold text-[13px]">María González</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Central (Activa y Principal) -->
            <div class="w-full max-w-[380px] bg-[#2563eb] rounded-[32px] overflow-hidden shadow-[0_20px_50px_rgba(37,99,235,0.3)] relative z-10 transition-transform duration-300">
                <div class="h-64 relative">
                    <!-- Foto principal -->
                    <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?w=500&q=80" class="w-full h-full object-cover">
                    <!-- Etiqueta sobre la foto -->
                    <div class="absolute bottom-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider border border-white/10">Emprendedor</div>
                </div>
                <div class="p-8 text-left text-white">
                    <div class="text-yellow-400 text-lg mb-4 tracking-widest">★★★★★</div>
                    <p class="mb-6 font-light leading-relaxed text-blue-50 text-[14px]">"Registré mi negocio en SINGKI y en la primera semana ya tenía consultas de clientes reales. La plataforma es intuitiva, profesional y le da visibilidad real a mi emprendimiento."</p>
                    <div>
                        <p class="font-bold text-[15px]">Carlos Pérez</p>
                        <p class="text-[12px] text-blue-200 font-light mt-0.5">Estelí, Nicaragua</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Derecha (Atenuada) -->
            <div class="hidden lg:block w-[300px] bg-[#2563eb] rounded-[32px] overflow-hidden opacity-40 scale-90 blur-[1px] select-none pointer-events-none">
                <div class="h-48 relative">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80" class="w-full h-full object-cover grayscale">
                </div>
                <div class="p-6 text-left text-white h-48">
                    <div class="text-yellow-400 text-sm mb-3">★★★★★</div>
                    <p class="mb-4 font-light text-blue-50 text-[12px] line-clamp-3">"El panel de administración es muy completo. Puedo gestionar mi inventario, ver reservas y chatear con..."</p>
                    <div>
                        <p class="font-bold text-[13px]">Ana Rodríguez</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles del Carrusel (Flechas y Puntos) -->
        <div class="flex items-center justify-center gap-6 mb-16">
            <!-- Flecha Izquierda -->
            <button class="w-10 h-10 rounded-full border-2 border-[#3b82f6] flex items-center justify-center text-[#3b82f6] hover:bg-[#3b82f6] hover:text-white transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <!-- Puntos de navegación -->
            <div class="flex items-center gap-2.5">
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-6 h-2 rounded-full bg-[#2563eb]"></div> <!-- Activo -->
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
            </div>
            
            <!-- Flecha Derecha -->
            <button class="w-10 h-10 rounded-full border-2 border-[#3b82f6] flex items-center justify-center text-[#3b82f6] hover:bg-[#3b82f6] hover:text-white transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>

        <!-- Divisor sutil -->
        <div class="max-w-4xl mx-auto h-px bg-gradient-to-r from-transparent via-blue-200 to-transparent mb-16"></div>

        <!-- Estadísticas -->
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Estadística 1 -->
            <div>
                <div class="text-[40px] font-extrabold text-[#0f172a] mb-1 tracking-tight">1,200<span class="text-[#2563eb] font-black">+</span></div>
                <div class="text-[13px] text-[#3b82f6] font-medium">Negocios registrados</div>
            </div>
            <!-- Estadística 2 -->
            <div>
                <div class="text-[40px] font-extrabold text-[#0f172a] mb-1 tracking-tight">8,500<span class="text-[#2563eb] font-black">+</span></div>
                <div class="text-[13px] text-[#3b82f6] font-medium">Usuarios activos</div>
            </div>
            <!-- Estadística 3 -->
            <div>
                <div class="text-[40px] font-extrabold text-[#0f172a] mb-1 tracking-tight flex items-center justify-center gap-1">
                    4.9 <span class="text-[#2563eb] text-3xl -mt-1">★</span>
                </div>
                <div class="text-[13px] text-[#3b82f6] font-medium">Calificación promedio</div>
            </div>
        </div>
        
    </section>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 9: PREGUNTAS FRECUENTES            -->
    <!-- ========================================== -->
    <section class="max-w-4xl mx-auto px-4 py-24 text-center">
        <h2 class="text-4xl lg:text-5xl font-extrabold text-[#0f172a] mb-4 tracking-tight">Preguntas frecuentes</h2>
        <p class="text-gray-500 text-lg mb-14 font-light">Respuestas a las dudas más comunes sobre SINGKI</p>
        
        <!-- Redujimos el ancho a max-w-3xl para que no queden tan estiradas y se vean como en Figma -->
        <div class="space-y-5 max-w-3xl mx-auto">
            @foreach($faqs as $faq)
            <!-- Borde azul fijo y sin sombras para hacer match exacto con Figma -->
            <div class="border border-[#2563eb] rounded-full px-8 py-[18px] flex justify-between items-center cursor-pointer hover:bg-blue-50/40 transition duration-300 text-left bg-white group">
                <span class="font-bold text-[#0f172a] text-[15px]">{{ $faq }}</span>
                
                <!-- Ícono de círculo y cruz con trazo negro definido -->
                <div class="shrink-0 w-7 h-7 rounded-full border-[2px] border-[#0f172a] flex items-center justify-center text-[#0f172a] group-hover:bg-[#0f172a] group-hover:text-white transition duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 10: FOOTER FINAL                   -->
    <!-- ========================================== -->
    <section>
        <!-- Bloque CTA (Fondo Blanco) -->
        <div class="bg-white py-24 text-center border-t border-gray-50">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-[#2563eb] mb-4 tracking-tight">¿Listo para empezar?</h2>
            <p class="text-[#3b82f6] text-[15px] font-light mb-10 max-w-2xl mx-auto">Únete a la plataforma que conecta negocios con oportunidades.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-[#2563eb] text-white font-bold px-8 py-3 rounded-xl hover:bg-[#1d4ed8] transition shadow-sm text-[15px]">Crear cuenta gratis</button>
                <button class="bg-white border border-[#2563eb] text-[#2563eb] font-bold px-8 py-3 rounded-xl hover:bg-blue-50 transition text-[15px]">Explorar negocios</button>
            </div>
        </div>

        <!-- Footer (Fondo ajustado EXACTAMENTE al código de la paleta oficial: #00003d) -->
        <footer class="bg-[#00003d] pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                    
                    <!-- Columna de Logo -->
                    <div class="md:col-span-4">
                        <div class="mb-6">
                            <!-- Tu logo intacto, ahora sí se camuflará perfectamente con el fondo -->
                            <img src="{{ asset('images/LogoAzul.png') }}" alt="SINGKI" class="h-10 w-auto">
                        </div>
                    </div>

                    <!-- Columnas de Enlaces -->
                    <div class="md:col-span-2">
                        <h4 class="text-[#7dd3fc] font-bold mb-6 text-[15px] tracking-wide">Plataforma</h4>
                        <ul class="space-y-4 text-[14px] text-[#cbd5e1] font-light">
                            <li><a href="#" class="hover:text-white transition">Categorías</a></li>
                            <li><a href="#" class="hover:text-white transition">Explorar negocios</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white transition">Iniciar sesión</a></li>
                        </ul>
                    </div>
                    
                    <div class="md:col-span-3">
                        <h4 class="text-[#7dd3fc] font-bold mb-6 text-[15px] tracking-wide">Para negocios</h4>
                        <ul class="space-y-4 text-[14px] text-[#cbd5e1] font-light">
                            <li><a href="{{ route('register') }}" class="hover:text-white transition">Registrar mi negocio</a></li>
                            <li><a href="#" class="hover:text-white transition">Administración</a></li>
                        </ul>
                    </div>
                    
                    <div class="md:col-span-3">
                        <h4 class="text-[#7dd3fc] font-bold mb-6 text-[15px] tracking-wide">Ayuda</h4>
                        <ul class="space-y-4 text-[14px] text-[#cbd5e1] font-light">
                            <li><a href="#" class="hover:text-white transition">Centro de ayuda</a></li>
                            <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                            <li><a href="#" class="hover:text-white transition">Términos de uso</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Barra Inferior de Copyright y Redes -->
                <div class="border-t border-[#7dd3fc]/20 pt-8 flex flex-col md:flex-row justify-between items-center text-[13px] text-[#cbd5e1] font-light">
                    <p class="mb-6 md:mb-0">© 2026 SINGKI. Todos los derechos reservados.</p>
                    
                    <div class="flex items-center gap-6">
                        <span class="hidden sm:inline-block mr-2">Encuéntranos en</span>
                        
                        <!-- Youtube (Ajustado al azul celeste #7dd3fc) -->
                        <a href="#" class="text-[#7dd3fc] hover:text-white transition flex items-center gap-2 group">
                            <svg class="w-5 h-5 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 29 29 0 00-.46-5.33z"></path><polygon stroke-width="1.5" stroke-linejoin="round" points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                            Youtube
                        </a>
                        
                        <!-- Instagram (Ajustado al azul celeste #7dd3fc) -->
                        <a href="#" class="text-[#7dd3fc] hover:text-white transition flex items-center gap-2 group">
                            <svg class="w-5 h-5 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            Instagram
                        </a>

                        <!-- TikTok (Ajustado al azul celeste #7dd3fc) -->
                        <a href="#" class="text-[#7dd3fc] hover:text-white transition flex items-center gap-2 group">
                            <svg class="w-5 h-5 transition" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M15 2a3 3 0 0 1 3 3 3 3 0 0 0 3 3v2a5 5 0 0 1-5-5V2h-3v14a4 4 0 1 1-4-4 4.04 4.04 0 0 1 1 .13V8.42A6 6 0 0 0 8 8a6 6 0 1 0 6 6V2Z"></path>
                            </svg>
                            TikTok
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <!-- ========================================== -->
</body>
</html>