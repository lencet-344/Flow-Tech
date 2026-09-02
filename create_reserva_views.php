<?php
$path1 = 'resources/views/usuario/reservar.blade.php';
$path2 = 'resources/views/usuario/reserva-exito.blade.php';

$reservar_html = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar producto – SINGKI</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="bg-[#f8fafc] font-sans antialiased text-[#040116] min-h-screen flex flex-col">

    <!-- HEADER IDENTICO AL WELCOME -->
    <header class="bg-white sticky top-0 z-40 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            
            <div class="flex items-center gap-2">
                <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto">
                    <span class="font-black text-2xl text-[#3b82f6] tracking-tight">SINGKI</span>
                </a>
            </div>
            
            <!-- Enlaces centrales -->
            <nav class="hidden md:flex space-x-10 items-center">
                <a href="{{ url('/') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Inicio</a>
                <a href="{{ url('/') }}#categorias" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Categorías</a>
                
                @guest
                    <a href="{{ route('categories.index') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Explorar</a>
                @endguest
            </nav>
            
            <div class="hidden md:flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        @php
                            $superAdmins = ['isaacmeneses254@gmail.com', 'edmundo@ejemplo.com', 'admin@sinki.com'];
                        @endphp
                        
                        @if(in_array(Auth::user()->email, $superAdmins))
                            <a href="{{ url('/superadmin/dashboard') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Panel Super Admin</a>
                        @melse
                            <a href="{{ url('/admin/dashboard') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Administrar negocio</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                            @csrf
                            <button type="submit" class="bg-[#A6F4EA] hover:bg-[#8de8df] text-[#040116] font-semibold px-6 py-2 rounded-full transition-colors shadow-sm text-[14px]">
                                Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#3b82f6] text-white px-6 py-2.5 rounded-lg font-medium text-base hover:bg-[#2563eb] transition shadow-sm">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm p-8 my-10 border border-gray-100">
            <!-- Volver -->
            <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-700 text-sm flex items-center gap-1 font-medium mb-6 transition-colors">
                &larr; Volver al perfil
            </a>
            
            <!-- Título -->
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Reservar producto agotado</h1>
            <p class="text-gray-500 text-sm mb-6">Te notificaremos cuando esté disponible.</p>

            <!-- Producto -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 flex items-center gap-4 mb-6">
                <div class="w-16 h-16 bg-white rounded-lg border border-gray-100 flex/items-center justify-center shrink-0">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-gray-900 text-lg leading-tight">{{ $product->name ?? 'Producto no especificado' }}</p>
                    <p class="text-gray-500 text-sm">{{ $product->supplier->name ?? ($inventario?->supplier?->name ?? 'Negocio no especificado') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-yellow-600 font-bold text-lg">C$ {{ number_format($product->cost ?? 0, 2) }}</p>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('usuario.producto.reservar.store', $product->id) }}">
                @csrf
                <div class="mb-6">
                    <label for="notas" class="block text-sm font-semibold text-gray-700 mb-2">Notas adicionales (opcional)</label>
                    <textarea id="notas" name="notas" rows="3" class="w-full border border-gray-300 focus:border-[#1F51FF] focus:ring focus:ring-[#1F51EF]/20 rounded-xl shadow-sm px-4 py-3 text-sm text-gray-700 outline-none resize-none transition-all" placeholder="Ej: Me gustaría en color azul, requiero 2 unidades..."></textarea>
                </div>

                <!-- Alert -->
                <div class="bg-blue-50 text-blue-700 p-4 rounded-xl flex items-start gap-3 mb-8">
                    <svg class="w-5 h-5 shrink-0 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <p class="text-sm font-medium">Recibirás una notificación cuando el producto vuelva a estar disponible.</p>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ url('/') }}" class="w-1/2 text-center py-3 border border-gray-300 bg-white text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit" class="w-1/2 bg-[#1F51FF] hover:bg-[#1a42d4] text-white py-3 rounded-xl font-bold transition-colors shadow-md">
                        Confirmar reserva
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- FOOTER -->
    @include('components.footer')
</body>
</html>
HTML;

$reserva_exito_html = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Reserva confirmada! – SINGKI</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="bg-[#f8fafc] font-sans antialiased text-[#040116] min-h-screen flex flex-col">

    <!-- HEADER IDENTICO AL WELCOME -->
    <header class="bg-white sticky top-0 z-40 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            
            <div class="flex items-center gap-2">
                <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto">
                    <span class="font-black text-2xl text-[#3b82f6] tracking-tight">SINGKI</span>
                </a>
            </div>
            
            <!-- Enlaces centrales -->
            <nav class="hidden md:flex space-x-10 items-center">
                <a href="{{ url('/') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Inicio</a>
                <a href="{{ url('/') }}#categorias" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Categorías</a>
                
                @guest
                    <a href="{{ route('categories.index') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb] transition-colors">Explorar</a>
                @endguest
            </nav>
            
            <div class="hidden md:flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        @php
                            $superAdmins = ['isaacmeneses254@gmail.com', 'edmundo@ejemplo.com', 'admin@sinki.com'];
                        @endphp
                        
                        @if(in_array(Auth::user()->email, $superAdmins))
                            <a href="{{ url('/superadmin/dashboard') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Panel Super Admin</a>
                        @melse
                            <a href="{{ url('/admin/dashboard') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Administrar negocio</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                            @csrf
                            <button type="submit" class="bg-[#A6F4EA] hover:bg-[#8de8df] text-[#040116] font-semibold px-6 py-2 rounded-full transition-colors shadow-sm text-[14px]">
                                Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[#3b82f6] font-medium text-base hover:underline transition">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#3b82f6] text-white px-6 py-2.5 rounded-lg font-medium text-base hover:bg-[#2563eb] transition shadow-sm">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-sm p-10 my-10 text-center border border-gray-100">
            <!-- Icon -->
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-4">¡Reserva confirmada!</h1>
            
            <p class="text-gray-600 mb-8 leading-relaxed text-sm">
                @php
                    $productName = 'Producto';
                    if(isset($booking->special_requests) && str_starts_with($ooking->special_requests, 'Reserva de producto agotado: ')) {
                        $productName = str_replace('Reserva de producto agotado: ', '', $booking->special_requests);
                    }
                @endphp
                Se ha registrado tu reserva para <strong class="text-gray-900">{{ $productName }}</strong>. Te notificaremos cuando el producto esté disponible en <strong class="text-gray-900">{{ $booking->supplier->name ?? 'Empresa' }}</strong>.
            </p>

            <div class="bg-gray-50 p-5 rounded-xl text-left border border-gray-100 space-y-4 mb-10">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-500">Producto</span>
                    <span class="text-sm font-bold text-gray-900">{{ $productName }}</span>
                </div>
                <div class="h-px bg-gray-200"></div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-500">Negocio</span>
                    <span class="text-sm font-bold text-gray-900">{{ $booking->supplier->name ?? 'No especificado' }}</span>
                </div>
                <div class="h-px bg-gray-200"></div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-500">Estado</span>
                    <span class="text-yellow-600 font-medium text-sm bg-yellow-100 px-3 py-1 rounded-full">{{ $booking->payment_method ?? 'En espera' }}</span>
                </div>
                <div class="h-px bg-gray-200"></div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-500">Notificación</span>
                    <span class="text-green-600 font-medium text-sm bg-green-100 px-3 py-1 rounded-full flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Activada
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ url('/') }}" class="w-full block text-center py-3 border border-gray-300 bg-white text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors shadow-sm">
                    Volver al negocio
                </a>
                <a href="{{ url('/') }}" class="w-full block text-center py-3 bg-[#1F51FF] hover:bg-[#1a42d4] text-white rounded-xl font-bold transition-colors shadow-md">
                    Mis reservas
                </a>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    @include('components.footer')

</body>
</html>
HTML;

file_put_contents($path1, base64_decode($reservar_html));
file_put_contents($path2, base64_decode($reserva_exito_html));

echo "Views successfully replaced.\n";
?>
