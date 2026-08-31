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
    <!-- CHATBOT FLOTANTE Y MODAL DE AYUDA          -->
    <!-- ========================================== -->
    <div class="fixed top-32 right-6 lg:right-12 z-50 flex flex-col items-end">
        
        <!-- Botón Toggle Principal (Arriba del modal) -->
        <button id="btn-chat-toggle" class="bg-[#2563eb] w-14 h-14 rounded-full shadow-xl shadow-blue-500/30 flex items-center justify-center hover:scale-105 transition-all duration-300 focus:outline-none z-50 relative">
            <!-- Ícono Cerrado (Imagen de tu robot) -->
            <img id="chat-icon-robot" src="{{ asset('images/Robot.png') }}" alt="Robot KI" class="w-8 h-8 object-contain transition-opacity duration-300">
            <!-- Ícono Abierto (X blanca) - Oculto por defecto -->
            <svg id="chat-icon-x" class="w-6 h-6 text-white absolute inset-0 m-auto opacity-0 scale-50 transition-all duration-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Ventana Modal del Chat (Despliega hacia abajo con mt-4) -->
        <div id="chat-modal" class="hidden w-[340px] bg-white rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden mt-4 transition-all duration-300 transform origin-top-right opacity-0 scale-95">
            
            <!-- Cabecera Azul Horizontal -->
            <div class="bg-[#2563eb] text-white px-5 py-3.5 flex justify-between items-center">
                <span class="font-semibold text-[14px] tracking-wide">Centro de Ayuda SINGKI</span>
                <button id="close-chat-modal" class="text-white hover:text-gray-200 transition-colors focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <!-- Cuerpo del Chat -->
            <div class="p-5 bg-white overflow-y-auto max-h-96">
                
                <!-- Mensaje del Bot (KI) -->
                <div class="flex gap-4 items-start mb-6">
                    <!-- Ícono Cuadrado Azul -->
                    <div class="w-12 h-12 bg-[#2563eb] rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <!-- Burbuja de texto gris muy suave -->
                    <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl rounded-tl-sm w-full">
                        <h4 class="text-[#2563eb] font-bold text-[14px] mb-1">Hola, soy Ki</h4>
                        <p class="text-gray-500 text-[13px] leading-relaxed font-light">Enviaré tu pregunta al administrador de SINGKI. Pronto recibirás una respuesta para ayudarte con tu consulta.</p>
                    </div>
                </div>
                
                <!-- Formulario -->
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-2">Escribe tu consulta</label>
                    <textarea id="ki-input" class="w-full text-[13px] border border-gray-200 rounded-xl p-3 focus:ring-[#2563eb] focus:border-[#2563eb] outline-none resize-none placeholder-gray-400 font-light" rows="3" placeholder="¿En qué podemos ayudarte? Escribe tu pregunta aquí..."></textarea>
                    
                    <!-- Botón Enviar (Gris claro) -->
                    <button id="ki-send-btn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-xl transition-colors w-full shadow-sm mt-3">Enviar consulta</button>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-white px-4 py-3 border-t border-gray-50 text-center">
                <span class="text-[11px] text-gray-400 font-light">SINGKI · Conectamos negocios con oportunidades</span>
            </div>
        </div>
    </div>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 2: NAVBAR                          -->
    <!-- ========================================== -->
    <header x-data="{ mobileMenuOpen: false }" class="bg-white sticky top-0 z-40 border-b border-gray-100 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            
            <div class="flex items-center gap-2">
                <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto">
                    <span class="font-black text-2xl text-[#3b82f6] tracking-tight">SINGKI</span>
                </a>
            </div>
            
            <!-- Enlaces centrales -->
            <nav class="hidden md:flex space-x-10 items-center">
                <a href="{{ url('/') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Inicio</a>
                
                <!-- Botón de ancla hacia la sección inferior -->
                <a href="#categorias" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Categorías</a>
                
                <!-- Solo visible para invitados (sin sesión) -->
                @guest
                    <a href="{{ route('categories.index') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Explorar</a>
                @endguest
            </nav>
            <!-- Botón Menú Móvil -->
            <div class="flex md:hidden items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            
            <div class="hidden md:flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        @php
                            $superAdmins = ['isaacmeneses254@gmail.com', 'edmundo@ejemplo.com', 'admin@sinki.com'];
                        @endphp
                        
                        @if(in_array(Auth::user()->email, $superAdmins))
                            <!-- Botón para Isaac y Edmundo -->
                            <a href="{{ url('/superadmin/dashboard') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Panel Super Admin</a>
                        @else
                            <!-- Botón para Proveedores normales -->
                            <a href="{{ url('/admin/dashboard') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Administrar negocio</a>
                        @endif

                        <!-- Botón de Cerrar Sesión -->
                        <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                            @csrf
                            <button type="submit" class="bg-[#A6F4EB] hover:bg-[#8de8df] text-[#040116] font-semibold px-6 py-2 rounded-full transition-colors shadow-sm text-[14px]">
                                Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#3b82f6] text-white px-6 py-2.5 rounded-lg font-medium text-base hover:bg-[#2563eb] transition shadow-sm">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
            <!-- Menú Móvil Desplegable -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition class="md:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-gray-100 flex flex-col p-4 gap-4 z-50">
            <a href="{{ url('/') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb]">Inicio</a>
            <a href="#categorias" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb]">Categorías</a>
            @guest
                <a href="{{ route('categories.index') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb]">Explorar</a>
                <hr class="border-gray-100">
                <a href="{{ route('login') }}" class="text-[#3b82f6] font-medium text-base">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-[#3b82f6] text-white px-6 py-2.5 rounded-lg font-medium text-center text-base shadow-sm block">Registrarse</a>
                @endif
            @endguest
            @auth
                <hr class="border-gray-100">
                @php
                    $superAdmins = ['isaacmeneses254@gmail.com', 'edmundo@ejemplo.com'];
                @endphp
                @if(in_array(Auth::user()->email, $superAdmins))
                    <a href="{{ url('/superadmin/dashboard') }}" class="text-[#3b82f6] font-medium text-base">Panel Super Admin</a>
                @else
                    <a href="{{ url('/admin/dashboard') }}" class="text-[#3b82f6] font-medium text-base">Administrar negocio</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="w-full mt-2">
                    @csrf
                    <button type="submit" class="w-full bg-[#A6F4EB] text-[#040116] font-semibold px-6 py-2.5 rounded-lg shadow-sm text-center">Cerrar Sesión</button>
                </form>
            @endauth
        </div>
    </header>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- 2. HERO SECTION & PANEL DE USUARIO         -->
    <!-- ========================================== -->
    @auth
        <!-- VISTA LOGUEADO (Horizontal, ultra compacta y sin foto) -->
        <div class="flex flex-col">
            
            <!-- Franja Azul Superior -->
            <section class="bg-gradient-to-r from-[#020617] via-[#0f172a] to-[#2563eb] py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-white w-full md:w-1/2">
                        <h1 class="text-[28px] font-normal tracking-wide mb-1">¡Hola, <span class="font-bold">{{ explode(' ', Auth::user()->name)[0] }}</span>!</h1>
                        <p class="text-blue-100 text-[14px] font-light">¿Qué estás buscando hoy?</p>
                    </div>
                    <div class="w-full md:w-1/2 flex justify-start md:justify-end">
                        <form action="{{ route('products.index') }}" method="GET" class="relative w-full max-w-lg bg-white rounded-full flex items-center p-1.5 shadow-sm">
                            <input type="text" name="search" placeholder="Busca negocios, productos o servicios..." class="w-full pl-5 pr-4 py-2 bg-transparent border-0 focus:ring-0 text-gray-700 text-sm outline-none">
                        @error('search') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            <button type="submit" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white font-medium px-8 py-2 rounded-full transition text-sm">Buscar</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Botonera de Acción Rápida (Fondo blanco) -->
            <section class="bg-white py-5 border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-center md:justify-start gap-3">
                    <a href="{{ route('favorites.index') }}" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white px-5 py-2.5 rounded-xl font-medium flex items-center gap-2 text-[14px] shadow-sm transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>Mis Favoritos</a>
                    <a href="{{ url('/admin/reservas') }}" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white px-5 py-2.5 rounded-xl font-medium flex items-center gap-2 text-[14px] shadow-sm transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>Mis Reservas</a>
                    <a href="{{ route('categories.index') }}" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white px-5 py-2.5 rounded-xl font-medium flex items-center gap-2 text-[14px] shadow-sm transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>Categorías</a>
                    <a href="{{ route('products.index') }}" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white px-5 py-2.5 rounded-xl font-medium flex items-center gap-2 text-[14px] shadow-sm transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Buscar</a>
                    
                    <a href="{{ url('/admin/dashboard') }}" class="bg-[#020617] hover:bg-gray-900 text-white px-5 py-2.5 rounded-xl font-medium flex items-center gap-2 text-[14px] shadow-sm transition ml-0 sm:ml-3">Administrar negocio</a>
                </div>
            </section>

            <!-- Sección de Reservas Activas (Sube de posición) -->
            <section class="bg-[#FFF8EC] py-10 border-b border-yellow-100/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h3 class="text-[#f59e0b] font-bold text-[15px] mb-5">Tus reservas activas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                        @forelse($reservas_activas ?? [] as $reserva)
                        <!-- Tarjeta de Reserva -->
                        <div class="bg-white p-5 rounded-2xl border border-yellow-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <h4 class="font-bold text-[#0f172a] text-[15px] mb-1">{{ $reserva->producto->nombre ?? 'Producto' }}</h4>
                                <p class="text-gray-500 text-[13px] mb-6 font-light">{{ $reserva->producto->proveedor->nombre ?? 'Proveedor' }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                @if(isset($reserva->estado) && $reserva->estado == 'Disponible')
                                <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">Disponible</span>
                                @else
                                <span class="bg-[#fef3c7] text-[#d97706] px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">En espera</span>
                                @endif
                                <a href="{{ url('/admin/reservas') }}" class="text-[#3b82f6] text-[13px] font-medium hover:underline flex items-center gap-1">Ver &rarr;</a>
                            </div>
                        </div>
                        @empty
                        <!-- Placeholder si no hay reservas -->
                        <p class="text-sm text-gray-500 col-span-full">No tienes reservas activas en este momento.</p>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    @else
        <!-- VISTA INVITADO (Hero Original con la Chica Sonriendo) -->
        <section class="bg-gradient-to-r from-[#0a194f] via-[#163080] to-[#2563eb] pt-20 pb-28 overflow-hidden relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <!-- Textos Invitado -->
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
                    <form action="{{ route('products.index') }}" method="GET" class="bg-white p-1.5 rounded-full flex items-center max-w-xl shadow-lg mt-8"><input type="text" name="search" placeholder="Busca negocios, productos o servicios..." class="w-full pl-6 pr-4 bg-transparent border-none focus:ring-0 text-gray-500 text-sm outline-none">
                        @error('search') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror<button type="submit" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white font-semibold px-8 py-2.5 rounded-full transition text-sm whitespace-nowrap">Buscar</button></form>
                </div>

                <!-- Imagen Chica Sonriendo -->
                <div class="lg:col-span-5 relative z-10 hidden lg:flex justify-end pr-10">
                    <div class="w-[380px] relative drop-shadow-2xl">
                        <img src="{{ asset('images/ChicaSonriendo.png') }}" alt="Chica Emprendedora" class="w-full h-auto object-contain">
                    </div>
                </div>
            </div>
        </section>
    @endauth

    <!-- ========================================== -->
    <!-- SECCIÓN 4: CATEGORÍAS                      -->
    <!-- ========================================== -->
    <section id="categorias" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 bg-white">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-[32px] font-extrabold text-[#0f172a] mb-2 tracking-tight">Explorar por categoría</h2>
                <p class="text-[#3b82f6] font-medium text-sm">Encuentra negocios y proveedores según lo que necesitas</p>
            </div>
            <a href="{{ route('companies.index') }}" class="text-[#3b82f6] font-medium hover:underline flex items-center gap-2 text-sm">Ver todas <span aria-hidden="true">&rarr;</span></a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
            
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
            
            <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                
                <!-- Tarjeta 1 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] text-left flex flex-col justify-start h-full border border-gray-50">
                    <div class="flex justify-between items-start mb-10">
                        <span class="text-[5.5rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2563eb] to-[#7dd3fc] leading-none tracking-tighter">01</span>
                        <div class="w-14 h-14 bg-[#2563eb] rounded-2xl flex items-center justify-center text-white shadow-md">
                           <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-[#0f172a] mb-3">Busca o explora</h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed font-light mb-10">Usa la búsqueda o explora las categorías para encontrar lo que necesitas.</p>
                        <div class="w-full h-px bg-gradient-to-r from-blue-200 to-transparent"></div>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] text-left flex flex-col justify-start h-full border border-gray-50">
                    <div class="flex justify-between items-start mb-10">
                        <span class="text-[5.5rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2563eb] to-[#7dd3fc] leading-none tracking-tighter">02</span>
                        <div class="w-14 h-14 bg-[#2563eb] rounded-2xl flex items-center justify-center text-white shadow-md">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z M9 16l2 2 4-4"></path></svg>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-[#0f172a] mb-3">Consulta y compara</h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed font-light mb-10">Revisa perfiles, disponibilidad de stock, precios, reseñas y toda la información necesaria antes de elegir.</p>
                        <div class="w-full h-px bg-gradient-to-r from-blue-200 to-transparent"></div>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] text-left flex flex-col justify-start h-full border border-gray-50">
                    <div class="flex justify-between items-start mb-10">
                        <span class="text-[5.5rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2563eb] to-[#7dd3fc] leading-none tracking-tighter">03</span>
                        <div class="w-14 h-14 bg-[#2563eb] rounded-2xl flex items-center justify-center text-white shadow-md">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                    </div>
                    <div class="mt-8">
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
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 bg-white">
        <!-- Encabezado de la sección -->
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-[#0f172a] mb-2 tracking-tight">Negocios destacados</h2>
                <p class="text-gray-500 font-light text-sm">Proveedores verificados con los mejores productos y servicios</p>
            </div>
            <a href="{{ route('companies.index') }}" class="text-[#3b82f6] font-medium hover:underline flex items-center gap-2 text-sm">Ver todos <span aria-hidden="true">&rarr;</span></a>
        </div>
        
        <!-- Cuadrícula de 4 tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($negocios_destacados ?? [] as $negocio)
            <!-- Borde índigo muy fino (border-[#818cf8]) como en el Figma -->
            <div class="bg-white border border-[#818cf8] rounded-[16px] overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition duration-300 group flex flex-col relative">
                
                @if($negocio->premium ?? false)
                    <!-- Etiqueta PREMIUM Morada -->
                    <div class="absolute top-4 left-4 bg-[#8b5cf6] text-white text-[10px] font-bold px-3 py-1.5 rounded-md z-10 flex items-center gap-1 shadow-sm tracking-wide">
                        <span class="text-yellow-300 text-xs">★</span> PREMIUM
                    </div>
                @endif
                
                <!-- Imagen -->
                <div class="h-44 w-full overflow-hidden relative bg-gray-100">
                    <img src="{{ $negocio->img ?? 'https://via.placeholder.com/500' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
                
                <!-- Contenido de la Tarjeta -->
                <div class="p-5 flex flex-col flex-grow">
                    
                    <!-- Título y Verificado -->
                    <div class="flex justify-between items-start gap-2 mb-3">
                        <h3 class="font-bold text-gray-900 text-[15px] leading-tight">{{ $negocio->nombre ?? 'Sin nombre' }}</h3>
                        <span class="shrink-0 inline-flex items-center gap-1 bg-[#dcfce7] text-[#16a34a] px-2 py-0.5 rounded text-[10px] font-bold border border-green-200">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            Verificado
                        </span>
                    </div>
                    
                    <!-- Pastilla de Categoría Celeste -->
                    <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[11px] font-medium px-3 py-1 rounded-full mb-3 self-start">
                        {{ $negocio->categoria ?? 'Sin categoría' }}
                    </span>
                    
                    <!-- Descripción corta -->
                    <p class="text-gray-500 text-[13px] leading-relaxed mb-4 flex-grow font-light">
                        {{ $negocio->descripcion ?? 'Sin descripción' }}
                    </p>
                    
                    <div class="w-full h-px bg-gray-100 mb-4"></div>
                    
                    <!-- Footer (Rating y Reseñas) -->
                    <div class="flex items-center justify-between text-[13px]">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="font-bold text-gray-900">{{ $negocio->rating ?? '0.0' }}</span>
                            <span class="text-gray-400">({{ $negocio->reviews ?? '0' }})</span>
                        </div>
                        <a href="{{ route('companies.show', $negocio->id ?? 1) }}" class="text-[#3b82f6] font-medium hover:underline text-[13px]">Ver perfil</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500 py-8">No hay negocios destacados</div>
            @endforelse
        </div>
    </section>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 7: BANNER CALL TO ACTION           -->
    <!-- ========================================== -->
    <section class="bg-gradient-to-r from-[#46a8ff] to-[#2b5bf4] text-white">
        <!-- Redujimos el padding vertical (py-16 en lugar de py-24) para hacerlo menos alto -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 lg:grid-cols-1 sm:grid-cols-2 gap-10 items-center">
            
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
                <a href="{{ route('register') }}" class="inline-block bg-white text-[#2563eb] font-bold px-8 py-2.5 rounded-full hover:bg-gray-100 transition duration-300 text-sm shadow-md text-center">
                    Registrar mi negocio
                </a>
            </div>
            
            <!-- Columna Derecha: Tarjetas Transparentes con bordes finos -->
            <div class="grid grid-cols-1 sm:grid-cols-1 sm:grid-cols-2 gap-4">
                
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
        
        <!-- Contenedor del Carrusel (Interactivo con Alpine.js) -->
        <div x-data="{ active: 1 }" class="relative w-full max-w-[1200px] mx-auto mb-16">
            <div class="flex flex-col md:flex-row justify-center items-center gap-6 lg:gap-10 relative w-full overflow-hidden">
                
                <!-- Tarjeta 0 (Izquierda - María) -->
                <div @click="active = 0" 
                     class="transition-all duration-500 ease-in-out transform cursor-pointer w-full md:w-[300px] lg:w-[320px] shrink-0 rounded-[32px] overflow-hidden"
                     :class="active === 0 ? 'scale-100 md:scale-110 z-20 bg-[#2563eb] shadow-[0_20px_50px_rgba(37,99,235,0.3)]' : 'scale-90 z-10 bg-blue-300 opacity-60 md:opacity-50 md:blur-[1px] hover:opacity-80 hover:blur-none hidden md:block'">
                    <div class="h-48 md:h-56 relative">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&q=80" 
                             class="w-full h-full object-cover transition-all duration-500"
                             :class="active === 0 ? 'grayscale-0' : 'grayscale'">
                        <div x-show="active === 0" x-transition.opacity class="absolute bottom-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider border border-white/10">Cliente</div>
                    </div>
                    <div class="p-6 md:p-8 text-left transition-all duration-500" :class="active === 0 ? 'text-white' : 'text-blue-50/80'">
                        <div class="text-yellow-400 text-sm md:text-lg mb-3 tracking-widest">★★★★★</div>
                        <p class="mb-4 font-light leading-relaxed text-[12px] md:text-[14px]" :class="active === 0 ? 'line-clamp-none' : 'line-clamp-3'">"Encontré exactamente lo que necesitaba en minutos. SINGKI me conectó con un proveedor confiable y el proceso fue súper sencillo."</p>
                        <div>
                            <p class="font-bold text-[13px] md:text-[15px]">María González</p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 1 (Centro - Carlos) -->
                <div @click="active = 1" 
                     class="transition-all duration-500 ease-in-out transform cursor-pointer w-full md:w-[300px] lg:w-[320px] shrink-0 rounded-[32px] overflow-hidden"
                     :class="active === 1 ? 'scale-100 md:scale-110 z-20 bg-[#2563eb] shadow-[0_20px_50px_rgba(37,99,235,0.3)]' : 'scale-90 z-10 bg-blue-300 opacity-60 md:opacity-50 md:blur-[1px] hover:opacity-80 hover:blur-none hidden md:block'">
                    <div class="h-48 md:h-56 relative">
                        <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?w=500&q=80" 
                             class="w-full h-full object-cover transition-all duration-500"
                             :class="active === 1 ? 'grayscale-0' : 'grayscale'">
                        <div x-show="active === 1" x-transition.opacity class="absolute bottom-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider border border-white/10">Emprendedor</div>
                    </div>
                    <div class="p-6 md:p-8 text-left transition-all duration-500" :class="active === 1 ? 'text-white' : 'text-blue-50/80'">
                        <div class="text-yellow-400 text-sm md:text-lg mb-3 tracking-widest">★★★★★</div>
                        <p class="mb-4 font-light leading-relaxed text-[12px] md:text-[14px]" :class="active === 1 ? 'line-clamp-none' : 'line-clamp-3'">"Registré mi negocio en SINGKI y en la primera semana ya tenía consultas reales. La plataforma le da visibilidad a mi emprendimiento."</p>
                        <div>
                            <p class="font-bold text-[13px] md:text-[15px]">Carlos Pérez</p>
                            <p class="text-[11px] md:text-[12px] text-blue-200 font-light mt-0.5">Estelí, Nicaragua</p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 2 (Derecha - Ana) -->
                <div @click="active = 2" 
                     class="transition-all duration-500 ease-in-out transform cursor-pointer w-full md:w-[300px] lg:w-[320px] shrink-0 rounded-[32px] overflow-hidden"
                     :class="active === 2 ? 'scale-100 md:scale-110 z-20 bg-[#2563eb] shadow-[0_20px_50px_rgba(37,99,235,0.3)]' : 'scale-90 z-10 bg-blue-300 opacity-60 md:opacity-50 md:blur-[1px] hover:opacity-80 hover:blur-none hidden md:block'">
                    <div class="h-48 md:h-56 relative">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80" 
                             class="w-full h-full object-cover transition-all duration-500"
                             :class="active === 2 ? 'grayscale-0' : 'grayscale'">
                        <div x-show="active === 2" x-transition.opacity class="absolute bottom-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider border border-white/10">Proveedora</div>
                    </div>
                    <div class="p-6 md:p-8 text-left transition-all duration-500" :class="active === 2 ? 'text-white' : 'text-blue-50/80'">
                        <div class="text-yellow-400 text-sm md:text-lg mb-3 tracking-widest">★★★★★</div>
                        <p class="mb-4 font-light leading-relaxed text-[12px] md:text-[14px]" :class="active === 2 ? 'line-clamp-none' : 'line-clamp-3'">"El panel de administración es muy completo. Puedo gestionar mi inventario, ver reservas y chatear con los clientes fácilmente."</p>
                        <div>
                            <p class="font-bold text-[13px] md:text-[15px]">Ana Rodríguez</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles del Carrusel (Flechas y Puntos) -->
            <div class="flex items-center justify-center gap-6 mt-16 md:mt-12">
                <!-- Flecha Izquierda -->
                <button @click="active = active === 0 ? 2 : active - 1" class="w-10 h-10 rounded-full border-2 border-[#3b82f6] flex items-center justify-center text-[#3b82f6] hover:bg-[#3b82f6] hover:text-white transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <!-- Puntos de navegación -->
                <div class="flex items-center gap-2.5">
                    <button @click="active = 0" :class="active === 0 ? 'w-6 bg-[#2563eb]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
                    <button @click="active = 1" :class="active === 1 ? 'w-6 bg-[#2563eb]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
                    <button @click="active = 2" :class="active === 2 ? 'w-6 bg-[#2563eb]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
                </div>
                
                <!-- Flecha Derecha -->
                <button @click="active = active === 2 ? 0 : active + 1" class="w-10 h-10 rounded-full border-2 border-[#3b82f6] flex items-center justify-center text-[#3b82f6] hover:bg-[#3b82f6] hover:text-white transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <!-- Divisor sutil -->
        <div class="max-w-4xl mx-auto h-px bg-gradient-to-r from-transparent via-blue-200 to-transparent mb-16"></div>

        <!-- Estadísticas -->
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
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
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 10: FOOTER FINAL                   -->
    <!-- ========================================== -->
    <section>
        @guest
        <!-- Bloque CTA (Fondo Blanco) -->
        <div class="bg-white py-24 text-center border-t border-gray-50">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-[#2563eb] mb-4 tracking-tight">¿Listo para empezar?</h2>
            <p class="text-[#3b82f6] text-[15px] font-light mb-10 max-w-2xl mx-auto">Únete a la plataforma que conecta negocios con oportunidades.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-[#2563eb] text-white font-bold px-8 py-3 rounded-xl hover:bg-[#1d4ed8] transition shadow-sm text-[15px]">Crear cuenta gratis</button>
                <button class="bg-white border border-[#2563eb] text-[#2563eb] font-bold px-8 py-3 rounded-xl hover:bg-blue-50 transition text-[15px]">Explorar negocios</button>
            </div>
        </div>
        @endguest

        <!-- Footer (Fondo ajustado EXACTAMENTE al código de la paleta oficial: #00003d) -->
        @include('components.footer')
    </section>
    <!-- ========================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnToggle = document.getElementById('btn-chat-toggle');
            const chatModal = document.getElementById('chat-modal');
            const btnCloseModal = document.getElementById('close-chat-modal');
            const iconRobot = document.getElementById('chat-icon-robot');
            const iconX = document.getElementById('chat-icon-x');

            function toggleChat() {
                // Alternar visibilidad del modal con animación
                if (chatModal.classList.contains('hidden')) {
                    chatModal.classList.remove('hidden');
                    // Pequeño retraso para que la animación CSS se ejecute
                    setTimeout(() => {
                        chatModal.classList.remove('opacity-0', 'scale-95');
                        chatModal.classList.add('opacity-100', 'scale-100');
                    }, 10);
                } else {
                    chatModal.classList.remove('opacity-100', 'scale-100');
                    chatModal.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        chatModal.classList.add('hidden');
                    }, 300);
                }
                
                // Alternar iconos del botón principal con opacidad y escala
                if (iconRobot.classList.contains('opacity-0')) {
                    iconRobot.classList.remove('opacity-0', 'scale-50');
                    iconRobot.classList.add('opacity-100', 'scale-100');
                    iconX.classList.remove('opacity-100', 'scale-100');
                    iconX.classList.add('opacity-0', 'scale-50');
                } else {
                    iconRobot.classList.remove('opacity-100', 'scale-100');
                    iconRobot.classList.add('opacity-0', 'scale-50');
                    iconX.classList.remove('opacity-0', 'scale-50');
                    iconX.classList.add('opacity-100', 'scale-100');
                }
            }

            btnToggle.addEventListener('click', toggleChat);
            btnCloseModal.addEventListener('click', toggleChat);
        });
    </script>
    <script>
        function parsearMarkdown(texto) {
            if (!texto) return '';
            // Convertir negritas (**texto** a <strong>texto</strong>)
            let html = texto.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-gray-900">$1</strong>');
            // Convertir saltos de línea a <br>
            html = html.replace(/\n/g, '<br>');
            return html;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const btnSend = document.getElementById('ki-send-btn');
            const inputField = document.getElementById('ki-input');
            const chatBody = inputField.closest('.p-5'); // Contenedor del chat

            if(btnSend && inputField) {
                btnSend.addEventListener('click', async (e) => {
                    e.preventDefault();
                    
                    const text = inputField.value.trim();
                    if(!text) return;

                    // Cambiar estado del botón
                    const originalText = btnSend.innerText;
                    btnSend.innerText = 'Enviando...';
                    btnSend.disabled = true;
                    btnSend.classList.add('opacity-50', 'cursor-not-allowed');

                    // Añadir el mensaje del usuario visualmente
                    const userMsgHtml = `
                        <div class="flex gap-4 items-start mb-6 flex-row-reverse">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="bg-blue-50 border border-blue-100 p-3 rounded-2xl rounded-tr-sm w-full max-w-[85%]">
                                <p class="text-gray-700 text-[13px] leading-relaxed font-light">${text}</p>
                            </div>
                        </div>
                    `;
                    // Insertarlo antes del formulario (el div que contiene textarea y label)
                    const formContainer = inputField.parentElement;
                    formContainer.insertAdjacentHTML('beforebegin', userMsgHtml);
                    
                    // Limpiar input y scroll
                    inputField.value = '';
                    const chatModalBody = document.querySelector('#chat-modal .bg-white.p-5');
                    if(chatModalBody) chatModalBody.scrollTop = chatModalBody.scrollHeight;

                    try {
                        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                        const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

                        const response = await fetch("{{ route('chat.ask') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ prompt: text })
                        });

                        const data = await response.json();
                        
                        // Añadir respuesta de Ki
                        const replyText = data.reply ? data.reply : (data.error || 'Error desconocido');
                        const kiMsgHtml = `
                            <div class="flex gap-4 items-start mb-6">
                                <div class="w-12 h-12 bg-[#2563eb] rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl rounded-tl-sm w-full">
                                    <h4 class="text-[#2563eb] font-bold text-[14px] mb-1">Ki</h4>
                                    <div class="text-gray-500 text-[13px] leading-relaxed font-light prose prose-sm max-w-none">${parsearMarkdown(replyText)}</div>
                                </div>
                            </div>
                        `;
                        formContainer.insertAdjacentHTML('beforebegin', kiMsgHtml);
                        
                    } catch (error) {
                        console.error('Error enviando consulta a Ki:', error);
                        alert('Hubo un error al contactar al asistente. Por favor, intenta de nuevo.');
                    } finally {
                        // Restaurar botón
                        btnSend.innerText = originalText;
                        btnSend.disabled = false;
                        btnSend.classList.remove('opacity-50', 'cursor-not-allowed');
                        if(chatModalBody) chatModalBody.scrollTop = chatModalBody.scrollHeight;
                    }
                });
            }
        });
    </script>
</body>
</html>