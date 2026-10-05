<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#f4f7ff] font-sans min-h-screen flex flex-col items-center justify-center p-4">

    <!-- Header Logo -->
    <div class="mb-8 text-center flex flex-col items-center">
        <div class="flex items-center justify-center gap-2 mb-4 select-none cursor-default">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-10 w-auto object-contain">
            <span class="font-black text-3xl text-[#2563eb] tracking-tighter">SINGKI</span>
        </div>
        <h1 class="font-sans text-[28px] font-extrabold text-[#040116] tracking-tight">Bienvenido de nuevo</h1>
        <p class="text-gray-500 text-[15px] mt-1 font-light">Ingresa a tu cuenta para continuar</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8 sm:p-10 w-full max-w-[420px]">
        
        <!-- Sesión Status (Verde) -->
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-xl text-green-600 text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        <!-- Sesión Errores (Si las credenciales fallan) -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl text-red-600 text-sm">
                Las credenciales no coinciden con nuestros registros.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Correo -->
            <div>
                <label for="email" class="block text-[13px] font-medium text-[#040116] mb-2">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="correo@ejemplo.com" 
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#040116] outline-none transition-colors placeholder:text-blue-300">
                        @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-[13px] font-medium text-[#040116] mb-2">Contraseña</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 bg-white focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-[#2563eb] outline-none transition-colors placeholder:text-blue-300 font-mono tracking-widest" style="padding-right: 48px;">
                    <button type="button" tabindex="-1" class="absolute inset-y-0 right-4 flex items-center px-1 text-gray-400 hover:text-[#1F51FF] focus:outline-none transition-colors" style="right: 16px;" onclick="const input = this.previousElementSibling; const eyeOpen = this.querySelector('.eye-open'); const eyeClosed = this.querySelector('.eye-closed'); if (input.type === 'password') { input.type = 'text'; eyeOpen.classList.add('hidden'); eyeClosed.classList.remove('hidden'); } else { input.type = 'password'; eyeOpen.classList.remove('hidden'); eyeClosed.classList.add('hidden'); }">
                        <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                    </button>
                </div>
                @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Olvidaste Contraseña -->
            <div class="flex justify-end mt-1">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[13px] text-[#2563eb] font-medium hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Botón Iniciar Sesión -->
            <button type="submit" class="w-full bg-[#2563eb] hover:bg-blue-700 text-white font-medium py-3.5 rounded-xl transition-colors shadow-sm text-[15px] mt-2">
                Iniciar sesión
            </button>

            <!-- Link a Registro -->
            <div class="text-center mt-4 text-[14px] text-gray-500">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="text-[#2563eb] font-medium hover:underline">Regístrate gratis</a>
            </div>
        </form>
    </div>

    <!-- Volver al Inicio -->
    <a href="{{ url('/') }}" class="mt-8 flex items-center gap-2 text-gray-400 hover:text-gray-600 text-sm font-medium transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Volver al inicio
    </a>

</body>
</html>
