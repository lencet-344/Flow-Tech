<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen bg-gray-50 dark:bg-[#0f172a]">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm border-b border-gray-100 dark:border-gray-800 sticky top-0 z-10">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('success'))
            <script>
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
            </script>
        @endif

        @if ($errors->any())
            <script>
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += '<p style="margin-bottom: 0.25rem;">• {{ $error }}</p>';
                @endforeach

                Swal.fire({
                    icon: 'warning',
                    title: 'Revise la información',
                    html: `<div style="text-align: left; font-size: 0.95em;">${errorMessages}</div>`,
                    confirmButtonColor: '#4f46e5',
                    confirmButtonText: 'Entendido',
                    background: '#1e293b',
                    color: '#ffffff',
                    customClass: {
                        popup: 'border border-gray-700 rounded-2xl shadow-lg'
                    }
                });
            </script>
        @endif
    </body>
</html>