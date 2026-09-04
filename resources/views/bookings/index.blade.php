@extends(auth()->check() && auth()->user()->role == 'usuario' ? 'layouts.empty' : 'layouts.admin')

@section('content')
    @if(auth()->check() && auth()->user()->role == 'usuario')
        <!-- ========================================================== -->
        <!-- VISTA PREMIUM PARA "USUARIO" (MIS RESERVAS)                -->
        <!-- ========================================================== -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Mis Reservas - SINGKI</title>
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
        <body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">
            
            <!-- Navbar Reciclado -->
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
            <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
                
                <!-- Encabezado -->
                <div class="mb-10">
                    <h1 class="text-[26px] font-extrabold text-[#0f172a] flex items-center gap-3 tracking-tight">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Mis Reservas
                    </h1>
                    <p class="text-gray-500 text-[15px] mt-2 font-light">Productos agotados que reservaste para cuando estén disponibles</p>
                </div>

                <!-- Lista de Reservas (Ejemplos Fijos) -->
                <div class="space-y-6">
                    
                    <!-- Tarjeta 1: Pendiente -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row justify-between items-start mb-4 gap-4">
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-[#eff6ff] text-[#2563eb] px-3 py-1.5 rounded-full text-[11px] font-bold">Pendiente</span>
                                <span class="bg-[#dcfce7] text-[#166534] px-3 py-1.5 rounded-full text-[11px] font-bold flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg> 
                                    Notificación activa
                                </span>
                            </div>
                            <div class="flex gap-3 w-full sm:w-auto">
                                <button class="flex-1 sm:flex-none border border-gray-300 text-[#0f172a] hover:bg-gray-50 px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Ver negocio</button>
                                <a href="{{ url('/chat/proveedor') }}" class="flex-1 sm:flex-none bg-[#1F51FF] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-sm text-center">Chatear</a>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-[18px] font-bold text-[#0f172a] mb-1">Monitor Dell 27" 4K</h3>
                            <p class="text-gray-600 text-[14.5px] mb-2 font-medium">TechSolutions GT</p>
                            <p class="text-gray-400 text-[13px] font-light">Reservado el 2026-08-15</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Notificado (Con Franja Verde) -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow overflow-hidden relative">
                        <div class="flex flex-col sm:flex-row justify-between items-start mb-4 gap-4">
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-[#dcfce7] text-[#166534] px-3 py-1.5 rounded-full text-[11px] font-bold">Notificado</span>
                                <span class="bg-[#dcfce7] text-[#166534] px-3 py-1.5 rounded-full text-[11px] font-bold flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg> 
                                    Notificación activa
                                </span>
                            </div>
                            <div class="flex gap-3 w-full sm:w-auto">
                                <button class="flex-1 sm:flex-none border border-gray-300 text-[#0f172a] hover:bg-gray-50 px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Ver negocio</button>
                                <a href="{{ url('/chat/proveedor') }}" class="flex-1 sm:flex-none bg-[#1F51FF] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-sm text-center">Chatear</a>
                            </div>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-[18px] font-bold text-[#0f172a] mb-1">Teclado Mecánico Keychron K2</h3>
                            <p class="text-gray-600 text-[14.5px] mb-2 font-medium">TechSolutions GT</p>
                            <p class="text-gray-400 text-[13px] font-light">Reservado el 2026-08-01</p>
                        </div>
                        <!-- Franja Verde Inferior (Márgenes negativos para tocar los bordes) -->
                        <div class="bg-[#dcfce7] text-[#166534] text-[13.5px] font-medium p-4 -mx-6 -mb-6 border-t border-green-200">
                            ¡El producto ya está disponible! Contacta al negocio para coordinar.
                        </div>
                    </div>

                </div>
            </main>

            <!-- Footer -->
            @if(View::exists('components.footer'))
                @include('components.footer')
            @endif
        </body>
        </html>

    @else
        <!-- ========================================================== -->
        <!-- VISTA ORIGINAL PARA ADMINISTRADORES / PROVEEDORES          -->
        <!-- ========================================================== -->
<div class="p-8 md:p-10">
    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Reservas</h1>
        <p class="text-gray-500 text-sm mt-1">Clientes que reservaron productos agotados</p>
    </div>

    <!-- 3 Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total reservas</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $bookings->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Pendientes</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $bookings->where('status', 'Pendiente')->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Notificados</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $bookings->where('status', 'Pendiente')->count() }}</span>
        </div>
    </div>

    <!-- Tabla Principal -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Notificación</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($reservas ?? [] as $reserva)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg shrink-0">
                                    <img src="{{ $reserva->producto->img ?? 'https://via.placeholder.com/100' }}" class="w-full h-full object-cover rounded-lg">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-[#040116]">{{ $reserva->producto->nombre ?? 'Producto no encontrado' }}</h4>
                                    <p class="text-[13px] text-gray-500">{{ $reserva->producto->proveedor->nombre ?? 'Proveedor' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $reserva->fecha ?? date('Y-m-d') }}</td>
                        <td class="px-6 py-4">
                            @if(isset($reserva->notificacion) && $reserva->notificacion)
                            <span class="inline-flex items-center gap-1 bg-green-50 border border-green-200 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg> Activada
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-gray-50 border border-gray-200 text-gray-500 px-3 py-1 rounded-full text-xs font-semibold">Desactivada</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if(isset($reserva->estado) && $reserva->estado == 'Pendiente')
                            <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded text-xs font-semibold">Pendiente</span>
                            @else
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded text-xs font-semibold">{{ $reserva->estado ?? 'Desconocido' }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('reservas.update', $reserva->id ?? 0) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="estado" value="Disponible">
                                    <button type="submit" class="bg-[#2563eb] hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors">Marcar disponible</button>
                                </form>
                                <a href="{{ route('productos.show', $reserva->producto_id ?? 0) }}" class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 text-xs font-medium px-4 py-2 rounded-lg transition-colors">Ver producto</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No hay reservas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
    @endif
@endsection