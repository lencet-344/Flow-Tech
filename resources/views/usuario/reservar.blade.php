<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservar Producto - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-slate-50 font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Limpio y Exacto -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-200">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
            <!-- Isotipo limpio sin cajas de fondo -->
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <!-- Texto renderizado en HTML haciendo match con el color y peso -->
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </a>
        
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'C' }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Usuario' }}
            </span>
        </div>
    </header>

    <!-- Contenedor Principal Centrado (Corregido el ancho) -->
    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <!-- max-w-lg evita que se estire de lado a lado -->
        <div class="bg-white max-w-lg w-full rounded-2xl shadow-sm p-8 border border-gray-200">
            
            <a href="{{ url('/') }}" class="text-blue-600 text-sm font-medium mb-6 inline-flex items-center hover:underline">
                &larr; Volver al perfil
            </a>
            
            <h1 class="text-2xl font-bold text-slate-900 mb-1 tracking-tight">Reservar producto agotado</h1>
            <p class="text-slate-500 text-sm mb-8">Te notificaremos cuando esté disponible</p>

            <!-- Resumen del Producto (Caja Gris) -->
            <div class="bg-slate-50 rounded-xl p-4 flex items-center gap-4 mb-8 border border-slate-200">
                <div class="w-16 h-16 bg-white rounded-lg border border-slate-200 flex items-center justify-center p-2 shrink-0">
                    <img src="{{ $producto->image_url ?? 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=300&q=80' }}" class="max-w-full max-h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <h3 class="font-bold text-slate-900 text-sm leading-tight mb-1">{{ $producto->name ?? 'Monitor Dell 27" 4K' }}</h3>
                    <p class="text-slate-500 text-xs mb-1">{{ $producto->supplier->name ?? 'TechSolutions GT' }}</p>
                    <p class="text-amber-600 font-bold text-sm">C$ {{ number_format($producto->cost ?? 4200, 0) }}</p>
                </div>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ url('/producto/'.($producto->id ?? 999).'/reservar') }}">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-500 mb-2">Notas adicionales (opcional)</label>
                    <input type="text" name="notes" placeholder="Cantidad deseada, especificaciones, etc." class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all placeholder:text-slate-400">
                </div>
                
                <!-- Alerta de Notificación -->
                <div class="bg-blue-50 text-blue-800 text-xs p-4 rounded-xl flex gap-3 items-start mb-8 border border-blue-200">
                    <svg class="w-5 h-5 shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <p class="mt-0.5">Recibirás una notificación cuando el producto vuelva a estar disponible.</p>
                </div>

                <!-- Botones Corregidos (Flex 1 para anchos iguales) -->
                <div class="flex gap-4 w-full">
                    <a href="{{ url('/') }}" class="flex-1 text-center py-3 rounded-xl border border-slate-300 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="flex-1 text-center py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-sm transition-colors">
                        Confirmar reserva
                    </button>
                </div>
            </form>
            
        </div>
    </main>

    <!-- RESTAURACIÓN DEL FOOTER CLÁSICO COMPLETO -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @endif
    
</body>
</html>