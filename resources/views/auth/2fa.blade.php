<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Seguridad - SINGKI</title>
    <!-- Cargamos Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-indigo-500 to-purple-600 font-sans antialiased p-4">

    <!-- Tarjeta Principal (Blanca) -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10 text-center">

        <!-- Ícono Morado (Huella) -->
        <div class="mx-auto bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-inner">
            <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
            </svg>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">Verificación de Seguridad</h2>
        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
            Hemos enviado un código de 6 dígitos a tu correo electrónico. Por favor, ingrésalo para continuar.
        </p>

        <!-- Formulario de Verificación -->
        <form method="POST" action="{{ route('2fa.verify') }}">
            @csrf
            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Ingresa tu código</label>
                <input type="text" name="code"
                       class="w-full text-center text-4xl font-black tracking-[0.4em] text-indigo-600 border-2 border-indigo-100 rounded-2xl py-4 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all shadow-sm"
                       maxlength="6"
                       placeholder="••••••"
                       autocomplete="off"
                       required autofocus>

                <!-- Mostrar errores si el código es incorrecto -->
                @if($errors->any())
                    <p class="text-red-500 text-sm mt-3 font-semibold">{{ $errors->first() }}</p>
                @endif
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-indigo-300 transform hover:-translate-y-1">
                Verificar y Acceder
            </button>
        </form>

        <!-- Botón de regreso -->
        <div class="mt-8 pt-6 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-medium text-gray-400 hover:text-indigo-600 transition-colors">
                    &larr; Volver al inicio de sesión
                </button>
            </form>
        </div>

    </div>

</body>
</html>