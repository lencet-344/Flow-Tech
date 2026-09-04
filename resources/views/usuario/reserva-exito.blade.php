<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva Confirmada - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Limpio con el Logo Blanco (Sin Cajas Azules) -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </a>
        
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'S' }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Sharon' }}
            </span>
        </div>
    </header>

    <!-- Contenedor Principal Centrado -->
    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <!-- Tarjeta Blanca Principal (Ancho restringido para que no se estire) -->
        <div class="bg-white max-w-[420px] w-full rounded-[24px] shadow-sm p-8 sm:p-10 border border-gray-100 text-center">
            
            <!-- Círculo Verde con Check Blanco -->
            <div class="w-20 h-20 bg-[#86efac] rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-[24px] font-extrabold text-[#0f172a] mb-2 tracking-tight">¡Reserva confirmada!</h1>
            <p class="text-gray-500 text-[14.5px] mb-8 font-light leading-relaxed">
                Se ha registrado tu reserva para <span class="font-bold text-[#0f172a]">{{ $reserva->product->name ?? 'Monitor Dell 27" 4K' }}</span>.<br>
                Te notificaremos cuando el producto esté disponible en <span class="font-bold text-[#0f172a]">{{ $reserva->supplier->name ?? 'TechSolutions GT' }}</span>.
            </p>

            <!-- Caja de Detalles de la Reserva -->
            <div class="bg-[#F8FAFC] rounded-xl p-5 mb-8 text-left border border-gray-100">
                <p class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-4">DETALLES DE LA RESERVA</p>
                <div class="space-y-3 text-[13px]">
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Producto</span><span class="font-bold text-[#0f172a]">{{ $reserva->product->name ?? 'Monitor Dell 27" 4K' }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Negocio</span><span class="font-bold text-[#0f172a]">{{ $reserva->supplier->name ?? 'TechSolutions GT' }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Estado</span><span class="font-bold text-[#f59e0b]">En espera</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Notificación</span><span class="font-bold text-[#10b981]">Activada</span></div>
                </div>
            </div>

            <!-- Botonera -->
            <div class="flex gap-4 w-full">
                <a href="{{ url('/') }}" class="flex-1 text-center py-3.5 rounded-xl border border-gray-200 text-[#0f172a] font-semibold text-[14px] hover:bg-gray-50 transition-colors">
                    Volver al negocio
                </a>
                <a href="{{ url('/admin/reservas') }}" class="flex-1 text-center py-3.5 rounded-xl bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold text-[14px] shadow-sm transition-colors">
                    Mis reservas
                </a>
            </div>
            
        </div>
    </main>

    <!-- Footer Oscuro -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @else
        <footer class="bg-[#020617] text-gray-400 py-12 mt-auto border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-2xl font-black text-[#1F51FF] mb-2">SINGKI</h2>
                <p class="text-xs font-light">© 2026 SINGKI. Todos los derechos reservados.</p>
            </div>
        </footer>
    @endif
</body>
</html>
