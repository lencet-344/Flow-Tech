@php
    // 0. Leemos la categoría y el orden de la URL (si existen)
    $categoriaSeleccionada = request('categoria');
    $ordenActual = request('orden', 'calificacion');

    // 1. Verificamos si la variable $companies existe y contamos resultados
    $totalResultados = isset($companies) ? $companies->count() : 0;
    
    // 2. Separación de negocios premium y normales (si $companies existe)
    $premium = isset($companies) ? $companies->where('is_premium', true) : [];
    $normales = isset($companies) ? $companies->where('is_premium', '!=', true) : [];

    // 3. Funciones de ayuda para los estilos del menú
    if (!function_exists('clsActiva')) {
        function clsActiva($item, $actual) {
            // Comparamos ignorando mayúsculas/minúsculas para evitar errores
            if (strtolower($item) === strtolower($actual)) return 'bg-[#eff6ff] text-[#2563eb] font-bold';
            return 'text-[#475569] hover:bg-gray-50 hover:text-[#2563eb] font-medium';
        }
    }

    if (!function_exists('clsOrden')) {
        function clsOrden($tipo, $actual) {
            if ($tipo === $actual) return 'bg-[#eff6ff] text-[#2563eb] font-bold';
            return 'text-[#475569] hover:bg-gray-50 hover:text-[#2563eb] font-medium';
        }
    }
@endphp

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

    <!-- SECCIÓN 1: BARRA DE BÚSQUEDA -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="relative max-w-4xl mx-auto bg-white rounded-full flex items-center p-1.5 border border-gray-200 shadow-sm">
                <input type="text" placeholder="Busca negocios, productos o servicios..." class="w-full pl-6 pr-4 py-3 bg-transparent border-0 focus:ring-0 text-gray-700 text-[14px] outline-none">
                <button class="bg-[#1F51FF] hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-full transition shadow-sm text-[13px] tracking-wide shrink-0">BUSCAR</button>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 2: MAIN GRID (SIDEBAR + RESULTADOS) -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex flex-col md:flex-row gap-8 items-start">
        
        <!-- SIDEBAR DE FILTROS -->
        <aside class="w-full md:w-64 bg-white rounded-[24px] p-6 shadow-sm border border-gray-100 shrink-0">
            <h2 class="font-extrabold text-[#0f172a] text-[18px] mb-6">Filtros</h2>
            
            <h3 class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-4">CATEGORÍA</h3>
            <ul class="space-y-1 mb-8">
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => null]) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ !isset($categoriaSeleccionada) ? 'bg-[#eff6ff] text-[#2563eb] font-bold' : 'text-[#475569] hover:bg-gray-50' }}">
                        <span class="w-[18px] h-[18px] flex items-center justify-center text-lg leading-none mt-[-2px] {{ !isset($categoriaSeleccionada) ? 'text-[#2563eb]' : 'text-gray-400' }}">≡</span> Todas las categorías
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Tecnología']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Tecnología', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'tecnología' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Tecnología
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Alimentos']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Alimentos', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'alimentos' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg> Alimentos
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Construcción']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Construcción', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'construcción' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 21a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0zM3 7h11v10H3V7zm11 2h4l3 3v5h-7V9z"/></svg> Construcción
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Salud']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Salud', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'salud' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg> Salud
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Moda']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Moda', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'moda' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 5c2-2 6-2 6-2s4 0 6 2l3 5-3 2v10H6V14L3 10l3-5z"/></svg> Moda
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Hogar']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Hogar', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'hogar' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Hogar
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Servicios']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Servicios', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'servicios' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Servicios
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Educación']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Educación', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'educación' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg> Educación
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Automoción']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Automoción', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'automoción' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12.5M3 11h18M4 11l1.5-4h13L20 11m-16 0v6h2m12 0h2v-6M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4z"/></svg> Automoción
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Arte']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Arte', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'arte' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.042 2.164a2.987 2.987 0 014.225 4.225l-9.873 9.873-4.225 1.056 1.056-4.225 9.873-9.873z M13.5 4.5l3.5 3.5 M4.5 19.5h15"/></svg> Arte
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Deporte']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Deporte', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'deporte' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zM12 2v20M2 12h20M7.5 5.5a9 9 0 000 13M16.5 5.5a9 9 0 010-13"/></svg> Deporte
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Belleza']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Belleza', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'belleza' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 5c1.5-1.5 6.5-1.5 8 0l2 6-2 1v10H6V12l-2-1 2-6z M8 12h8"/></svg> Belleza
                    </a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => 'Otros']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] transition-colors {{ clsActiva('Otros', $categoriaSeleccionada) }}">
                        <svg class="w-[18px] h-[18px] {{ strtolower(request('categoria') ?? '') == 'otros' ? 'text-[#2563eb]' : 'text-[#3b82f6]' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg> Otros
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
                <p class="text-gray-500 text-[14px] font-medium">{{ $totalResultados }} resultados {{ isset($categoriaSeleccionada) ? 'en ' . $categoriaSeleccionada : '' }}</p>
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
                <p class="text-gray-500 text-sm max-w-sm mb-6">Por el momento no tenemos negocios registrados en la categoría <span class="font-bold text-[#2563eb]">{{ isset($categoriaSeleccionada) ? $categoriaSeleccionada : 'seleccionada' }}</span>.</p>
                <a href="{{ url('/explorar') }}" class="bg-[#eff6ff] text-[#2563eb] font-bold px-6 py-2.5 rounded-full hover:bg-[#2563eb] hover:text-white transition duration-300">
                    Ver todas las categorías
                </a>
            </div>
            @endif

            <!-- Bloque Premium -->
            @if(count($premium) > 0)
            <div class="mb-10">
                <div class="inline-flex items-center gap-2 bg-[#f5f3ff] text-[#8b5cf6] px-4 py-1.5 rounded-full text-[11px] font-bold mb-5 border border-[#e0e7ff] shadow-sm uppercase tracking-wide">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    Negocios Premium Destacados
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($premium as $negocio)
                    <a href="{{ url('/perfil-publico?negocio=' . urlencode($negocio->name)) }}" class="block bg-white border-2 border-[#e0e7ff] rounded-[24px] overflow-hidden hover:shadow-lg transition duration-300 flex flex-col relative cursor-pointer">
                        <div class="absolute top-4 left-4 bg-[#8b5cf6] text-white text-[10px] font-bold px-3 py-1.5 rounded-full z-10 flex items-center gap-1.5 shadow-sm uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> 
                            PREMIUM
                        </div>

                        <!-- LÓGICA DE IMAGEN O INICIALES -->
                        <div class="h-40 w-full relative bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if(!empty($negocio->logo))
                                <img src="{{ asset('storage/' . $negocio->logo) }}" alt="{{ $negocio->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#1F51FF] to-indigo-600">
                                    <span class="text-3xl font-extrabold text-white tracking-widest uppercase">
                                        {{ mb_substr($negocio->name, 0, 2) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start gap-2 mb-3">
                                <h3 class="font-extrabold text-[#0f172a] text-[16px] line-clamp-1">{{ $negocio->name }}</h3>
                                <span class="shrink-0 bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-[10px] font-bold">✓ Verificado</span>
                            </div>
                            <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[11px] font-bold px-3 py-1 rounded-full mb-3 self-start">
                                {{ $negocio->category->name ?? (isset($categoriaSeleccionada) ? $categoriaSeleccionada : 'Categoría') }}
                            </span>
                            <p class="text-gray-500 text-[13px] mb-6 flex-grow leading-relaxed font-light line-clamp-2">{{ $negocio->description ?? 'Sin descripción disponible.' }}</p>
                            <div class="flex justify-between items-center mt-auto border-t border-gray-100 pt-5">
                                <div class="flex items-center gap-1.5 text-[13px]">
                                    <span class="text-yellow-400 text-base leading-none">★</span>
                                    <span class="font-bold text-[#0f172a]">{{ $negocio->rating ?? '5.0' }}</span>
                                    <span class="text-gray-400 font-light text-[11px]">({{ $negocio->reviews ?? '+10' }})</span>
                                </div>
                                <span class="text-[13px] text-[#fb923c] font-bold">{{ $negocio->city ?? 'Estelí' }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Bloque Normales -->
            @if(count($normales) > 0)
            <div>
                <h3 class="text-[12px] font-bold text-gray-400 tracking-widest uppercase mb-5">OTROS NEGOCIOS</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($normales as $negocio)
                    <a href="{{ url('/perfil-publico?negocio=' . urlencode($negocio->name)) }}" class="block bg-white border border-gray-200 rounded-[24px] overflow-hidden hover:shadow-lg transition duration-300 flex flex-col cursor-pointer">
                        
                        <!-- LÓGICA DE IMAGEN O INICIALES -->
                        <div class="h-40 w-full relative bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if(!empty($negocio->logo))
                                <img src="{{ asset('storage/' . $negocio->logo) }}" alt="{{ $negocio->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#1F51FF] to-indigo-600">
                                    <span class="text-3xl font-extrabold text-white tracking-widest uppercase">
                                        {{ mb_substr($negocio->name, 0, 2) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start gap-2 mb-3">
                                <h3 class="font-extrabold text-[#0f172a] text-[16px] line-clamp-1">{{ $negocio->name }}</h3>
                            </div>
                            <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[11px] font-bold px-3 py-1 rounded-full mb-3 self-start">
                                {{ $negocio->category->name ?? (isset($categoriaSeleccionada) ? $categoriaSeleccionada : 'Categoría') }}
                            </span>
                            <p class="text-gray-500 text-[13px] mb-6 flex-grow leading-relaxed font-light line-clamp-2">{{ $negocio->description ?? 'Sin descripción disponible.' }}</p>
                            <div class="flex justify-between items-center mt-auto border-t border-gray-100 pt-5">
                                <div class="flex items-center gap-1.5 text-[13px]">
                                    <span class="text-yellow-400 text-base leading-none">★</span>
                                    <span class="font-bold text-[#0f172a]">{{ $negocio->rating ?? '5.0' }}</span>
                                    <span class="text-gray-400 font-light text-[11px]">({{ $negocio->reviews ?? '+10' }})</span>
                                </div>
                                <span class="text-[13px] text-[#fb923c] font-bold">{{ $negocio->city ?? 'Estelí' }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @endif
</body>
</html>