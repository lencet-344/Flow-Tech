<?php
$file = 'resources/views/layouts/superadmin.blade.php';
$content = file_get_contents($file);

// 1. Convert body
$content = preg_replace('/<body class="bg-\[#f4f7ff\] font-sans antialiased h-screen flex overflow-hidden">/', '<body x-data="{ sidebarOpen: false }" class="bg-[#f4f7ff] font-sans antialiased h-screen flex flex-col md:flex-row overflow-hidden">', $content);

// 2. Add Topbar & Overlay
$topbar = <<<HTML
    <!-- Topbar Móvil -->
    <div class="md:hidden bg-[#00003d] text-white flex items-center justify-between p-4 shrink-0 shadow-md z-40 relative">
        <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </div>

    <!-- Overlay Móvil -->
    <div x-show="sidebarOpen" style="display: none;" @click="sidebarOpen = false" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40" x-transition.opacity></div>

HTML;

// 3. Update Aside
$content = preg_replace('/<aside class="w-\[280px\] bg-\[#00003d\] text-white h-screen flex flex-col shrink-0">/', $topbar . "\n" . '    <aside class="w-[280px] bg-[#00003d] text-white h-screen flex flex-col shrink-0 fixed md:relative z-50 inset-y-0 left-0 transform transition-transform duration-300 md:translate-x-0" :class="sidebarOpen ? \'translate-x-0\' : \'-translate-x-full\'">', $content);

file_put_contents($file, $content);
echo "Layout superadmin updated.\n";
?>
