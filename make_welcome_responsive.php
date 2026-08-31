<?php
$file = 'resources/views/welcome.blade.php';
$content = file_get_contents($file);

// ==========================================
// FASE 1: Navbar Responsiva
// ==========================================
$headerRegex = '/<header class="bg-white sticky top-0 z-40 border-b border-gray-100">.*?<\/header>/is';
preg_match($headerRegex, $content, $matches);
if (!empty($matches)) {
    $headerContent = $matches[0];
    
    // Convert to Alpine state
    $headerContent = str_replace('<header class="bg-white sticky top-0 z-40 border-b border-gray-100">', '<header x-data="{ mobileMenuOpen: false }" class="bg-white sticky top-0 z-40 border-b border-gray-100 relative">', $headerContent);
    
    // Add Hamburger button inside the flex container
    $hamburger = <<<HTML
            <!-- Botón Menú Móvil -->
            <div class="flex md:hidden items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
HTML;
    $headerContent = str_replace('</nav>', "</nav>\n$hamburger", $headerContent);
    
    // Add mobile menu dropdown before closing header
    $mobileMenu = <<<HTML
        <!-- Menú Móvil Desplegable -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition class="md:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-gray-100 flex flex-col p-4 gap-4 z-50">
            <a href="{{ url('/') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb]">Inicio</a>
            <a href="#categorias" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb]">Categorías</a>
            @guest
                <a href="{{ route('categories.index') }}" class="text-[#0f172a] font-medium text-base hover:text-[#2563eb]">Explorar</a>
                <hr class="border-gray-100">
                <a href="{{ route('login') }}" class="text-[#3b82f6] font-medium text-base">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-[#3b82f6] text-white px-6 py-2.5 rounded-lg font-medium text-center text-base shadow-sm block">Registrarse</a>
                @endif
            @endguest
            @auth
                <hr class="border-gray-100">
                @php
                    \$superAdmins = ['isaacmeneses254@gmail.com', 'edmundo@ejemplo.com'];
                @endphp
                @if(in_array(Auth::user()->email, \$superAdmins))
                    <a href="{{ url('/superadmin/dashboard') }}" class="text-[#3b82f6] font-medium text-base">Panel Super Admin</a>
                @else
                    <a href="{{ url('/admin/dashboard') }}" class="text-[#3b82f6] font-medium text-base">Administrar negocio</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="w-full mt-2">
                    @csrf
                    <button type="submit" class="w-full bg-[#A6F4EB] text-[#040116] font-semibold px-6 py-2.5 rounded-lg shadow-sm text-center">Cerrar Sesión</button>
                </form>
            @endauth
        </div>
HTML;
    $headerContent = str_replace('</header>', "$mobileMenu\n    </header>", $headerContent);
    $content = preg_replace($headerRegex, $headerContent, $content);
}

// ==========================================
// FASE 2: Hero Section
// ==========================================
// Guest Title
$content = preg_replace('/<h1 class="text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight max-w-2xl">/', '<h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight max-w-2xl">', $content);

// Logged In Flex wrapper
$content = preg_replace('/<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-6">/', '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">', $content);

// ==========================================
// FASE 3: Grids
// ==========================================
// Replace strict grid cols with responsive ones if missing
// Usually they are already grid-cols-1 md:grid-cols-something but let's ensure
$content = preg_replace('/class="([^"]*)grid-cols-2([^"]*)"/', 'class="$1grid-cols-1 sm:grid-cols-2$2"', $content);
$content = preg_replace('/class="([^"]*)grid-cols-3([^"]*)"/', 'class="$1grid-cols-1 sm:grid-cols-2 md:grid-cols-3$2"', $content);
$content = preg_replace('/class="([^"]*)grid-cols-4([^"]*)"/', 'class="$1grid-cols-1 sm:grid-cols-2 lg:grid-cols-4$2"', $content);
$content = preg_replace('/class="([^"]*)grid-cols-5([^"]*)"/', 'class="$1grid-cols-2 md:grid-cols-3 lg:grid-cols-5$2"', $content);
$content = preg_replace('/class="([^"]*)grid-cols-12([^"]*)"/', 'class="$1grid-cols-1 lg:grid-cols-12$2"', $content);

// Fix overlapping flex for categories on logged-in view
$content = str_replace('<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center gap-3">', '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-center md:justify-start gap-3">', $content);


// ==========================================
// FASE 4: Carrusel y Footer
// ==========================================
// Carousel wrapper
$content = preg_replace('/<div class="flex flex-col md:flex-row justify-center items-center gap-6 lg:gap-10 relative">/', '<div class="flex flex-col md:flex-row justify-center items-center gap-6 lg:gap-10 relative w-full overflow-hidden">', $content);

// Footer wrapper
$content = preg_replace('/<footer class="bg-white border-t border-gray-100 pt-20 pb-10">/i', '<footer class="bg-white border-t border-gray-100 pt-16 md:pt-20 pb-10 px-4 md:px-0">', $content);

// Ensure footer grids are responsive
$content = preg_replace('/<div class="grid grid-cols-2 md:grid-cols-4 gap-8">/', '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">', $content);

file_put_contents($file, $content);
echo "Welcome.blade.php updated for full responsiveness.\n";
?>
