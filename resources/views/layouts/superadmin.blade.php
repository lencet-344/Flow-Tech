<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ sidebarOpen: false }" class="bg-[#f4f7ff] font-sans antialiased h-screen flex flex-col md:flex-row overflow-hidden">

    <!-- Sidebar -->
        <!-- Topbar Móvil -->
    <div class="md:hidden bg-[#00003d] text-white flex items-center justify-between p-4 shrink-0 shadow-md z-40 relative">
        <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </div>

    <!-- Overlay Móvil -->
    <div x-show="sidebarOpen" style="display: none;" @click="sidebarOpen = false" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40" x-transition.opacity></div>

    <aside class="w-[280px] bg-[#00003d] text-white h-screen flex flex-col shrink-0 fixed md:relative z-50 inset-y-0 left-0 transform transition-transform duration-300 md:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        
        <!-- Header Sidebar -->
        <div class="p-6 flex flex-col gap-5 border-b border-white/10">
            <div class="flex items-center justify-center">
                <!-- Imagen completa (Logo + Texto) camuflada con el fondo #00003d -->
                <img src="{{ asset('images/LogoAzul.png') }}" alt="Logo SINGKI" class="h-10 w-auto object-contain">
            </div>
            <div class="bg-red-600 text-white text-center py-2 rounded-full text-xs font-bold tracking-widest uppercase shadow-sm">
                Panel de Administración
            </div>
        </div>

        <div class="p-6 pb-2">

            <!-- User Profile -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-lg">
                    A
                </div>
                <div>
                    <h3 class="text-white text-sm font-bold">Administrador</h3>
                    <p class="text-red-500 text-xs font-medium uppercase tracking-wider">Super Administrador</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-4 pb-4 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <ul class="flex flex-col gap-1.5">
                <li>
                    <a href="{{ url('/superadmin/dashboard') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->is('superadmin/dashboard') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.users') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.users') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Usuarios
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.suppliers') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.suppliers') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Proveedores
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.businesses') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.businesses') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Negocios
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.publications') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.publications') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Publicaciones
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.reports') }}" class="flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.reports') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <span>Reportes</span>
                        <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">3</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.support') }}" class="flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.support') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <span>Servicio al cliente</span>
                        <span class="bg-yellow-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">5</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.queries') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.queries') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Consultas
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.moderation') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.moderation') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Moderación
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.community') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('superadmin.community') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>
                        Comunidad
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Back to Public Site -->
        <div class="mt-auto border-t border-gray-800 p-4">
            <a href="{{ url('/') }}" class="flex items-center justify-center w-full py-2.5 text-gray-400 hover:text-white transition-colors text-sm font-medium">
                &larr; Volver al sitio público
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto" x-data="{ mounted: false }" x-init="setTimeout(() => mounted = true, 50)" x-show="mounted" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
        @yield('content')
    </main>

    <script>
        @if(session('success'))
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: "{{ session('success') }}", showConfirmButton: false, timer: 3000, timerProgressBar: true });
        @endif
        @if(session('error'))
            Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: "{{ session('error') }}", showConfirmButton: false, timer: 4000, timerProgressBar: true });
        @endif
        @if(session('status'))
            Swal.fire({ toast: true, position: 'top-end', icon: 'info', title: "{{ session('status') }}", showConfirmButton: false, timer: 3000, timerProgressBar: true });
        @endif
    </script>
</body>
</html>