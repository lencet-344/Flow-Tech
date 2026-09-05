<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singki - Panel de Administración</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body>
    <div class="flex h-screen overflow-hidden bg-[#F4F7FF] font-sans">
        
        <!-- Sidebar -->
        <aside class="w-[280px] bg-[#00003d] text-white flex flex-col shrink-0 h-full">
            
            <div class="flex-1 overflow-y-auto flex flex-col">
                <!-- Logo -->
                <div class="px-6 py-5 border-b border-gray-800">
                    <img src="{{ asset('images/LogoAzul.png') }}" alt="Logo Singki" class="h-10">
                    <p class="text-[#1F51FF] text-sm mt-2">Panel de Administración</p>
                </div>

                <!-- Perfil Dinámico -->
                <div class="px-6 py-5 border-b border-gray-800 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#1F51FF] flex items-center justify-center text-white font-bold uppercase">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-sm capitalize">{{ Auth::user()->name ?? 'Usuario' }}</p>
                        <p class="text-[#1F51FF] text-xs">Administrador</p>
                    </div>
                </div>

                <!-- Botón Ir al Inicio -->
                <div class="px-6 py-5">
                    <a href="{{ url('/') }}" class="block text-center w-full bg-[#A6F4EB] text-black py-2 rounded-xl font-medium text-sm">Ir al inicio</a>
                </div>

                <!-- Navegación MI NEGOCIO -->
                <div class="px-6 pb-2">
                    <p class="text-[#1F51FF] text-xs font-bold mb-3 uppercase">Mi Negocio</p>
                    <nav class="flex flex-col gap-1 text-sm">
                        <!-- Nota cómo el botón "Promocionar negocio" ahora verifica si estás en la ruta para pintarse de azul -->
                        <a href="{{ url('/admin/dashboard') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/dashboard') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Dashboard</a>
                        <a href="{{ url('/admin/perfil') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/perfil') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Perfil del negocio</a>
                        <a href="{{ route('inventories.index') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('inventories.*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Inventario</a>
                        <a href="{{ route('bookings.index') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('bookings.*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Reservas</a>
                        <a href="{{ route('offers.index') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('offers.*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Ofertas</a>
                        <a href="{{ url('/admin/comunidad') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/comunidad') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Comunidad Premium</a>
                        <a href="{{ url('/admin/estadisticas') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/estadisticas') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Estadísticas</a>
                        <a href="{{ url('/admin/promocionar') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/promocionar*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Promocionar negocio</a>
                    </nav>
                </div>

                <!-- Navegación INFORMACIÓN PÚBLICA -->
                <div class="px-6 py-4">
                    <p class="text-[#1F51FF] text-xs font-bold mb-3 uppercase">Información Pública</p>
                    <nav class="flex flex-col gap-1 text-sm text-gray-300">
                        <a href="{{ url('/admin/perfil') }}" class="py-2 px-3 hover:text-white rounded-lg transition-colors">Foto del negocio</a>
                        <a href="{{ route('inventories.index') }}" class="py-2 px-3 hover:text-white rounded-lg transition-colors">Disponibilidad/Stock</a>
                        <!-- Agregamos target="_blank" opcionalmente para que la vista pública abra en otra pestaña sin sacarlo del panel -->
                        <a href="{{ url('/perfil-publico') }}" target="_blank" class="py-2 px-3 hover:text-white rounded-lg transition-colors">Info pública</a>
                    </nav>
                </div>
            </div>

            <!-- Botón Atrás -->
            <div class="px-6 py-4 border-t border-gray-800 bg-[#00003d]">
                <a href="javascript:history.back()" class="flex items-center text-[#1F51FF] hover:text-blue-400 text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Atrás
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
        
    </div>
</body>
</html>