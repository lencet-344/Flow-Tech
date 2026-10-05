<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI - ¿Olvidaste tu contraseña?</title>
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
        <h1 class="font-sans text-3xl font-extrabold text-[#040116] tracking-tight">¿Olvidaste tu contraseña?</h1>
        <p class="text-gray-500 text-[15px] mt-1 font-light max-w-sm">Ingresa tu correo electrónico y te enviaremos un código de 6 dígitos para restablecerla.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 w-full max-w-md">
        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Correo -->
            <div>
                <label for="email" class="block text-[13px] font-medium text-[#040116] mb-2">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="correo@ejemplo.com" 
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-[#EEF2FF]/70 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm text-[#040116] outline-none transition-colors placeholder:text-blue-300">
                @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition shadow-sm mt-2">
                Enviar código de verificación
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-[#1F51FF] font-medium transition-colors">
                &larr; Volver al inicio de sesión
            </a>
        </div>
    </div>
</body>
</html>
