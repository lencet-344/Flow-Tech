<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Activado - SINGKI</title>
    <script src="https://cdn.tailwindcss.com"></script>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#f0f4f8] font-sans antialiased text-[#0f172a] flex flex-col min-h-screen">

    <!-- Barra de Navegación Superior -->
    <nav class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center w-full shadow-sm">
        <!-- Logo Real de Singki -->
        <div class="flex items-center gap-2">
            <div class="text-[#2563eb] font-extrabold text-[24px] tracking-tight flex items-center gap-2">
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                <span>SINGKI</span>
            </div>
        </div>

        <!-- Enlaces Centrales -->
        <div class="hidden md:flex gap-8 text-[15px] font-medium text-gray-800">
            <a href="/" class="hover:text-blue-600 transition-colors">Inicio</a>
            <a href="/dashboard" class="hover:text-blue-600 transition-colors">Dashboard</a>
        </div>

        <!-- Perfil y Botón Derecho -->
        <div class="flex items-center gap-5">
            <button class="bg-[#8b5cf6] hover:bg-[#7c3aed] text-white px-5 py-2 rounded-full text-[14px] font-medium flex items-center gap-2 shadow-sm transition-all">
                <svg class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                Hazte Premium
            </button>
            <div class="flex items-center gap-2 cursor-pointer">
                <div class="w-9 h-9 bg-[#e0e7ff] text-[#4f46e5] rounded-full flex items-center justify-center font-bold text-sm">
                    {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'C' }}
                </div>
                <span class="text-[15px] font-medium text-gray-700">
                    {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Carlos' }}
                </span>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal Centrado -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="bg-white rounded-[24px] shadow-sm max-w-[540px] w-full p-10 text-center border border-gray-100">
            
            <div class="w-24 h-24 bg-[#7c3aed] rounded-[20px] flex items-center justify-center mx-auto mb-6 shadow-md">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-[28px] font-bold text-[#0f172a] mb-2 tracking-tight">Ya tienes Premium activo</h1>
            <p class="text-[#475569] text-[15px] mb-8 font-light">
                Estás disfrutando de todos los beneficios exclusivos de SINGKI Premium.
            </p>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="border border-[#8b5cf6] rounded-[16px] p-5 text-left bg-white transition hover:shadow-md">
                    <svg class="w-6 h-6 text-[#8b5cf6] mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    <p class="text-[14px] font-medium text-[#8b5cf6] leading-snug">Posicionamiento<br>destacado</p>
                </div>
                <!-- Beneficio 2 (Ahora es un enlace funcional) -->
                <a href="{{ url('/admin/comunidad-premium') }}" class="block border border-[#8b5cf6] rounded-[16px] p-5 text-left bg-white transition hover:shadow-md hover:bg-purple-50 cursor-pointer">
                    <svg class="w-6 h-6 text-[#8b5cf6] mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <p class="text-[14px] font-medium text-[#8b5cf6] leading-snug">Comunidad de<br>Crecimiento</p>
                </a>
                <div class="border border-[#8b5cf6] rounded-[16px] p-5 text-left bg-white transition hover:shadow-md">
                    <svg class="w-6 h-6 text-[#8b5cf6] mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <p class="text-[14px] font-medium text-[#8b5cf6] leading-snug">Estadísticas<br>avanzadas</p>
                </div>
                <div class="border border-[#8b5cf6] rounded-[16px] p-5 text-left bg-white transition hover:shadow-md">
                    <svg class="w-6 h-6 text-[#8b5cf6] mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    <p class="text-[14px] font-medium text-[#8b5cf6] leading-snug">Publicidad<br>incluida</p>
                </div>
            </div>

            <button class="w-full bg-[#7c3aed] hover:bg-[#6d28d9] text-white font-medium py-3.5 rounded-[12px] transition-colors shadow-sm text-[15px]">
                Ir a mi panel Premium
            </button>
        </div>
    </main>

    @include('components.footer')
</body>
</html>