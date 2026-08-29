<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil Público - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-[#f8fafc]">
    <!-- BARRA DE NAVEGACIÓN PÚBLICA DINÁMICA -->
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center w-full sticky top-0 z-50 shadow-sm">
        
        <!-- Izquierda: Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-[#2563eb] hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-2xl tracking-tighter">SINGKI</span>
        </a>

        <!-- Centro: Enlaces -->
        <div class="hidden md:flex items-center gap-8 text-[15px] font-medium text-gray-800">
            <a href="{{ url('/') }}" class="hover:text-[#2563eb] transition-colors">Inicio</a>
            @auth
                <!-- Solo visible si el usuario tiene sesión -->
                <a href="{{ url('/admin/dashboard') }}" class="hover:text-[#2563eb] transition-colors">Dashboard</a>
            @endauth
        </div>

        <!-- Derecha: Acciones y Usuario -->
        <div class="flex items-center gap-4">
            @auth
                <!-- Botón Premium -->
                <a href="{{ url('/premium/success') }}" class="bg-[#8b5cf6] hover:bg-[#7c3aed] text-white px-4 py-2.5 rounded-full text-[13px] font-bold flex items-center gap-1.5 shadow-sm transition-colors">
                    <svg class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    Hazte Premium
                </a>
                
                <!-- Menú de Usuario Dinámico -->
                <div class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 px-2 py-1.5 rounded-lg transition-colors">
                    <div class="w-8 h-8 bg-[#e0e7ff] text-[#2563eb] rounded-full flex items-center justify-center font-bold text-sm uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-[14px] font-medium text-gray-700">
                        {{ explode(' ', Auth::user()->name)[0] }}
                    </span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            @else
                <!-- Vista para visitantes sin sesión -->
                <a href="{{ route('login') }}" class="text-[#2563eb] font-medium text-[15px] hover:underline">Iniciar sesión</a>
            @endauth
        </div>
    </nav>
    <!-- WRAPPER CLARO PARA ANULAR EL FONDO DEL LAYOUT -->
    <div class="bg-[#f8fafc] w-full min-h-screen">
        
        <!-- 1. Portada (Cover) -->
        <div class="w-full h-64 lg:h-80 bg-gradient-to-r from-[#1e293b] via-[#2563eb] to-[#38bdf8] overflow-hidden relative shadow-inner">
            <!-- Diseño limpio sin fotografía -->
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        <!-- Contenedor Principal (Tarjetas y Tabla) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 pb-20">
        
        <!-- 2. Tarjeta de Información del Negocio -->
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 lg:p-8 mb-8">
            <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-center">
                <!-- Avatar / Logo -->
                <div class="w-24 h-24 bg-gray-100 rounded-2xl shrink-0 overflow-hidden border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=200&q=80" alt="Logo" class="w-full h-full object-cover">
                </div>
                
                <!-- Info Principal -->
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-2">
                        <h1 class="text-2xl font-bold text-[#040116]">TechSolutions GT</h1>
                        <!-- Badges -->
                        <span class="inline-flex items-center gap-1 bg-green-50 text-green-600 px-2.5 py-1 rounded-full text-xs font-bold border border-green-200"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>Verificado</span>
                        <span class="inline-flex items-center gap-1 bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-2.5 py-1 rounded-full text-xs font-bold shadow-sm"><svg class="w-3 h-3 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>PREMIUM</span>
                    </div>
                    <span class="inline-block bg-blue-50 text-[#2563eb] px-3 py-1 rounded-lg text-xs font-semibold mb-3">Tecnología</span>
                    <p class="text-gray-500 text-sm max-w-3xl">Soluciones tecnológicas para empresas. Hardware, software y soporte técnico especializado.</p>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex flex-wrap items-center gap-3 mt-6 pb-6 border-b border-gray-100">
                <button class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>Favorito</button>
                <button class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>Ver ubicación</button>
                <button class="flex items-center gap-2 px-8 py-2.5 rounded-full bg-[#2563eb] text-white font-medium hover:bg-blue-700 transition text-sm shadow-md"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>Chatear</button>
            </div>

            <!-- Datos de Contacto Inferiores -->
            <div class="flex flex-wrap items-center justify-between gap-4 mt-4">
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                    <div class="flex items-center gap-1.5"><span class="text-yellow-400 text-lg">★★★★★</span><span class="font-bold text-[#040116]">4.8</span> <span class="text-xs text-gray-400">(124 reseñas)</span></div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>Estelí, Barrio El Rosario</div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Lun-Vie 8:00-18:00</div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>info@techsolutionsgt.com</div>
                </div>
                <button class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-800 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>Reportar negocio</button>
            </div>
        </div>

        <!-- 3. Pestañas (Tabs) -->
        <div class="flex items-center gap-2 mb-8">
            <button class="bg-[#2563eb] text-white px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 shadow-md"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>Productos y Stock</button>
            <button class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 shadow-sm transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>Reseñas</button>
            <button class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 shadow-sm transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Información</button>
        </div>

        <!-- 4. Sección de Tabla de Productos -->
        <div class="mb-6 flex justify-between items-end">
            <h2 class="text-xl font-bold text-[#040116]">Productos y disponibilidad</h2>
            <div class="flex gap-2">
                <span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-lg text-xs font-bold">4 disponibles</span>
                <span class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-lg text-xs font-bold">2 agotados</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-12">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Marca</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <div class="divide-y divide-gray-50">
                        <!-- Producto Disponible -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200"><img src="https://images.unsplash.com/photo-1531297172869-c7d69818c599?w=100&q=80" alt="Prod" class="w-full h-full object-cover"></div>
                                    <div>
                                        <h4 class="text-sm font-bold text-[#040116]">Laptop HP EliteBook 840</h4>
                                        <p class="text-xs text-gray-500">HP-840-G9</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">HP</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">12</td>
                            <td class="px-6 py-4"><span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span></td>
                            <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 28.500</td>
                            <td class="px-6 py-4 text-right"><button class="border border-[#2563eb] text-[#2563eb] hover:bg-blue-50 text-xs font-semibold px-5 py-2 rounded-lg transition-colors">Consultar</button></td>
                        </tr>
                        <!-- Producto Agotado -->
                        <tr class="hover:bg-gray-50 transition-colors border-t border-gray-100">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200"><img src="https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=100&q=80" alt="Prod" class="w-full h-full object-cover"></div>
                                    <div>
                                        <h4 class="text-sm font-bold text-[#040116]">Monitor Dell 27'' 4K</h4>
                                        <p class="text-xs text-gray-500">DELL-27-4K</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Dell</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-400">—</td>
                            <td class="px-6 py-4"><span class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Agotado</span></td>
                            <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 4200</td>
                            <td class="px-6 py-4 text-right"><button class="bg-[#2563eb] hover:bg-blue-700 text-white shadow-sm text-xs font-semibold px-5 py-2 rounded-lg transition-colors">Reservar</button></td>
                        </tr>
                        <!-- Producto Disponible 2 -->
                        <tr class="hover:bg-gray-50 transition-colors border-t border-gray-100">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200"><img src="https://images.unsplash.com/photo-1527814050087-379381547962?w=100&q=80" alt="Prod" class="w-full h-full object-cover"></div>
                                    <div>
                                        <h4 class="text-sm font-bold text-[#040116]">Mouse Logitech MX Master 3</h4>
                                        <p class="text-xs text-gray-500">LOG-MXM3</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Logitech</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">35</td>
                            <td class="px-6 py-4"><span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span></td>
                            <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ 650</td>
                            <td class="px-6 py-4 text-right"><button class="border border-[#2563eb] text-[#2563eb] hover:bg-blue-50 text-xs font-semibold px-5 py-2 rounded-lg transition-colors">Consultar</button></td>
                        </tr>
                    </div>
                </table>
            </div>
        </div>
    </div>

    </div>

    <!-- 5. Componente Footer Original -->
    @include('components.footer')
</body>
</html>
