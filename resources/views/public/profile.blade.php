@php
    // Atrapamos el negocio que el usuario clickeó en la URL
    $negocioSolicitado = request('negocio', 'TechSolutions GT');

    // SIMULADOR DE BASE DE DATOS DE PERFILES (AHORA CON 4 NEGOCIOS)
    $baseDatosPerfiles = [
        'TechSolutions GT' => [
            'banner' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80',
            'logo' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=200&q=80',
            'nombre' => 'TechSolutions GT',
            'verificado_badge' => true,
            'estado_info' => 'Verificado',
            'premium' => true,
            'categoria' => 'Tecnología',
            'desc' => 'Soluciones tecnológicas para empresas. Hardware, software y soporte técnico especializado.',
            'rating' => '4.8', 'reviews_count' => '124',
            'ubicacion_corta' => 'Estelí, Barrio El Rosario',
            'ubicacion_larga' => 'Estelí, Barrio El Rosario',
            'horario' => 'Lun–Vie 8:00–18:00',
            'email' => 'info@techsolutionsgt.com',
            'telefono' => '+505 2234-5678',
            'web' => 'www.techsolutionsgt.com',
            'disp' => 4, 'agot' => 2,
            'productos' => [
                ['nombre' => 'Laptop HP EliteBook 840', 'codigo' => 'HP-840-G9', 'marca' => 'HP', 'stock' => '12', 'estado' => 'Disponible', 'precio' => 'C$ 28,500'],
                ['nombre' => 'Monitor Dell 27" 4K', 'codigo' => 'DELL-27-4K', 'marca' => 'Dell', 'stock' => '—', 'estado' => 'Agotado', 'precio' => 'C$ 4,200'],
                ['nombre' => 'Mouse Logitech MX Master 3', 'codigo' => 'LOG-MXM3', 'marca' => 'Logitech', 'stock' => '35', 'estado' => 'Disponible', 'precio' => 'C$ 650']
            ],
            'resenas' => [
                ['nombre' => 'Ana Rodríguez', 'fecha' => '2026-08-10', 'texto' => 'Excelente servicio y productos de calidad. Entrega rápida y soporte técnico muy profesional.', 'img' => ''],
                ['nombre' => 'Roberto Lima', 'fecha' => '2026-08-05', 'texto' => 'Buenos precios en equipos. El proceso de cotización es un poco lento pero el producto llegó en perfectas condiciones.', 'img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80']
            ]
        ],
        'Distribuidora Alimentos Norte' => [
            'banner' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1600&q=80',
            'logo' => 'https://images.unsplash.com/photo-1608686207856-001b95cf60ca?w=200&q=80',
            'nombre' => 'Distribuidora Alimentos Norte',
            'verificado_badge' => true,
            'estado_info' => 'Verificado',
            'premium' => false,
            'categoria' => 'Alimentos',
            'desc' => 'Distribución mayorista de alimentos secos, enlatados y productos de limpieza a nivel nacional.',
            'rating' => '4.5', 'reviews_count' => '89',
            'ubicacion_corta' => 'Quetzaltenango, Zona 1',
            'ubicacion_larga' => 'Quetzaltenango, Zona 1',
            'horario' => 'Lun–Sáb 7:00–17:00',
            'email' => 'ventas@alimentosnorte.com',
            'telefono' => '+502 7765-4321',
            'web' => 'www.alimentosnorte.com',
            'disp' => 0, 'agot' => 0,
            'productos' => [],
            'resenas' => []
        ],
        'Construcciones Sólidas' => [
            'banner' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1600&q=80',
            'logo' => 'https://images.unsplash.com/photo-1541888086225-f674ce8832a8?w=200&q=80',
            'nombre' => 'Construcciones Sólidas',
            'verificado_badge' => true,
            'estado_info' => 'Pendiente', 
            'premium' => false,
            'categoria' => 'Construcción',
            'desc' => 'Materiales de construcción, ferretería industrial y herramientas profesionales.',
            'rating' => '4.3', 'reviews_count' => '57',
            'ubicacion_corta' => 'Escuintla, Guatemala',
            'ubicacion_larga' => 'Escuintla, Guatemala',
            'horario' => 'Lun–Sáb 6:00–16:00',
            'email' => 'contacto@construccionessolidas.com',
            'telefono' => '+502 7892-1234',
            'web' => 'www.construccionessolidas.com',
            'disp' => 0, 'agot' => 0,
            'productos' => [],
            'resenas' => []
        ],
        'Moda Express' => [
            'banner' => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&w=1600&q=80',
            'logo' => 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=200&q=80',
            'nombre' => 'Moda Express',
            'verificado_badge' => true,
            'estado_info' => 'Verificado',
            'premium' => true,
            'categoria' => 'Moda',
            'desc' => 'Ropa y accesorios al por mayor. Colecciones para dama, caballero y niños.',
            'rating' => '4.6', 'reviews_count' => '201',
            'ubicacion_corta' => 'Ciudad de Guatemala, Zona 4',
            'ubicacion_larga' => 'Ciudad de Guatemala, Zona 4',
            'horario' => 'Lun–Dom 9:00–20:00',
            'email' => 'moda@modaexpress.com',
            'telefono' => '+502 2345-6789',
            'web' => 'www.modaexpress.com',
            'disp' => 0, 'agot' => 0,
            'productos' => [],
            'resenas' => []
        ]
    ];

    // Si no existe el negocio, cargamos TechSolutions por defecto para evitar errores
    $perfil = $baseDatosPerfiles[$negocioSolicitado] ?? $baseDatosPerfiles['TechSolutions GT'];
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil Público - {{ $perfil['nombre'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">
    
    <!-- HEADER INTACTO CON LOGO BLANCO -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100 z-50 relative">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Icono SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#2563eb] tracking-tighter">SINGKI</span>
        </a>
        
        <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
            <a href="{{ url('/') }}" class="hover:text-[#2563eb] transition">Inicio</a>
            <a href="{{ url('/#categorias') }}" class="hover:text-[#2563eb] transition">Categorías</a>
            <a href="{{ url('/explorar') }}" class="text-[#2563eb] font-bold">Explorar</a>
        </nav>
        
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'S' }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Sharon' }}
            </span>
        </div>
    </header>

    <!-- BANNER DINÁMICO -->
    <div class="w-full h-64 relative bg-[#1e293b]">
        <img src="{{ $perfil['banner'] }}" class="w-full h-full object-cover opacity-90">
    </div>

    <!-- CONTENEDOR PRINCIPAL CON ALPINE -->
        <!-- CONTENEDOR PRINCIPAL CON ALPINE (AHORA CON REACTIVIDAD PARA RESEÑAS) -->
    <main x-data="{ 
        tab: 'productos',
        isFavorite: false,
        showReviewModal: false,
        reviewStep: 1,
        rating: 0,
        hoverRating: 0,
        reviewText: '',
        reviews: {{ Js::from($perfil['resenas']) }},
        userName: '{{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Sharon' }}',
        
        submitReview() {
            if(this.rating === 0 || this.reviewText.trim() === '') return;
            
            // 1. Agregamos la reseña a la cima de la lista en tiempo real
            this.reviews.unshift({
                nombre: this.userName,
                fecha: new Date().toISOString().split('T')[0],
                texto: this.reviewText,
                img: '' 
            });
            
            // 2. Pasamos a la pantalla de éxito
            this.reviewStep = 2;
        },
        
        closeModal() {
            this.showReviewModal = false;
            // Reseteamos el formulario después de que se cierre la animación
            setTimeout(() => {
                this.reviewStep = 1;
                this.rating = 0;
                this.reviewText = '';
            }, 300);
        }
    }" class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 w-full relative">
        
        <!-- TARJETA FLOTANTE DEL NEGOCIO -->
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8 relative z-10 -mt-20 mb-8">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Logo Dinámico -->
                <div class="w-24 h-24 rounded-2xl overflow-hidden shrink-0 shadow-sm border border-gray-100 bg-white">
                    <img src="{{ $perfil['logo'] }}" class="w-full h-full object-cover p-1 rounded-2xl">
                </div>
                
                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-3 mb-2">
                        <h1 class="text-2xl font-extrabold text-[#0f172a]">{{ $perfil['nombre'] }}</h1>
                        
                        @if($perfil['verificado_badge'])
                            <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-[11px] font-bold">✓ Verificado</span>
                        @endif
                        
                        @if($perfil['premium'])
                            <span class="bg-[#f5f3ff] text-[#8b5cf6] px-3 py-1 rounded-full text-[11px] font-bold border border-[#e0e7ff] flex items-center gap-1"><span class="text-yellow-400">★</span> PREMIUM</span>
                        @endif
                    </div>
                    
                    <span class="inline-block bg-[#eff6ff] text-[#2563eb] text-[12px] font-bold px-3 py-1 rounded-full mb-4">{{ $perfil['categoria'] }}</span>
                    <p class="text-gray-500 text-sm font-light mb-6">{{ $perfil['desc'] }}</p>
                    
                    <!-- Botones de Acción (Interactivos) -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        
                        <!-- Botón Favorito (Alpine.js) -->
                        <button @click="isFavorite = !isFavorite" 
                                :class="isFavorite ? 'border-red-200 bg-red-50 text-red-500' : 'border-gray-300 text-gray-700 hover:bg-gray-50'"
                                class="flex items-center gap-2 border px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 transform active:scale-95 cursor-pointer">
                            <svg class="w-4 h-4 transition-colors duration-300" :fill="isFavorite ? 'currentColor' : 'none'" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg> 
                            Favorito
                        </button>

                        <!-- Botón Ver Ubicación (Google Maps) -->
                        <a href="https://maps.google.com/?q={{ urlencode($perfil['ubicacion_larga']) }}" target="_blank" 
                           class="flex items-center gap-2 border border-gray-300 text-gray-700 px-5 py-2 rounded-full text-sm font-bold hover:bg-gray-50 transition-all active:scale-95 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg> 
                            Ver ubicación
                        </a>

                        <!-- Botón Chatear (Interno SINGKI) -->
                        <a href="{{ url('/chat-negocio?empresa=' . urlencode($perfil['nombre'])) }}" 
                           class="flex items-center gap-2 bg-[#2563eb] text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-[#1d4ed8] transition-all shadow-md active:scale-95 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg> 
                            Chatear
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-5 flex flex-wrap justify-between items-center gap-4 text-xs font-medium text-gray-600">
                <div class="flex flex-wrap items-center gap-4 md:gap-6">
                    <div class="flex items-center gap-1"><span class="text-yellow-400 text-base">★</span> <span class="text-[#0f172a] font-bold">{{ $perfil['rating'] }}</span> <span class="font-light">({{ $perfil['reviews_count'] }} reseñas)</span></div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> {{ $perfil['ubicacion_corta'] }}</div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $perfil['horario'] }}</div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> {{ $perfil['email'] }}</div>
                </div>
                <a href="#" class="text-gray-500 hover:text-red-500 transition flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg> Reportar negocio</a>
            </div>
        </div>

        <!-- PESTAÑAS -->
        <div class="flex flex-wrap gap-3 mb-8">
            <button @click="tab = 'productos'" :class="tab === 'productos' ? 'bg-[#2563eb] text-white border-[#2563eb] shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-6 py-2.5 rounded-full font-bold text-sm border transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg> Productos y Stock
            </button>
            <button @click="tab = 'reseñas'" :class="tab === 'reseñas' ? 'bg-[#2563eb] text-white border-[#2563eb] shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-6 py-2.5 rounded-full font-bold text-sm border transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg> Reseñas
            </button>
            <button @click="tab = 'informacion'" :class="tab === 'informacion' ? 'bg-[#2563eb] text-white border-[#2563eb] shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-6 py-2.5 rounded-full font-bold text-sm border transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Información
            </button>
        </div>

        <!-- CONTENIDO: PRODUCTOS -->
        <div x-show="tab === 'productos'" x-transition.opacity.duration.300ms>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-[#0f172a]">Productos y disponibilidad</h2>
                <div class="flex gap-2">
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-xs font-bold">{{ $perfil['disp'] }} disponibles</span>
                    <span class="bg-[#fee2e2] text-[#dc2626] px-3 py-1 rounded-full text-xs font-bold">{{ $perfil['agot'] }} agotados</span>
                </div>
            </div>

            <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto w-full pb-4 scrollbar-hide">
                    <div class="min-w-[700px] md:min-w-0">
                        <div class="grid grid-cols-6 gap-4 p-4 border-b border-gray-100 text-xs font-bold text-gray-500 tracking-wider">
                    <div class="col-span-2">PRODUCTO</div>
                    <div>MARCA</div>
                    <div class="text-center">STOCK</div>
                    <div class="text-center">ESTADO</div>
                    <div class="text-right">PRECIO</div>
                </div>
                
                @foreach($perfil['productos'] as $prod)
                <div class="grid grid-cols-6 gap-4 p-4 items-center border-b border-gray-50 hover:bg-gray-50 transition">
                    <div class="col-span-2 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div><p class="font-bold text-[#0f172a] text-sm">{{ $prod['nombre'] }}</p><p class="text-xs text-gray-500 font-light">{{ $prod['codigo'] }}</p></div>
                    </div>
                    <div class="text-sm text-gray-700">{{ $prod['marca'] }}</div>
                    <div class="text-sm font-bold {{ $prod['stock'] == '—' ? 'text-gray-400' : 'text-[#0f172a]' }} text-center">{{ $prod['stock'] }}</div>
                    <div class="text-center">
                        <span class="{{ $prod['estado'] == 'Disponible' ? 'bg-[#dcfce7] text-[#16a34a]' : 'bg-[#fee2e2] text-[#dc2626]' }} px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $prod['estado'] }}</span>
                    </div>
                    <div class="flex items-center justify-end gap-6">
                        <span class="font-bold text-[#2563eb] text-sm whitespace-nowrap">{{ $prod['precio'] }}</span>
                        @if($prod['estado'] == 'Disponible')
                            <button class="border border-[#2563eb] text-[#2563eb] px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-50 transition">Consultar</button>
                        @else
                            <button class="bg-[#2563eb] text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-[#1d4ed8] transition shadow-sm">Reservar</button>
                        @endif
                    </div>
                </div>
                @endforeach

                @if(count($perfil['productos']) == 0)
                <div class="p-8 text-center text-gray-400 text-sm font-light">
                    <!-- Sin filas para negocios que no tienen stock (Alimentos, Construcciones, Moda) -->
                </div>
                @endif
            </div>
        </div>

                <!-- CONTENIDO: RESEÑAS -->
        <div x-show="tab === 'reseñas'" style="display: none;" x-transition.opacity.duration.300ms>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-[#0f172a]">Reseñas de clientes</h2>
                <button @click="showReviewModal = true" class="bg-[#2563eb] text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-[#1d4ed8] transition shadow-md flex items-center gap-2">
                    + Escribir reseña
                </button>
            </div>
            
            <div class="space-y-4">
                <!-- Iteración con Alpine.js para actualización instantánea -->
                <template x-for="(res, index) in reviews" :key="index">
                    <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-6 flex gap-5">
                        
                        <!-- Si hay imagen la muestra, si no, pone la inicial del nombre -->
                        <template x-if="res.img !== ''">
                            <img :src="res.img" class="w-12 h-12 rounded-full object-cover shrink-0">
                        </template>
                        <template x-if="res.img === ''">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-[#2563eb] font-bold text-lg shrink-0" x-text="res.nombre.charAt(0)"></div>
                        </template>
                        
                        <!-- Texto de la reseña -->
                        <div class="flex-grow">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-bold text-[#0f172a]" x-text="res.nombre"></h4>
                                <span class="text-xs text-gray-400 font-medium" x-text="res.fecha"></span>
                            </div>
                            <!-- Estrellas (Fijas por ahora en la vista de lista) -->
                            <div class="flex text-yellow-400 text-sm mb-3">★★★★★</div>
                            <p class="text-gray-600 text-sm font-light leading-relaxed" x-text="res.texto"></p>
                        </div>
                    </div>
                </template>

                <!-- Estado vacío por si el negocio no tiene reseñas -->
                <div x-show="reviews.length === 0" class="text-center py-10" style="display: none;">
                    <p class="text-gray-500 font-light text-sm">Aún no hay reseñas. ¡Sé el primero en calificar este negocio!</p>
                </div>
            </div>
        </div>

        <!-- CONTENIDO: INFORMACIÓN -->
        <div x-show="tab === 'informacion'" style="display: none;" x-transition.opacity.duration.300ms>
            <h2 class="text-xl font-bold text-[#0f172a] mb-6">Información del negocio</h2>
            
            <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
                <h3 class="font-bold text-lg text-[#0f172a] mb-6">Información del negocio</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">NOMBRE</p>
                        <p class="text-[#0f172a] font-medium text-sm">{{ $perfil['nombre'] }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">CATEGORÍA</p>
                        <p class="text-[#0f172a] font-medium text-sm">{{ $perfil['categoria'] }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">UBICACIÓN</p>
                        <p class="text-[#0f172a] font-medium text-sm">{{ $perfil['ubicacion_larga'] }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">HORARIO</p>
                        <p class="text-[#0f172a] font-medium text-sm">{{ $perfil['horario'] }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">TELÉFONO</p>
                        <p class="text-[#0f172a] font-medium text-sm">{{ $perfil['telefono'] }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">CORREO</p>
                        <p class="text-[#0f172a] font-medium text-sm">{{ $perfil['email'] }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">SITIO WEB</p>
                        <p class="text-[#0f172a] font-medium text-sm">{{ $perfil['web'] }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#2563eb] uppercase tracking-wider mb-1">ESTADO</p>
                        <p class="text-[#0f172a] font-bold text-sm flex items-center gap-1">
                            {{ $perfil['estado_info'] }} 
                            @if($perfil['estado_info'] == 'Verificado')
                                <span class="text-[#16a34a]">✓</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- MODALES DE RESEÑAS (ALPINE.JS)             -->
        <!-- ========================================== -->
        <div x-show="showReviewModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-[#0f172a]/40 backdrop-blur-sm" x-transition.opacity style="display: none;">
            
            <!-- PASO 1: FORMULARIO DE RESEÑA -->
            <div x-show="reviewStep === 1" @click.away="closeModal()" class="bg-white rounded-[24px] shadow-2xl w-full max-w-lg p-8 relative mx-4" x-transition>
                <button @click="closeModal()" class="text-[#2563eb] text-sm font-medium hover:underline mb-6 flex items-center gap-1">
                    &larr; Volver al perfil
                </button>
                
                <h3 class="text-2xl font-bold text-[#0f172a] mb-1">Califica tu experiencia</h3>
                <p class="text-[#2563eb] text-sm mb-8">¿Cómo fue tu experiencia con {{ $perfil['nombre'] }}?</p>
                
                <!-- Selector de Estrellas Interactivo -->
                <div class="mb-6">
                    <p class="text-[11px] font-bold text-[#0f172a] uppercase tracking-widest mb-3">Tu calificación *</p>
                    <div class="flex gap-2 justify-center mb-2">
                        <template x-for="i in 5">
                            <svg @click="rating = i" @mouseenter="hoverRating = i" @mouseleave="hoverRating = 0" 
                                 :class="(hoverRating || rating) >= i ? 'text-blue-100' : 'text-gray-50'"
                                 class="w-12 h-12 cursor-pointer transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </template>
                    </div>
                </div>

                <!-- Caja de Texto de Reseña -->
                <div class="mb-8">
                    <p class="text-[11px] font-bold text-[#0f172a] uppercase tracking-widest mb-3">Tu reseña</p>
                    <textarea x-model="reviewText" maxlength="500" rows="4" class="w-full border border-gray-100 bg-gray-50 rounded-xl p-4 text-sm focus:ring-2 focus:ring-[#2563eb] focus:bg-white focus:border-[#2563eb] outline-none resize-none placeholder-gray-400 transition-colors" placeholder="Cuéntanos sobre tu experiencia con este negocio..."></textarea>
                    <div class="text-right text-[#2563eb] text-xs font-medium mt-2">
                        <span x-text="reviewText.length"></span>/500
                    </div>
                </div>
                
                <!-- Botones de Acción -->
                <div class="flex gap-4">
                    <button @click="closeModal()" class="w-full py-3.5 rounded-xl border border-gray-200 text-[#0f172a] font-bold hover:bg-gray-50 transition">Cancelar</button>
                    <!-- El botón se desactiva si no has puesto estrellas o texto -->
                    <button @click="submitReview()" :disabled="rating === 0 || reviewText.trim() === ''" :class="rating === 0 || reviewText.trim() === '' ? 'opacity-50 cursor-not-allowed bg-gray-100 text-gray-400' : 'bg-[#eff6ff] text-[#2563eb] hover:bg-[#2563eb] hover:text-white'" class="w-full py-3.5 rounded-xl font-bold transition-colors">Enviar reseña</button>
                </div>
            </div>

            <!-- PASO 2: MENSAJE DE ÉXITO -->
            <div x-show="reviewStep === 2" @click.away="closeModal()" class="bg-white rounded-[32px] shadow-2xl w-full max-w-md p-10 text-center relative mx-4" x-transition style="display: none;">
                <div class="w-16 h-16 mx-auto text-[#2563eb] mb-6">
                    <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <h3 class="text-2xl font-extrabold text-[#0f172a] mb-2">¡Gracias por tu reseña!</h3>
                <p class="text-gray-500 text-sm mb-8 leading-relaxed">Tu opinión ayuda a otros usuarios a tomar mejores decisiones.</p>
                
                <button @click="closeModal()" class="w-full py-3.5 rounded-xl bg-[#2563eb] text-white font-bold hover:bg-blue-700 transition">Volver al negocio</button>
            </div>
            
        </div>
        <!-- ========================================== -->
    </main>

    <!-- FOOTER MANTENIDO -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @endif
</body>
</html>