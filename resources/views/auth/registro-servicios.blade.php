<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Servicios - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F7FF] font-sans text-[#040116] flex min-h-screen flex-col items-center justify-center py-12 px-4">

    <!-- Logo -->
    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo Singki" class="h-16 mx-auto mb-4 object-contain">

    <!-- Título -->
    <div class="flex items-center justify-center gap-2 mb-1">
        <svg class="w-8 h-8 text-[#040116]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        <h1 class="text-2xl font-bold">Ofrezco servicios</h1>
    </div>

    <!-- Subtítulo -->
    <p class="text-gray-600 text-sm mb-6 text-center">Publica tus servicios e inventario</p>

    <!-- Stepper (Indicador visual de pasos) -->
    <div class="flex items-start justify-between max-w-sm mx-auto mb-10 px-4">
        <!-- Paso 1 -->
        <div class="flex flex-col items-center w-32 shrink-0 relative z-10">
            <div id="step-1-circle" class="w-8 h-8 rounded-full bg-[#1F51FF] text-white flex items-center justify-center font-bold text-sm shadow-sm">1</div>
            <span class="text-sm text-[#040116] font-semibold mt-2 text-center leading-tight">Datos personales</span>
        </div>
        <!-- Línea conectora -->
        <div class="flex-1 h-[2px] bg-gray-300 mt-4 -mx-8 relative z-0"></div>
        <!-- Paso 2 -->
        <div class="flex flex-col items-center w-32 shrink-0 relative z-10">
            <div id="step-2-circle" class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm shadow-sm">2</div>
            <span class="text-sm text-gray-500 font-semibold mt-2 text-center leading-tight">Datos del servicio</span>
        </div>
    </div>

    <!-- Tarjeta y Formulario -->
    <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-gray-100 max-w-lg w-full relative">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" value="servicios">

            <!-- PASO 1 -->
            <div id="paso-1">
                <h2 class="text-lg font-bold mb-4">Información personal</h2>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-[#040116] mb-1.5">Nombre</label>
                        <input type="text" id="name" name="name" placeholder="Ej. Juan" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-[#040116] mb-1.5">Apellidos</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Ej. Pérez" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-[#040116] mb-1.5">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="servicios@correo.com" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                </div>

                <div class="mb-4">
                    <label for="cedula" class="block text-sm font-semibold text-[#040116] mb-1.5">Cédula</label>
                    <input type="text" id="cedula" name="cedula" placeholder="Ej. 001-000000-0000A" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-[#040116] mb-1.5">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                </div>

                <button type="button" id="btn-siguiente" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl mt-4 transition-colors">Siguiente &rarr;</button>

                <a href="{{ url('/registro-tipo') }}" class="mt-4 block text-center text-sm text-gray-500 hover:text-gray-700">&larr; Cambiar tipo de cuenta</a>
            </div>

            <!-- PASO 2 -->
            <div id="paso-2" class="hidden">
                <h2 class="text-lg font-bold mb-4">Información del negocio</h2>

                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-semibold text-[#040116] mb-1.5">Nombre del negocio *</label>
                    <input type="text" id="company_name" name="company_name" placeholder="Ej. TechSolutions GT" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-semibold text-[#040116] mb-1.5">Categoría *</label>
                    <select id="category_id" name="category_id" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                        <option value="">Selecciona una categoría</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-semibold text-[#040116] mb-1.5">Descripción *</label>
                    <input type="text" id="description" name="description" placeholder="Describe brevemente tu negocio o servicio..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]" required>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-semibold text-[#040116] mb-1.5">Ubicación</label>
                    <input type="text" id="address" name="address" placeholder="Dirección" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#1F51FF] focus:ring-1 focus:ring-[#1F51FF] text-[#1F51FF] font-medium placeholder-[#8FA9FF]">
                </div>

                <div class="mb-4">
                    <button type="button" class="w-full border border-blue-100 bg-blue-50/50 text-[#1F51FF] font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 hover:bg-blue-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path></svg>
                        Agregar ubicación con el mapa
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-6">
                    <button type="button" id="btn-atras" class="w-full bg-white border border-gray-300 text-gray-700 font-semibold py-3.5 rounded-xl hover:bg-gray-50 transition-colors">&larr; Atrás</button>
                    <button type="submit" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition-colors">Crear cuenta</button>
                </div>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paso1 = document.getElementById('paso-1');
            const paso2 = document.getElementById('paso-2');
            const btnSiguiente = document.getElementById('btn-siguiente');
            const btnAtras = document.getElementById('btn-atras');
            
            const step1Circle = document.getElementById('step-1-circle');
            const step2Circle = document.getElementById('step-2-circle');
            const step1Text = step1Circle.nextElementSibling;
            const step2Text = step2Circle.nextElementSibling;

            btnSiguiente.addEventListener('click', function() {
                paso1.classList.add('hidden');
                paso2.classList.remove('hidden');

                // Mover stepper al paso 2
                step1Circle.classList.remove('bg-[#1F51FF]', 'text-white');
                step1Circle.classList.add('bg-gray-200', 'text-gray-500');
                step1Text.classList.remove('text-[#040116]');
                step1Text.classList.add('text-gray-500');

                step2Circle.classList.remove('bg-gray-200', 'text-gray-500');
                step2Circle.classList.add('bg-[#1F51FF]', 'text-white');
                step2Text.classList.remove('text-gray-500');
                step2Text.classList.add('text-[#040116]');
            });

            btnAtras.addEventListener('click', function() {
                paso2.classList.add('hidden');
                paso1.classList.remove('hidden');

                // Revertir stepper al paso 1
                step2Circle.classList.remove('bg-[#1F51FF]', 'text-white');
                step2Circle.classList.add('bg-gray-200', 'text-gray-500');
                step2Text.classList.remove('text-[#040116]');
                step2Text.classList.add('text-gray-500');

                step1Circle.classList.remove('bg-gray-200', 'text-gray-500');
                step1Circle.classList.add('bg-[#1F51FF]', 'text-white');
                step1Text.classList.remove('text-gray-500');
                step1Text.classList.add('text-[#040116]');
            });
        });
    </script>
</body>
</html>
