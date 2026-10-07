<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#F4F7FF] font-sans min-h-screen flex flex-col justify-center items-center px-4 py-12">

    <!-- Header Logo -->
    <div class="mb-8 text-center flex flex-col items-center">
        <div class="flex items-center justify-center gap-2 mb-6 select-none cursor-default">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-10 w-auto object-contain">
            <span class="font-black text-3xl text-[#1F51FF] tracking-tighter">SINGKI</span>
        </div>
        <h1 class="font-sans text-3xl font-extrabold text-[#040116] tracking-tight">Restablecer contraseña</h1>
        <p class="text-gray-500 text-[15px] mt-1 font-light max-w-sm">Ingresa el código de 6 dígitos enviado a tu correo y escribe tu nueva contraseña.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 w-full max-w-md">
        
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-xl text-green-600 text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Correo (Readonly) -->
            <div>
                <label for="email" class="block text-[13px] font-medium text-[#040116] mb-2">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email', session('reset_email', request('email'))) }}" readonly 
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none text-sm text-gray-500">
                @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Código de 6 dígitos -->
            <div>
                <label for="code" class="block text-[13px] font-medium text-[#040116] mb-2">Código de verificación</label>
                <input type="text" id="code" name="code" maxlength="6" inputmode="numeric" required autofocus placeholder="••••••" 
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:ring-[#1F51FF] focus:border-[#1F51FF] text-center text-2xl font-extrabold tracking-[0.3em] text-[#040116] outline-none transition-colors placeholder:text-gray-300">
                @error('code') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-[13px] font-medium text-[#040116] mb-2">Nueva contraseña</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 bg-white focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm text-[#040116] outline-none transition-colors placeholder:text-blue-300 font-mono tracking-widest" style="padding-right: 48px;">
                    <button type="button" tabindex="-1" class="absolute inset-y-0 right-4 flex items-center px-1 text-gray-400 hover:text-[#1F51FF] focus:outline-none transition-colors" style="right: 16px;" onclick="const input = this.previousElementSibling; const eyeOpen = this.querySelector('.eye-open'); const eyeClosed = this.querySelector('.eye-closed'); if (input.type === 'password') { input.type = 'text'; eyeOpen.classList.add('hidden'); eyeClosed.classList.remove('hidden'); } else { input.type = 'password'; eyeOpen.classList.remove('hidden'); eyeClosed.classList.add('hidden'); }">
                        <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                    </button>
                </div>
                @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-[13px] font-medium text-[#040116] mb-2">Confirmar nueva contraseña</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" 
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 bg-white focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm text-[#040116] outline-none transition-colors placeholder:text-blue-300 font-mono tracking-widest" style="padding-right: 48px;">
                    <button type="button" tabindex="-1" class="absolute inset-y-0 right-4 flex items-center px-1 text-gray-400 hover:text-[#1F51FF] focus:outline-none transition-colors" style="right: 16px;" onclick="const input = this.previousElementSibling; const eyeOpen = this.querySelector('.eye-open'); const eyeClosed = this.querySelector('.eye-closed'); if (input.type === 'password') { input.type = 'text'; eyeOpen.classList.add('hidden'); eyeClosed.classList.remove('hidden'); } else { input.type = 'password'; eyeOpen.classList.remove('hidden'); eyeClosed.classList.add('hidden'); }">
                        <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                    </button>
                </div>
                @error('password_confirmation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition shadow-sm mt-2">
                Actualizar contraseña
            </button>
        </form>

        <div class="mt-6 text-center space-y-2">
            <a href="{{ route('password.request') }}" class="block text-sm text-[#1F51FF] hover:text-blue-700 font-medium transition-colors">
                Reenviar código
            </a>
            <a href="{{ route('login') }}" class="block text-sm text-gray-500 hover:text-[#1F51FF] font-medium transition-colors">
                &larr; Volver al inicio de sesión
            </a>
        </div>
    </div>
</body>
</html>
