<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="flex min-h-screen flex-col items-center justify-center py-12 px-4 bg-[#F4F7FF] font-sans text-[#040116]">

    <!-- Logo -->
    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo Singki" class="h-16 mx-auto mb-4 object-contain">

    <!-- Título -->
    <div class="flex items-center justify-center gap-2 mb-2">
        <svg class="w-6 h-6 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
        </svg>
        <h1 class="text-2xl font-bold">Registro de Cliente</h1>
    </div>

    <!-- Subtítulo -->
    <p class="text-gray-700 text-sm mb-8 text-center">Crea tu cuenta para buscar negocios y productos</p>

    <!-- Tarjeta y Formulario -->
    <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-gray-100 max-w-lg w-full">
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Fila 1 (Grid 2 columnas) -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <!-- Columna 1 -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-[#040116] mb-1.5">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Ej. Juan" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                        @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                <!-- Columna 2 -->
                <div>
                    <label for="last_name" class="block text-sm font-semibold text-[#040116] mb-1.5">Apellidos</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Ej. Pérez" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                        @error('last_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Fila 2 -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-[#040116] mb-1.5">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                        @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Fila 3 -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-semibold text-[#040116] mb-1.5">Número de Teléfono</label>
                <input type="tel" id="phone" name="phone" placeholder="8888-0000" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                        @error('phone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Fila 4 -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-[#040116] mb-1.5">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                        @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Fila 5 -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-semibold text-[#040116] mb-1.5">Repite tu contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                        @error('password_confirmation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Checkbox -->
            <div class="flex items-center gap-2 mb-6 text-sm text-gray-700">
                <input type="checkbox" id="terms" name="terms" class="rounded border-gray-300 text-[#1F51FF] focus:ring-[#1F51FF]" required>
                        @error('terms') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                <label for="terms">Acepto los Términos de uso y la Política de privacidad</label>
            </div>

            <!-- Botón Submit -->
            <button type="submit" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-3.5 px-4 rounded-xl transition-colors mb-6">
                Crear cuenta de Cliente
            </button>
        </form>

        <!-- Enlaces inferiores -->
        <div class="text-center text-sm">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#1F51FF] font-semibold hover:underline">Iniciar sesión</a>
        </div>

        <a href="{{ url('/registro-tipo') }}" class="mt-4 block text-center text-sm text-gray-500 hover:text-gray-700">
            &larr; Cambiar tipo de cuenta
        </a>

    </div>

</body>
</html>
