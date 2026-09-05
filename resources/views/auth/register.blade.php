<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#F4F7FF] font-sans antialiased text-[#040116] min-h-screen flex flex-col items-center justify-center py-12 px-4">

    <form method="POST" action="{{ route('register') }}" class="w-full max-w-6xl">
        @csrf
        <div x-data="{ step: 1, role: '{{ old('role', '') }}' }" x-init="if(role !== '') step = 2">
            <input type="hidden" name="role" x-model="role">
            
            <!-- PASO 1: SELECCIONAR ROL -->
            <div x-show="step === 1" x-transition.opacity>
                <!-- Cabecera (Header) -->
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo Singki" class="h-20 mx-auto mb-6 object-contain">
                <h1 class="text-3xl font-extrabold text-center">¿Cómo quieres usar SINGKI?</h1>
                <p class="text-gray-600 text-center mt-2">Elige el tipo de cuenta que mejor describe tu situación</p>

                <!-- Grid de Tarjetas -->
                <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    
                    <!-- Tarjeta 1: Cliente -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col h-full hover:shadow-md transition-shadow">
                        <svg class="w-10 h-10 mb-6 text-[#1F51FF]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
                        </svg>
                        <h2 class="font-sans text-xl font-bold mb-3">Soy Cliente</h2>
                        <p class="text-gray-500 text-sm mb-6 min-h-[4rem]">Busco negocios, productos y servicios. Quiero conectar con proveedores y emprendedores.</p>
                        
                        <ul class="flex-1 space-y-3 mb-8">
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Buscar proveedores
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Consultar stock
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Reservar productos
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Chat con negocios
                            </li>
                        </ul>

                        <button type="button" @click="role = 'cliente'; step = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-colors mt-auto block text-center">Continuar &rarr;</button>
                    </div>

                    <!-- Tarjeta 2: Proveedor -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col h-full hover:shadow-md transition-shadow">
                        <svg class="w-10 h-10 mb-6 text-[#1F51FF]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"></path>
                        </svg>
                        <h2 class="font-sans text-xl font-bold mb-3">Soy Proveedor / Emprendedor</h2>
                        <p class="text-gray-500 text-sm mb-6 min-h-[4rem]">Tengo un negocio o empresa y quiero publicar mis productos e inventario en la plataforma.</p>
                        
                        <ul class="flex-1 space-y-3 mb-8">
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Publicar productos
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Gestionar inventario
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Recibir reservas
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Conectar con clientes
                            </li>
                        </ul>

                        <button type="button" @click="role = 'proveedor'; step = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-colors mt-auto block text-center">Continuar &rarr;</button>
                    </div>

                    <!-- Tarjeta 3: Servicios -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col h-full hover:shadow-md transition-shadow">
                        <svg class="w-10 h-10 mb-6 text-[#1F51FF]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                        </svg>
                        <h2 class="font-sans text-xl font-bold mb-3">Ofrezco Servicios</h2>
                        <p class="text-gray-500 text-sm mb-6 min-h-[4rem]">Soy profesional independiente o emprendedor de servicios y quiero presentar mi oferta.</p>
                        
                        <ul class="flex-1 space-y-3 mb-8">
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Publicar servicios
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Recibir contactos
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Perfil profesional
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#1F51FF] shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                Gestión de solicitudes
                            </li>
                        </ul>

                        <button type="button" @click="role = 'servicios'; step = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-colors mt-auto block text-center">Continuar &rarr;</button>
                    </div>

                </div>

                <!-- Footer -->
                <div class="mt-10 text-sm text-gray-600 text-center">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#1F51FF] font-semibold hover:underline">Iniciar sesión</a>
                </div>
            </div>

            <!-- PASO 2: FORMULARIO DE REGISTRO -->
            <div x-show="step === 2" x-transition.opacity style="display: none;" class="w-full">
                <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100 relative">
                    
                    <button type="button" @click="step = 1; role = ''" class="absolute top-8 left-8 text-sm font-semibold text-[#1F51FF] hover:text-blue-700 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Volver a elegir rol
                    </button>

                    <div class="mb-8 mt-10 text-center">
                        <h2 class="text-2xl font-bold text-[#040116]">Crear cuenta</h2>
                        <p class="text-gray-500 text-sm mt-1">Regístrate como <span class="font-bold text-[#1F51FF] capitalize" x-text="role"></span></p>
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nombre Completo</label>
                        <input id="name" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                        <input id="email" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                        @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Contraseña</label>
                        <input id="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors" type="password" name="password" required autocomplete="new-password" />
                        @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Confirmar Contraseña</label>
                        <input id="password_confirmation" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" />
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