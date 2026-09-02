<?php
$tipoCuenta = file_get_contents('resources/views/auth/tipo-cuenta.blade.php');

// Extract Header and Grid from tipo-cuenta
$headerStart = strpos($tipoCuenta, '<!-- Cabecera (Header) -->');
$headerEnd = strpos($tipoCuenta, '<!-- Grid de Tarjetas -->');
$header = substr($tipoCuenta, $headerStart, $headerEnd - $headerStart);

$gridStart = strpos($tipoCuenta, '<!-- Grid de Tarjetas -->');
$gridEnd = strpos($tipoCuenta, '</div>', strrpos($tipoCuenta, '</div>', strrpos($tipoCuenta, '</div>', strrpos($tipoCuenta, '<!-- Tarjeta 3: Servicios -->') ) ) ); 
// It's safer to just regex or substring carefully.

$gridRegex = '/<!-- Grid de Tarjetas -->(.*?)<!-- Footer -->/is';
if(preg_match($gridRegex, $tipoCuenta, $matches)){
    $grid = $matches[1];
    // Now we must replace the buttons inside the grid to have Alpine js
    $grid = preg_replace(
        '/<a href="[^"]*cliente"[^>]*>Continuar &rarr;<\/a>/is',
        '<button type="button" @click="role = \'cliente\'; step = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-colors mt-auto block text-center">Continuar &rarr;</button>',
        $grid
    );
    $grid = preg_replace(
        '/<a href="[^"]*proveedor"[^>]*>Continuar &rarr;<\/a>/is',
        '<button type="button" @click="role = \'proveedor\'; step = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-colors mt-auto block text-center">Continuar &rarr;</button>',
        $grid
    );
    $grid = preg_replace(
        '/<a href="[^"]*servicios"[^>]*>Continuar &rarr;<\/a>/is',
        '<button type="button" @click="role = \'servicios\'; step = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-colors mt-auto block text-center">Continuar &rarr;</button>',
        $grid
    );
}

// Prepare the register.blade.php file
$registerContent = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F7FF] font-sans antialiased text-[#040116] min-h-screen flex flex-col items-center justify-center py-12 px-4">

    <form method="POST" action="{{ route('register') }}" class="w-full max-w-6xl">
        @csrf
        <div x-data="{ step: 1, role: '{{ old('role', '') }}' }">
            <input type="hidden" name="role" x-model="role">
            
            <!-- PASO 1: SELECCIONAR ROL -->
            <div x-show="step === 1" x-transition.opacity>
                <!-- Cabecera (Header) -->
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo Singki" class="h-20 mx-auto mb-6 object-contain">
                <h1 class="text-3xl font-extrabold text-center">¿Cómo quieres usar SINGKI?</h1>
                <p class="text-gray-600 text-center mt-2">Elige el tipo de cuenta que mejor describe tu situación</p>

                <!-- Grid de Tarjetas -->
                <?php echo $grid; ?>
            </div>

            <!-- PASO 2: FORMULARIO DE REGISTRO -->
            <div x-show="step === 2" x-transition.opacity style="display: none;" class="w-full">
                <div class="max-w-md mx-auto bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    
                    <div class="mb-8">
                        <button type="button" @click="step = 1; role = ''" class="text-sm font-semibold text-[#1F51FF] hover:text-blue-700 transition-colors flex items-center gap-2 mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Volver a elegir rol
                        </button>
                        <h2 class="text-2xl font-bold text-[#040116]">Crear cuenta</h2>
                        <p class="text-gray-500 text-sm mt-1">Ingresa tus datos para registrarte como <span class="font-bold text-[#1F51FF]" x-text="role"></span></p>
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nombre Completo</label>
                        <input id="name" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                        <input id="email" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                        @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Contraseña</label>
                        <input id="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none" type="password" name="password" required autocomplete="new-password" />
                        @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Confirmar Contraseña</label>
                        <input id="password_confirmation" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none" type="password" name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-medium py-3.5 px-4 rounded-xl transition-colors shadow-sm text-center">
                        Crear cuenta
                    </button>
                    
                    <div class="mt-6 text-center text-sm text-gray-600">
                        ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#1F51FF] font-semibold hover:underline">Iniciar sesión</a>
                    </div>
                </div>
            </div>

        </div>
    </form>

</body>
</html>
HTML;

$registerContent = str_replace('<?php echo $grid; ?>', $grid, $registerContent);
file_put_contents('resources/views/auth/register.blade.php', $registerContent);
echo "Register unified successfully.\n";
?>
