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
        <div x-data="{ step: 1, role: '{{ old('role', '') }}', showMap: false }" x-init="if(role !== '') step = 2">
            <input type="hidden" name="role" x-model="role">
            
            <!-- ========================================== -->
            <!-- PASO 1: SELECCIONAR ROL -->
            <!-- ========================================== -->
            <div x-show="step === 1" x-transition.opacity>
                <!-- Cabecera -->
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo Singki" class="h-16 mx-auto mb-2 object-contain">
                <div class="text-center mb-6">
                    <span class="font-black text-4xl text-[#1F51FF] tracking-tighter uppercase leading-none">SINGKI</span>
                </div>
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


            <!-- ========================================== -->
            <!-- PASO 2: FORMULARIOS -->
            <!-- ========================================== -->
            <template x-if="step === 2">
                <div class="w-full" x-transition.opacity>
                    
                    <!-- ========================================== -->
                    <!-- FORMULARIO GENÉRICO (Cliente) -->
                    <!-- ========================================== -->
                    <template x-if="role !== 'proveedor' && role !== 'servicios'">
                        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100 relative mt-10">
                            
                            <button type="button" @click="step = 1; role = ''" class="absolute top-8 left-8 text-sm font-semibold text-[#1F51FF] hover:text-blue-700 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Volver a elegir rol
                            </button>

                            <div class="mb-8 mt-10 text-center">
                                <h2 class="text-2xl font-bold text-[#040116]">Crear cuenta</h2>
                                <p class="text-gray-500 text-sm mt-1">Regístrate como <span class="font-bold text-[#1F51FF] capitalize" x-text="role"></span></p>
                            </div>

                            <!-- Inputs Cliente (Intactos) -->
                            <div class="mb-4">
                                <label for="name" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nombre Completo</label>
                                <input id="name" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                                @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                                <input id="email" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                                @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Contraseña</label>
                                <input id="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50/50 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors" type="password" name="password" required autocomplete="new-password" />
                                @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

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
                    </template>

                    <!-- ========================================== -->
                    <!-- FORMULARIO PROVEEDOR/SERVICIOS (Diseño Figma) -->
                    <!-- ========================================== -->
                    <template x-if="role === 'proveedor' || role === 'servicios'">
                        <div x-data="{ formStep: 1, showMap: false }" class="w-full max-w-xl mx-auto flex flex-col items-center">
                            
                            <!-- CABECERA EXTERNA (El Logo, el Título y el Stepper) -->
                            <div class="text-center w-full mt-2">
                                
                                <!-- Logo SINGKI -->
                                <div class="flex flex-col items-center justify-center mb-5">
                                    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-12 w-auto object-contain mb-1">
                                    <span class="font-black text-4xl text-[#1F51FF] tracking-tighter uppercase leading-none">SINGKI</span>
                                </div>

                                <!-- Título con Ícono Dinámico -->
                                <div class="flex items-center justify-center gap-3 mb-2">
                                    <!-- Si es Proveedor: Edificio -->
                                    <template x-if="role === 'proveedor'">
                                        <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </template>
                                    <!-- Si es Servicios: Engranaje -->
                                    <template x-if="role === 'servicios'">
                                        <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                        </svg>
                                    </template>
                                    
                                    <h2 class="text-[22px] font-bold text-[#040116] tracking-tight" x-text="role === 'proveedor' ? 'Registro de Proveedor / Emprendedor' : 'Ofrezco servicios'"></h2>
                                </div>
                                
                                <p class="text-gray-500 text-[14px] font-medium mb-8" x-text="role === 'proveedor' ? 'Publica tu negocio e inventario' : 'Publica tus servicios e inventario'"></p>

                                <!-- Stepper Visual (Fuera de la tarjeta) -->
                                <div class="flex items-start justify-between max-w-xs mx-auto mb-8 px-4 relative">
                                    <!-- Línea conectora -->
                                    <div class="absolute top-4 left-1/2 -translate-x-1/2 w-24 h-[2px] bg-gray-300 z-0"></div>
                                    
                                    <!-- Paso 1 -->
                                    <div class="flex flex-col items-center w-24 shrink-0 relative z-10 bg-[#F4F7FF] px-2">
                                        <div class="w-8 h-8 rounded-full bg-[#1F51FF] text-white flex items-center justify-center font-bold text-sm shadow-sm transition-colors duration-300">1</div>
                                        <span class="text-[12px] font-medium mt-2 leading-tight" :class="formStep >= 1 ? 'text-[#040116]' : 'text-gray-400'">Datos personales</span>
                                    </div>
                                    
                                    <!-- Paso 2 -->
                                    <div class="flex flex-col items-center w-24 shrink-0 relative z-10 bg-[#F4F7FF] px-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-colors duration-300" :class="formStep === 2 ? 'bg-[#1F51FF] text-white' : 'bg-gray-200 text-gray-500'">2</div>
                                        <span class="text-[12px] font-medium mt-2 leading-tight" :class="formStep === 2 ? 'text-[#040116]' : 'text-gray-400'">Datos del negocio</span>
                                    </div>
                                </div>
                            </div>

                            <!-- TARJETA BLANCA DEL FORMULARIO -->
                            <div class="w-full bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-gray-100 relative">
                                
                                <!-- Paso 1 (Formulario) -->
                                <div x-show="formStep === 1" x-transition.opacity.duration.300ms>
                                    <h3 class="text-lg font-bold text-[#040116] mb-6">Información personal</h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Nombres</label>
                                            <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="text" name="first_name" placeholder="Ej. Carlos" required />
                                        </div>
                                        <div>
                                            <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Apellidos</label>
                                            <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="text" name="last_name" placeholder="Ej. González" required />
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Correo Electrónico</label>
                                        <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="email" name="email" placeholder="negocio@correo.com" required />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Cédula</label>
                                        <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="text" name="cedula" placeholder="8888-0000" required />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Contraseña</label>
                                        <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="password" name="password" placeholder="Mínimo 8 caracteres" required />
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Confirmar Contraseña</label>
                                        <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="password" name="password_confirmation" placeholder="Mínimo 8 caracteres" required />
                                    </div>

                                    <button type="button" @click="formStep = 2" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-3.5 px-4 rounded-xl transition-colors shadow-sm text-center">
                                        Siguiente &rarr;
                                    </button>

                                    <!-- Enlace Volver (Bottom) -->
                                    <button type="button" @click="step = 1; role = ''" class="w-full text-center text-sm text-gray-400 hover:text-gray-600 mt-5 transition-colors block">
                                        &larr; Cambiar tipo de cuenta
                                    </button>
                                </div>

                                <!-- Paso 2 (Formulario) -->
                                <div x-show="formStep === 2" x-transition.opacity.duration.300ms style="display: none;">
                                    <h3 class="text-lg font-bold text-[#040116] mb-6" x-text="role === 'proveedor' ? 'Información del negocio' : 'Información del servicio'"></h3>

                                    <div class="mb-4">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Nombre del negocio *</label>
                                        <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="text" name="company_name" placeholder="Ej. TechSolutions GT" required />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Descripción *</label>
                                        <textarea class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" name="description" rows="2" placeholder="Describe brevemente tu negocio o servicio..." required></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Categoría *</label>
                                        <select name="category_id" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors text-[#1F51FF]" required>
                                            <option value="">Selecciona una categoría</option>
                                            @foreach($categories ?? [] as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Ubicación</label>
                                        <input class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors placeholder-blue-300 text-[#1F51FF]" type="text" name="address" placeholder="Dirección" required />
                                    </div>

                                    <div class="mb-8">
                                        <label class="block text-[13px] font-bold text-[#040116] mb-1.5">Ubicación en el mapa</label>
                                        <div @click="showMap = true; setTimeout(() => initMapPicker(), 300)" class="w-full border border-gray-200 rounded-xl px-4 py-4 bg-white text-center cursor-pointer hover:bg-blue-50 transition-colors flex items-center justify-center gap-2 text-[#1F51FF]">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"></path></svg>
                                            <span class="text-sm font-semibold">Agregar ubicación con el mapa</span>
                                        </div>
                                        <input type="hidden" name="latitude" />
                                        <input type="hidden" name="longitude" />
                                    </div>

                                    <div class="flex gap-4">
                                        <button type="button" @click="formStep = 1" class="w-1/3 bg-white border border-gray-200 hover:bg-gray-50 text-[#040116] font-semibold py-3.5 px-4 rounded-xl transition-colors shadow-sm text-center">
                                            &larr; Atrás
                                        </button>
                                        <button type="submit" class="w-2/3 bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-3.5 px-4 rounded-xl transition-colors shadow-sm text-center">
                                            Crear cuenta
                                        </button>
                                    </div>

                                    <!-- Enlace Volver (Bottom) -->
                                    <button type="button" @click="step = 1; role = ''" class="w-full text-center text-sm text-gray-400 hover:text-gray-600 mt-5 transition-colors block">
                                        &larr; Cambiar tipo de cuenta
                                    </button>
                                </div>
                            </div>
                            <!-- MODAL DE GOOGLE MAPS -->
                            <div x-show="showMap" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60" style="display: none;" x-transition>
                                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 relative" @click.away="showMap = false">
                                    
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-bold text-[#040116]">Selecciona tu ubicación</h3>
                                        <button type="button" @click="showMap = false" class="text-gray-400 hover:text-gray-700 focus:outline-none">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Contenedor con altura forzada nativa para evadir el bug de Tailwind -->
                                    <div id="mapPicker" class="w-full bg-gray-100 rounded-xl mb-4 border border-gray-200" style="height: 400px; display: block;"></div>
                                    
                                    <button type="button" @click="showMap = false" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl transition-colors shadow-sm">
                                        Confirmar ubicación
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

        </div>
    </form>

    <script>
        let map, pickerMarker;

        // 1. Esta función solo le avisa al navegador que Google ya está listo en silencio.
        function mapaListo() {
            console.log("API de Google Maps conectada.");
        }

        // 2. Esta es la que dibuja el mapa SOLO cuando le das clic al botón.
        function initMapPicker() {
            const contenedor = document.getElementById('mapPicker');
            
            // Coordenadas base de Estelí
            const esteli = { lat: 13.0918, lng: -86.3543 };
            
            // Forzamos la creación del mapa fresco para que no salga el cuadro blanco
            map = new google.maps.Map(contenedor, {
                zoom: 14,
                center: esteli,
                mapTypeControl: false,
                streetViewControl: false,
            });

            // Si el usuario ya había puesto un pinche y cerró el modal, lo volvemos a pintar
            if(pickerMarker) {
                pickerMarker.setMap(map);
            }

            // Escuchar clics en el mapa para robar las coordenadas
            map.addListener('click', (e) => {
                if (pickerMarker) {
                    pickerMarker.setMap(null); // Borra el pin anterior
                }
                
                pickerMarker = new google.maps.Marker({
                    position: e.latLng,
                    map: map,
                    animation: google.maps.Animation.DROP,
                });
                
                // Inyectar a los inputs ocultos del formulario de Laravel
                document.querySelector('input[name="latitude"]').value = e.latLng.lat();
                document.querySelector('input[name="longitude"]').value = e.latLng.lng();
            });
        }
    </script>

    <!-- Carga de la API de Google Maps (Llama a la función silenciosa) -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=mapaListo"></script>
</body>
</html>