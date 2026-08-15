<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>{{ config('app.name', 'Gestion de Fabricas') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-[#0f172a] text-gray-900 dark:text-gray-100 selection:bg-indigo-500 selection:text-white">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 w-full flex justify-end gap-4 bg-white/80 dark:bg-[#0f172a]/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 font-medium text-sm text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition-colors">
                            Iniciar sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-800 border border-transparent rounded-xl font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-700 transition ease-in-out duration-150 shadow-sm">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8 w-full flex-1 flex flex-col justify-center items-center text-center mt-20 sm:mt-0">
                <div class="flex justify-center mb-8">
                    <svg class="w-24 h-24 text-indigo-600 dark:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
                    </svg>
                </div>

                <h1 class="text-4xl sm:text-6xl font-bold tracking-tight text-gray-900 dark:text-white mb-6">
                    Singky <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-600">$$</span>
                </h1>

                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-12">
                    Sistema centralizado para la administración y gestion de Proveedores, Productos, Comercios y Pedidos. Diseñado para optimizar la eficiencia y la colaboración en el entorno empresarial
                </p>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                            Ir al Panel de Control
                        </a>
                    @else
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                                Comenzar
                            </a>
                        </div>
                    @endauth
                @endif
            </div>

            <div class="w-full text-center py-6 text-sm text-gray-500 dark:text-gray-400">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const navEntries = window.performance.getEntriesByType("navigation");
                    const isBackForward = navEntries.length > 0 && navEntries[0].type === "back_forward";
                    
                    if (!isBackForward) {
                        Swal.fire({
                            icon: 'success',
                            title: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#1e293b',
                            color: '#ffffff',
                            iconColor: '#10b981',
                            customClass: {
                                popup: 'border border-gray-700 rounded-2xl shadow-lg'
                            }
                        });
                    }
                });
            </script>
        @endif
    </body>
</html>