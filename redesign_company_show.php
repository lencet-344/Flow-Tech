<?php
$content = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->name }} - Perfil del Negocio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F4F7FF] min-h-screen antialiased text-gray-800 selection:bg-blue-100 selection:text-blue-900">

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            <!-- Botón Volver -->
            <div class="mb-8">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-semibold text-[#2563eb] hover:text-blue-800 transition-colors bg-white/50 hover:bg-white px-4 py-2 rounded-full shadow-sm backdrop-blur-sm border border-blue-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver al inicio
                </a>
            </div>

            <!-- Tarjeta de Perfil -->
            <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden relative">
                
                <!-- Fondo decorativo superior -->
                <div class="h-40 bg-gradient-to-r from-blue-50 to-indigo-50 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 20px 20px;"></div>
                </div>

                <div class="px-8 pb-10 sm:px-12">
                    
                    <!-- Logo / Avatar circular -->
                    <div class="relative -mt-20 mb-6 flex justify-between items-end">
                        <div class="w-40 h-40 rounded-full border-4 border-white shadow-md bg-white overflow-hidden flex items-center justify-center">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo {{ $company->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-[#eff6ff] text-[#2563eb] flex items-center justify-center font-bold text-5xl">
                                    {{ strtoupper(substr($company->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- Etiqueta de Categoría (Opcional a la derecha) -->
                        <div class="mb-4 hidden sm:block">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-50 text-[#2563eb] border border-blue-100 shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                {{ $company->category->name ?? $company->type_product ?? 'Negocio' }}
                            </span>
                        </div>
                    </div>

                    <!-- Cabecera Textual -->
                    <div class="mb-10">
                        <h1 class="text-4xl sm:text-5xl font-bold text-[#040116] tracking-tight mb-3">{{ $company->name }}</h1>
                        
                        <!-- Categoría Mobile -->
                        <div class="sm:hidden mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-[#2563eb] border border-blue-100">
                                {{ $company->category->name ?? $company->type_product ?? 'Negocio' }}
                            </span>
                        </div>

                        @if($company->description)
                            <p class="text-gray-500 text-base leading-relaxed max-w-2xl">{{ $company->description }}</p>
                        @endif
                    </div>

                    <hr class="border-gray-100 mb-10">

                    <!-- Grid de Información -->
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-6">Información de Contacto</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                        
                        <!-- Correo Electrónico -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center shrink-0 text-gray-400 border border-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Correo Electrónico</p>
                                <a href="mailto:{{ $company->email }}" class="text-[#040116] font-medium hover:text-[#2563eb] transition-colors">{{ $company->email }}</a>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center shrink-0 text-gray-400 border border-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Teléfono</p>
                                <a href="tel:{{ $company->telephone }}" class="text-[#040116] font-medium hover:text-[#2563eb] transition-colors">{{ $company->telephone }}</a>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center shrink-0 text-gray-400 border border-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Dirección Física</p>
                                <p class="text-[#040116] font-medium leading-relaxed">{{ $company->address }}</p>
                            </div>
                        </div>

                        <!-- Sitio Web (Opcional) -->
                        @if($company->website)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center shrink-0 text-gray-400 border border-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Sitio Web</p>
                                <a href="{{ Str::startsWith($company->website, ['http://', 'https://']) ? $company->website : 'https://' . $company->website }}" target="_blank" class="text-[#2563eb] font-medium hover:underline transition-colors">{{ $company->website }}</a>
                            </div>
                        </div>
                        @endif

                        <!-- Horario (Opcional) -->
                        @if($company->horario)
                        <div class="flex items-start gap-4 md:col-span-2">
                            <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center shrink-0 text-gray-400 border border-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Horario de Atención</p>
                                <p class="text-[#040116] font-medium">{{ $company->horario }}</p>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>
            </div>
            
            <div class="text-center mt-8 text-gray-400 text-sm">
                &copy; {{ date('Y') }} {{ $company->name }}. Todos los derechos reservados.
            </div>
        </div>
    </div>
</body>
</html>
HTML;
file_put_contents('resources/views/companies/show.blade.php', $content);
echo "Redesigned companies.show successfully.\n";
?>
