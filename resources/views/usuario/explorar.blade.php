@extends(auth()->check() && auth()->user()->role == 'usuario' ? 'layouts.empty' : 'layouts.admin')

@section('content')
    @if(auth()->check() && auth()->user()->role == 'usuario')
        <!-- ======================================================= -->
        <!-- VISTA PREMIUM MUTADA EXCLUSIVAMENTE PARA EL "USUARIO"   -->
        <!-- ======================================================= -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explorar Negocios - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Reciclado -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100 z-20 relative">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </a>
        
        <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
            <a href="{{ url('/') }}" class="hover:text-[#1F51FF] transition">Inicio</a>
            <a href="{{ url('/#categorias') }}" class="hover:text-[#1F51FF] transition">Categorías</a>
            <a href="#" class="text-[#1F51FF] font-bold">Explorar</a>
        </nav>

        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'S' }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Usuario' }}
            </span>
        </div>
    </header>

        <!-- ========================================== -->
    <!-- SECCIÓN 1: BARRA DE BÚSQUEDA               -->
    <!-- ========================================== -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="relative max-w-4xl mx-auto bg-white rounded-full flex items-center p-1.5 border border-gray-200 shadow-sm">
                <input type="text" placeholder="Busca negocios, productos o servicios..." class="w-full pl-6 pr-4 py-3 bg-transparent border-0 focus:ring-0 text-gray-700 text-[14px] outline-none">
                <button class="bg-[#1F51FF] hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-full transition shadow-sm text-[13px] tracking-wide shrink-0">BUSCAR</button>
            </div>
        </div>
    </div>
    <!-- ========================================== -->

    <!-- ========================================== -->
    <!-- SECCIÓN 2: MAIN GRID (SIDEBAR + RESULTADOS)-->
    <!-- ========================================== -->
        <!-- ========================================== -->
    <!-- MAIN GRID (SIMULADOR DE BASE DE DATOS)     -->
    <!-- ========================================== -->
        <!-- ========================================== -->
    <!-- MAIN GRID (SIMULADOR DE BASE DE DATOS)     -->
    <!-- ========================================== -->
    @php
        // 1. Atrapamos los parámetros de la URL
        $categoriaActual = request('categoria');
        $ordenActual = request('orden', 'calificacion'); // 'calificacion' por defecto

        // 2. Base de datos simulada
        $todosLosNegocios = [
            [
                'nombre' => 'TechSolutions GT', 'categoria' => 'Tecnología', 
                'desc' => 'Soluciones tecnológicas para empresas. Hardware, software y soporte técnico especializado.', 
                'rating' => '4.8', 'reviews' => '124', 
                'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80', 
                'premium' => true
            ],
            [
                'nombre' => 'Moda Express', 'categoria' => 'Moda', 
                'desc' => 'Ropa y accesorios al por mayor. Colecciones para dama, caballero y niños.', 
                'rating' => '4.6', 'reviews' => '201', 
                'img' => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=500&q=80', 
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
                'img' => 'https://images.unsplash.com/photo-1504307651254-35680f356f58?w=500&q=80', 
                'premium' => false
            ]
        ];

        // 3. Motor de Filtrado por Categoría
        if ($categoriaActual) {
            $negociosFiltrados = array_filter($todosLosNegocios, function($n) use ($categoriaActual) {
                return strtolower($n['categoria']) === strtolower($categoriaActual);
            });
        } else {
            $negociosFiltrados = $todosLosNegocios;
        }

        // 4. Motor de Ordenamiento (Rating o Reseñas)
        usort($negociosFiltrados, function($a, $b) use ($ordenActual) {
            if ($ordenActual === 'resenas') {
                return (int)$b['reviews'] <=> (int)$a['reviews']; // Mayor a menor reseñas
            }
            return (float)$b['rating'] <=> (float)$a['rating']; // Mayor a menor calificación
        });

        // 5. Separación para la vista
        $premium = array_filter($negociosFiltrados, fn($n) => $n['premium']);
        $normales = array_filter($negociosFiltrados, fn($n) => !$n['premium']);
        $totalResultados = count($negociosFiltrados);

        // 6. Funciones para pintar botones activos
        function clsActiva($cat, $actual) {
            if (!$actual && $cat === 'Todas') return 'bg-[#eff6ff] text-[#2563eb] font-bold';
            if ($actual && strtolower($cat) === strtolower($actual)) return 'bg-[#eff6ff] text-[#2563eb] font-bold';
            return 'text-[#475569] hover:bg-gray-50 hover:text-[#2563eb] font-medium';
        }
        
        function clsOrden($tipo, $actual) {
            if ($tipo === $actual) return 'bg-[#eff6ff] text-[#2563eb] font-bold';
            return 'text-[#475569] hover:bg-gray-50 hover:text-[#2563eb] font-medium';
        }
    @endphp

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex flex-col md:flex-row gap-8 items-start">
        
        <!-- SIDEBAR DE FILTROS -->
        <aside class="w-full md:w-64 bg-white rounded-[24px] p-6 shadow-sm border border-gray-100 shrink-0">
            <h2 class="font-extrabold text-[#0f172a] text-[18px] mb-6">Filtros</h2>
            
            <h3 class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-4">CATEGORÍA</h3>
            <ul class="space-y-1 mb-8">
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => null]) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Todas', $categoriaActual) }}">
                        <span class="w-[18px] h-[18px] flex items-center justify-center text-lg leading-none mt-[-2px] {{ !$categoriaActual ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}">≡</span> Todas las categorías
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Tecnología']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Tecnología', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'tecnología' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Tecnología
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Alimentos']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Alimentos', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'alimentos' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg> Alimentos
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Construcción']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Construcción', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'construcción' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 21a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0zM3 7h11v10H3V7zm11 2h4l3 3v5h-7V9z"/></svg> Construcción
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Salud']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Salud', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'salud' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg> Salud
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Moda']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Moda', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'moda' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 5c2-2 6-2 6-2s4 0 6 2l3 5-3 2v10H6V14L3 10l3-5z"/></svg> Moda
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Hogar']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Hogar', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'hogar' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Hogar
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Servicios']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Servicios', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'servicios' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg> Servicios
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Educación']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Educación', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'educación' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg> Educación
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Automoción']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Automoción', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'automoción' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 11h18M4 11l1.5-4h13L20 11m-16 0v6h2m12 0h2v-6M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4z"/></svg> Automoción
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Arte']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Arte', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'arte' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.042 2.164a2.987 2.987 0 014.225 4.225l-9.873 9.873-4.225 1.056 1.056-4.225 9.873-9.873z M13.5 4.5l3.5 3.5 M4.5 19.5h15"/></svg> Arte
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Deporte']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Deporte', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'deporte' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zM12 2v20M2 12h20M7.5 5.5a9 9 0 000 13M16.5 5.5a9 9 0 010 13"/></svg> Deporte
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Belleza']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Belleza', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'belleza' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 5c1.5-1.5 6.5-1.5 8 0l2 6-2 1v10H6V12l-2-1 2-6z M8 12h8"/></svg> Belleza
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Otros']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Otros', $categoriaActual) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower($categoriaActual) == 'otros' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg> ... Otros
                    </a>
                </li>
            </ul>

            <h3 class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-4">ORDENAR POR</h3>
            <ul class="space-y-1.5">
                <li><a href="{{ request()->fullUrlWithQuery(['orden' => 'calificacion']) }}" class="block px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsOrden('calificacion', $ordenActual) }}">Mejor calificados</a></li>
                <li><a href="{{ request()->fullUrlWithQuery(['orden' => 'resenas']) }}" class="block px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsOrden('resenas', $ordenActual) }}">Más reseñas</a></li>
            </ul>
        </aside>

        <!-- ÁREA DE RESULTADOS -->
        <div class="flex-1 min-w-0">
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-500 text-[14px] font-medium">{{ $totalResultados }} resultados {{ $categoriaActual ? 'en ' . $categoriaActual : '' }}</p>
                @if($ordenActual == 'resenas')
                    <span class="text-xs bg-blue-50 text-[#2563eb] px-3 py-1 rounded-full font-bold">Orden: Más reseñas</span>
                @else
                    <span class="text-xs bg-blue-50 text-[#2563eb] px-3 py-1 rounded-full font-bold">Orden: Mejor calificados</span>
                @endif
            </div>
            
            <!-- ESTADO VACÍO (SIN RESULTADOS) -->
            @if($totalResultados === 0)
            <div class="bg-white border-2 border-dashed border-gray-200 rounded-[24px] p-16 text-center shadow-sm flex flex-col items-center justify-center mt-4">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-[#0f172a] mb-2">No se encontraron resultados</h3>
                <p class="text-gray-500 text-sm max-w-sm mb-6">Por el momento no tenemos negocios registrados en la categoría <span class="font-bold text-[#2563eb]">{{ $categoriaActual }}</span>.</p>
                <a href="{{ url('/explorar') }}" class="bg-[#eff6ff] text-[#2563eb] font-bold px-6 py-2.5 rounded-full hover:bg-[#2563eb] hover:text-white transition duration-300">
                    Ver todas las categorías
                </a>
            </div>
            @endif

            @if(count($premium) > 0)
            <!-- Bloque Premium -->
            <div class="mb-10">
                <div class="inline-flex items-center gap-2 bg-[#f5f3ff] text-[#8b5cf6] px-4 py-1.5 rounded-full text-[11px] font-bold mb-5 border border-[#e0e7ff] shadow-sm uppercase tracking-wide">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    Negocios Premium Destacados
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($premium as $negocio)
                    <a href="{{ url('/perfil-publico?negocio=' . urlencode($negocio['nombre'])) }}" class="block bg-white border-2 border-[#e0e7ff] rounded-[24px] overflow-hidden hover:shadow-lg transition duration-300 flex flex-col relative cursor-pointer">
                        <div class="absolute top-4 left-4 bg-[#8b5cf6] text-white text-[10px] font-bold px-3 py-1.5 rounded-full z-10 flex items-center gap-1.5 shadow-sm uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> 
                            PREMIUM
                        </div>
                        <div class="h-40 relative bg-gray-100">
                            <img src="{{ $negocio['img'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start gap-2 mb-3">
                                <h3 class="font-extrabold text-[#0f172a] text-[16px]">{{ $negocio['nombre'] }}</h3>
                                <span class="shrink-0 bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-[10px] font-bold">✓ Verificado</span>
                            </div>
                            <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[11px] font-bold px-3 py-1 rounded-full mb-3 self-start">{{ $negocio['categoria'] }}</span>
                            <p class="text-gray-500 text-[13px] mb-6 flex-grow leading-relaxed font-light">{{ $negocio['desc'] }}</p>
                            <div class="flex justify-between items-center mt-auto border-t border-gray-100 pt-5">
                                <div class="flex items-center gap-1.5 text-[13px]"><span class="text-yellow-400 text-base leading-none">★</span><span class="font-bold text-[#0f172a]">{{ $negocio['rating'] }}</span><span class="text-gray-400 font-light text-[11px]">({{ $negocio['reviews'] }})</span></div>
                                <span class="text-[13px] text-[#fb923c] font-bold">Estelí</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if(count($normales) > 0)
            <!-- Bloque Normales -->
            <div>
                <h3 class="text-[12px] font-bold text-gray-400 tracking-widest uppercase mb-5">OTROS NEGOCIOS</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($normales as $negocio)
                    <a href="{{ url('/perfil-publico?negocio=' . urlencode($negocio['nombre'])) }}" class="block bg-white border border-gray-200 rounded-[24px] overflow-hidden hover:shadow-lg transition duration-300 flex flex-col cursor-pointer">
                        <div class="h-40 relative bg-gray-100">
                            <img src="{{ $negocio['img'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start gap-2 mb-3">
                                <h3 class="font-extrabold text-[#0f172a] text-[16px]">{{ $negocio['nombre'] }}</h3>
                                <span class="shrink-0 bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-[10px] font-bold">✓ Verificado</span>
                            </div>
                            <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[11px] font-bold px-3 py-1 rounded-full mb-3 self-start">{{ $negocio['categoria'] }}</span>
                            <p class="text-gray-500 text-[13px] mb-6 flex-grow leading-relaxed font-light">{{ $negocio['desc'] }}</p>
                            <div class="flex justify-between items-center mt-auto border-t border-gray-100 pt-5">
                                <div class="flex items-center gap-1.5 text-[13px]"><span class="text-yellow-400 text-base leading-none">★</span><span class="font-bold text-[#0f172a]">{{ $negocio['rating'] }}</span><span class="text-gray-400 font-light text-[11px]">({{ $negocio['reviews'] }})</span></div>
                                <span class="text-[13px] text-[#fb923c] font-bold">Estelí</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>
    <!-- ========================================== -->

    <!-- Footer -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @endif
</body>
</html>

    @else
        <!-- ======================================================= -->
        <!-- VISTA CRUDA ORIGINAL PARA ADMINS / EMPRENDEDORES        -->
        <!-- ======================================================= -->
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Botón de Escape -->
    <div class="mb-6">
        <a href="{{ url('/') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold text-sm gap-2 transition-colors bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            &larr; Regresar al inicio
        </a>
    </div>

    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Negocios y Empresas</h1>
        <p class="text-gray-500 text-sm mt-1">Directorio de proveedores y negocios afiliados</p>
    </div>

    <!-- Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total Empresas</span>
            <span class="text-3xl font-bold text-[#040116]">{{ isset($companies) ? $companies->count() : 0 }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Verificadas</span>
            <span class="text-3xl font-bold text-[#040116]">{{ isset($companies) ? $companies->count() : 0 }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Nuevas esta semana</span>
            <span class="text-3xl font-bold text-[#040116]">{{ isset($companies) ? $companies->where('created_at', '>=', now()->subDays(7))->count() : 0 }}</span>
        </div>
    </div>

    <!-- Tabla Principal (Directorio) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Empresa</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Contacto</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Dirección</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Categoría / Tipo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($companies ?? [] as $company)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-[#eff6ff] text-[#2563eb] rounded-xl flex items-center justify-center shrink-0 font-bold text-lg">
                                    {{ strtoupper(substr($company->name ?? 'E', 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-[#040116]">{{ $company->name ?? 'Sin nombre' }}</h4>
                                    <a href="{{ route('products.index') }}" class="text-[#3b82f6] text-[12px] font-medium hover:underline">Ver productos &rarr;</a>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ $company->email ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-600 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $company->telephone ?? 'N/A' }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="max-w-[200px] truncate block" title="{{ $company->address ?? 'N/A' }}">{{ $company->address ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-[#f8fafc] border border-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $company->type_product ?? 'General' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <p class="text-lg font-medium">No hay empresas registradas</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
    @endif
@endsection