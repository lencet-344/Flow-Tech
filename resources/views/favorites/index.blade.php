@if(auth()->check() && auth()->user()->role == 'usuario')
    <!-- ========================================================== -->
    <!-- NUEVA VISTA PREMIUM PARA "USUARIO" (CLIENTE/COMPRADOR)     -->
    <!-- ========================================================== -->
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mis Favoritos - SINGKI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
    <body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">
        
        <!-- Navbar Reciclado (Blanco y Limpio) -->
        <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100">
            <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
            </a>
            
            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-[#1F51FF] transition">Inicio</a>
                <a href="{{ url('/#categorias') }}" class="hover:text-[#1F51FF] transition">Categorías</a>
                <a href="#" class="hover:text-[#1F51FF] transition">Explorar</a>
            </nav>

            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                    {{ explode(' ', Auth::user()->name)[0] }}
                    <svg class="w-4 h-4 inline-block ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
            <div class="mb-8">
                <h1 class="text-[26px] font-extrabold text-[#0f172a] flex items-center gap-2 tracking-tight">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    Mis Favoritos
                </h1>
                <p class="text-[#1F51FF] text-[15px] mt-1 font-medium">{{ isset($favorites) ? $favorites->count() + 2 : 2 }} negocios guardados</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- TARJETA FIJA 1 -->
                <div class="bg-white rounded-2xl border border-indigo-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                    <div class="h-44 relative bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=500&q=80" class="w-full h-full object-cover" alt="Moda">
                        <div class="absolute top-3 left-3 bg-gradient-to-r from-[#8b5cf6] to-[#6366f1] text-white text-[10px] font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-sm uppercase tracking-wider">
                            <svg class="w-3 h-3 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            Premium
                        </div>
                    </div>
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-extrabold text-[#0f172a] text-[17px]">Moda Express</h3>
                            <span class="bg-[#dcfce7] text-[#166534] text-[10px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 border border-green-200">✓ Verificado</span>
                        </div>
                        <div class="mb-3"><span class="bg-[#eff6ff] text-[#2563eb] text-[11px] font-bold px-3 py-1 rounded-full">Moda</span></div>
                        <p class="text-gray-500 text-[13px] leading-relaxed mb-4 flex-grow font-light">Ropa y accesorios al por mayor. Colecciones para dama, caballero y niños.</p>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-4 mt-auto">
                            <div class="flex items-center gap-1.5 text-[13px]"><span class="text-yellow-400 text-lg leading-none">★</span><span class="font-bold text-[#0f172a]">4.6</span><span class="text-gray-400">(201)</span></div>
                            <span class="text-[#f59e0b] text-[13px] font-bold">Estelí</span>
                        </div>
                    </div>
                </div>

                <!-- TARJETA FIJA 2 -->
                <div class="bg-white rounded-2xl border border-indigo-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                    <div class="h-44 relative bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80" class="w-full h-full object-cover" alt="Tecnología">
                        <div class="absolute top-3 left-3 bg-gradient-to-r from-[#8b5cf6] to-[#6366f1] text-white text-[10px] font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-sm uppercase tracking-wider">
                            <svg class="w-3 h-3 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            Premium
                        </div>
                    </div>
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-extrabold text-[#0f172a] text-[17px]">TechSolutions GT</h3>
                            <span class="bg-[#dcfce7] text-[#166534] text-[10px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 border border-green-200">✓ Verificado</span>
                        </div>
                        <div class="mb-3"><span class="bg-[#eff6ff] text-[#2563eb] text-[11px] font-bold px-3 py-1 rounded-full">Tecnología</span></div>
                        <p class="text-gray-500 text-[13px] leading-relaxed mb-4 flex-grow font-light">Soluciones tecnológicas para empresas. Hardware, software y soporte técnico especializado.</p>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-4 mt-auto">
                            <div class="flex items-center gap-1.5 text-[13px]"><span class="text-yellow-400 text-lg leading-none">★</span><span class="font-bold text-[#0f172a]">4.8</span><span class="text-gray-400">(124)</span></div>
                            <span class="text-[#f59e0b] text-[13px] font-bold">Estelí</span>
                        </div>
                    </div>
                </div>

                <!-- BUCLE DINÁMICO (Datos Reales) -->
                @if(isset($favorites))
                    @foreach($favorites as $fav)
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                        <div class="h-44 relative bg-gray-50 flex items-center justify-center p-4">
                            <img src="https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500&q=80" class="max-w-full max-h-full object-contain" alt="Favorito">
                        </div>
                        <div class="p-5 flex-grow flex flex-col">
                            <h3 class="font-extrabold text-[#0f172a] text-[17px] mb-2">{{ $fav->name ?? $fav->product->name ?? 'Negocio Guardado' }}</h3>
                            <p class="text-gray-500 text-[13px] flex-grow font-light">Agregado recientemente a tu lista.</p>
                            <div class="flex justify-end border-t border-gray-100 pt-4 mt-auto">
                                <span class="text-[#1F51FF] text-[13px] font-bold hover:underline">Ver detalles &rarr;</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </main>

        @if(View::exists('components.footer'))
            @include('components.footer')
        @endif
    </body>
    </html>

@else
    <!-- ========================================================== -->
    <!-- VISTA ORIGINAL PARA ADMINISTRADORES / EMPRENDEDORES        -->
    <!-- ========================================================== -->
@extends(auth()->check() && auth()->user()->role == 'usuario' ? 'layouts.empty' : 'layouts.admin')

@section('content')
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Botón de Escape -->
    <div class="mb-6">
        <a href="{{ url('/') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold text-sm gap-2 transition-colors bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            &larr; Regresar al inicio
        </a>
    </div>

    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Mis Favoritos</h1>
        <p class="text-gray-500 text-sm mt-1">Los negocios y productos que has guardado</p>
    </div>

    <!-- Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total Favoritos</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $favorites->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Recientes</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $favorites->where('created_at', '>=', now()->subDays(7))->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Notificaciones</span>
            <span class="text-3xl font-bold text-[#040116]">0</span>
        </div>
    </div>

    <!-- Tabla Principal -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto / Negocio</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha de guardado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($favorites ?? [] as $favorite)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0 overflow-hidden">
                                    <img src="https://via.placeholder.com/50" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-[#040116]">{{ $favorite->product->name ?? 'Sin nombre' }}</h4>
                                    <p class="text-[13px] text-gray-500">{{ $favorite->product->supplier->name ?? 'Proveedor' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $favorite->created_at ? $favorite->created_at->format('Y-m-d') : date('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('favorites.destroy', $favorite->id ?? 0) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-lg text-xs font-semibold transition-colors">Eliminar</button>
                                </form>
                                <a href="{{ route('products.show', $favorite->product_id ?? 0) }}" class="bg-[#2563eb] hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors">Ver detalles</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">No tienes favoritos guardados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@endif