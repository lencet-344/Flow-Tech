@php
    // Salvavidas: Si el controlador no manda la variable, tomamos la del usuario actual o la primera que exista.
    if (!isset($company)) {
        try {
            $company = \App\Models\Company::where('user_id', auth()->id())->first() ?? \App\Models\Company::first() ?? new \App\Models\Company();
        } catch(\Exception $e) {
            $company = \App\Models\Company::first() ?? new \App\Models\Company();
        }
    }
@endphp
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
        <div x-data="{ tab: 'productos', isFavorite: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 pb-20">
        
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
                <button @click="isFavorite = !isFavorite" class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm group">
                    <svg :class="isFavorite ? 'text-red-500 scale-125' : 'text-gray-400 group-hover:scale-110'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isFavorite" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        <path x-show="isFavorite" style="display: none;" fill="currentColor" stroke="none" d="M3.172 5.172a4 4 0 015.656 0L12 8.343l3.172-3.171a4 4 0 115.656 5.656L12 21.657l-8.828-8.829a4 4 0 010-5.656z"></path>
                    </svg>
                    Favorito
                </button>
                <a href="https://maps.google.com/?q={{ urlencode($company->address ?? 'Nicaragua') }}" target="_blank" class="flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-sm shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Ver ubicación
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->telephone ?? '') }}" target="_blank" class="flex items-center gap-2 px-8 py-2.5 rounded-full bg-[#2563eb] text-white font-medium hover:bg-blue-700 transition text-sm shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Chatear
                </a>
            </div>

            <!-- Datos de Contacto Inferiores -->
            <div class="flex flex-wrap items-center justify-between gap-4 mt-4">
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                    <div class="flex items-center gap-1.5"><span class="text-yellow-400 text-lg">★★★★★</span><span class="font-bold text-[#040116]">4.8</span> <span class="text-xs text-gray-400">(124 reseñas)</span></div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>Estelí, Barrio El Rosario</div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Lun-Vie 8:00-18:00</div>
                    <div class="flex items-center gap-1.5"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>info@techsolutionsgt.com</div>
                </div>
                <div x-data="{ reportModal: false, reportStep: 1 }" class="inline-block">
                    <button @click="reportModal = true; reportStep = 1" class="flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 transition-colors duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                        Reportar negocio
                    </button>

                    <!-- Modal Overlay -->
                    <div x-show="reportModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-50" x-transition.opacity style="display: none;">
                        
                        <!-- Modal Card -->
                        <div @click.away="reportModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative mx-4">
                            
                            <!-- Botón de Cerrar (X) -->
                            <button @click="reportModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <!-- Paso 1: Formulario de Reporte -->
                            <div x-show="reportStep === 1" x-transition.opacity>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Reportar este negocio</h3>
                                <p class="text-sm text-gray-500 mb-5">Ayúdanos a mantener una comunidad segura. ¿Qué sucede con este negocio?</p>
                                
                                <textarea rows="4" placeholder="¿Por qué estás reportando este negocio?" class="w-full border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm p-3 outline-none bg-gray-50 mb-2 transition-shadow resize-none"></textarea>
                                
                                <div class="flex gap-3 justify-end mt-4">
                                    <button @click="reportModal = false" class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Cancelar</button>
                                    <button @click="reportStep = 2" class="px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors shadow-sm">Enviar reporte</button>
                                </div>
                            </div>

                            <!-- Paso 2: Mensaje de Éxito -->
                            <div x-show="reportStep === 2" class="text-center py-4" style="display: none;" x-transition.opacity>
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-green-600 mb-2">¡Reporte enviado con éxito!</h3>
                                <p class="text-gray-500 text-sm mb-8">Hemos recibido tu reporte y nuestro equipo de moderación lo revisará a la brevedad.</p>
                                <button @click="reportModal = false" class="w-full px-5 py-3 text-sm font-semibold text-white bg-gray-900 hover:bg-black rounded-xl transition-colors shadow-sm">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

                <!-- 3. Pestañas (Tabs) -->
        <div class="flex items-center gap-2 mb-8">
            <button @click="tab = 'productos'" :class="tab === 'productos' ? 'bg-[#2563eb] text-white shadow-md' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 shadow-sm'" class="px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Productos y Stock
            </button>
            <button @click="tab = 'reseñas'" :class="tab === 'reseñas' ? 'bg-[#2563eb] text-white shadow-md' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 shadow-sm'" class="px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Reseñas
            </button>
            <button @click="tab = 'informacion'" :class="tab === 'informacion' ? 'bg-[#2563eb] text-white shadow-md' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 shadow-sm'" class="px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Información
            </button>
        </div>

                <!-- 4. Contenedores de Pestañas -->
        
        <!-- Pestaña: PRODUCTOS -->
        <div x-show="tab === 'productos'" x-transition>
                                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
                <h2 class="text-xl font-bold text-[#040116]">Productos y disponibilidad</h2>
                <div class="flex gap-2">
                    <span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-lg text-xs font-bold">{{ isset($company) && $company->id ? $company->inventories()->where('quantity', '>', 0)->count() : 0 }} disponibles</span>
                    <span class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-lg text-xs font-bold">{{ isset($company) && $company->id ? $company->inventories()->where('quantity', '<=', 0)->count() : 0 }} agotados</span>
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
                        <tbody class="divide-y divide-gray-50">
                            @forelse(isset($company) && $company->id ? $company->inventories : [] as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-gray-100 rounded-lg shrink-0 overflow-hidden border border-gray-200">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->product->name ?? 'P') }}&color=2563eb&background=eff6ff" alt="{{ $item->product->name ?? 'Producto' }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-bold text-[#040116]">{{ $item->product->name ?? 'Producto' }}</h4>
                                                @if($item->product->code_bar)
                                                    <p class="text-xs text-gray-500">{{ $item->product->code_bar }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->product->brand->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold {{ $item->quantity > 0 ? 'text-gray-800' : 'text-gray-400' }}">{{ $item->quantity > 0 ? $item->quantity : '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if($item->quantity > 0)
                                            <span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span>
                                        @else
                                            <span class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Agotado</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-[#2563eb]">C$ {{ number_format($item->unit_cost ?? 0, 2) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        @if($item->quantity > 0)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->telephone ?? '') }}?text={{ urlencode('Hola, vi tu perfil en SINGKI. Me interesa consultar sobre el producto: ' . ($item->product->name ?? 'Producto')) }}" target="_blank" class="inline-block border border-[#2563eb] text-[#2563eb] hover:bg-blue-50 text-xs font-semibold px-5 py-2 rounded-lg transition-colors text-center">Consultar</a>
                                        @else
                                            <button class="bg-gray-100 text-gray-400 text-xs font-semibold px-5 py-2 rounded-lg cursor-not-allowed" disabled>Agotado</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-sm">
                                        Este negocio aún no tiene productos publicados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pestaña: RESEÑAS -->
        <div x-show="tab === 'reseñas'" x-transition style="display: none;">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center text-gray-500 mb-12">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Aún no hay reseñas</h3>
                <p class="text-sm">Sé el primero en compartir tu experiencia con este negocio.</p>
            </div>
        </div>

        <!-- Pestaña: INFORMACIÓN -->
        <div x-show="tab === 'informacion'" x-transition style="display: none;">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center text-gray-500 mb-12">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Acerca de {{ $company->name ?? 'este negocio' }}</h3>
                <p class="max-w-2xl mx-auto text-sm">{{ $company->description ?? 'No hay información adicional disponible por el momento.' }}</p>
            </div>
        </div>
    </div>

    </div>

    <!-- 5. Componente Footer Original -->
    @include('components.footer')
</body>
</html>
