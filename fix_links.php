<?php

function fixFile($path) {
    if (!file_exists($path)) return;
    $content = file_get_contents($path);
    $orig = $content;

    if (basename($path) == 'welcome.blade.php') {
        // Mis Favoritos
        $content = str_replace('href="#"', 'href="{{ route(\'favorites.index\') }}"', $content);
        // Wait, multiple href="#" exist. Let's use regex based on inner text.
        
        $content = preg_replace('/<a href="[^"]*"([^>]*)>(.*?)Mis Favoritos<\/a>/s', '<a href="{{ route(\'favorites.index\') }}"$1>$2Mis Favoritos</a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>(.*?)Categorías<\/a>/su', '<a href="{{ route(\'categories.index\') }}"$1>$2Categorías</a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>(.*?)Buscar<\/a>/s', '<a href="{{ route(\'products.index\') }}"$1>$2Buscar</a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Ver todas\s*<span[^>]*>\&rarr;<\/span><\/a>/s', '<a href="{{ route(\'companies.index\') }}"$1>Ver todas <span aria-hidden="true">&rarr;</span></a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Ver todos\s*<span[^>]*>\&rarr;<\/span><\/a>/s', '<a href="{{ route(\'companies.index\') }}"$1>Ver todos <span aria-hidden="true">&rarr;</span></a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Ver perfil<\/a>/s', '<a href="{{ route(\'companies.show\', $negocio->id ?? 1) }}"$1>Ver perfil</a>', $content);

        // First Search Bar
        $searchBar1 = '<div class="relative w-full max-w-lg bg-white rounded-full flex items-center p-1.5 shadow-sm">
                            <input type="text" placeholder="Busca negocios, productos o servicios..." class="w-full pl-5 pr-4 py-2 bg-transparent border-0 focus:ring-0 text-gray-700 text-sm outline-none">
                            <button class="bg-[#3b82f6] hover:bg-[#2563eb] text-white font-medium px-8 py-2 rounded-full transition text-sm">Buscar</button>
                        </div>';
        $searchBar1Fix = '<form action="{{ route(\'products.index\') }}" method="GET" class="relative w-full max-w-lg bg-white rounded-full flex items-center p-1.5 shadow-sm">
                            <input type="text" name="search" placeholder="Busca negocios, productos o servicios..." class="w-full pl-5 pr-4 py-2 bg-transparent border-0 focus:ring-0 text-gray-700 text-sm outline-none">
                            <button type="submit" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white font-medium px-8 py-2 rounded-full transition text-sm">Buscar</button>
                        </form>';
        $content = str_replace($searchBar1, $searchBar1Fix, $content);
        
        $searchBar1Alt = '<div class="relative w-full max-w-lg bg-white rounded-full flex items-center p-1.5 shadow-sm">
                            <input type="text" placeholder="Busca negocios, productos o servicios..." class="w-full pl-5 pr-4 py-2 bg-transparent border-0 focus:ring-0 text-gray-700 text-sm outline-none">
                            <button class="bg-[#3b82f6] hover:bg-[#2563eb] text-white font-medium px-8 py-2 rounded-full transition text-sm">Buscar</button>
                        </div>'; // Just in case whitespace is different
        // Let\'s use a smart preg_replace for the search bars
        $content = preg_replace(
            '/<div([^>]*)>\s*<input type="text" placeholder="Busca negocios[^"]*" class="([^"]*)">\s*<button class="([^"]*)">Buscar<\/button>\s*<\/div>/',
            '<form action="{{ route(\'products.index\') }}" method="GET"$1><input type="text" name="search" placeholder="Busca negocios, productos o servicios..." class="$2"><button type="submit" class="$3">Buscar</button></form>',
            $content
        );

    } elseif (basename($path) == 'footer.blade.php') {
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Categorías<\/a>/su', '<a href="{{ route(\'categories.index\') }}"$1>Categorías</a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Explorar negocios<\/a>/s', '<a href="{{ route(\'companies.index\') }}"$1>Explorar negocios</a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Administración<\/a>/su', '<a href="{{ url(\'/admin/dashboard\') }}"$1>Administración</a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Centro de ayuda<\/a>/s', '<a href="{{ route(\'contact_requests.create\') }}"$1>Centro de ayuda</a>', $content);
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Contacto<\/a>/s', '<a href="{{ route(\'contact_requests.create\') }}"$1>Contacto</a>', $content);
        // Replace remaining dead links in footer to # just to be safe or leave them
    } elseif (basename($path) == 'dashboard.blade.php') {
        $content = preg_replace('/<a href="[^"]*"([^>]*)>Ver todos \s*<span[^>]*>\&rarr;<\/span><\/a>/s', '<a href="{{ route(\'inventories.index\') }}"$1>Ver todos &rarr;</a>', $content);
    } elseif (basename($path) == 'inventario.blade.php') {
        $content = preg_replace(
            '/<button class="([^"]*)">\s*\+ Agregar producto\s*<\/button>/s',
            '<a href="{{ route(\'inventories.create\') }}" class="$1">+ Agregar producto</a>',
            $content
        );
    }

    if ($content !== $orig) {
        file_put_contents($path, $content);
        echo "Fixed " . basename($path) . "\n";
    }
}

fixFile('resources/views/welcome.blade.php');
fixFile('resources/views/components/footer.blade.php');
fixFile('resources/views/admin/dashboard.blade.php');
fixFile('resources/views/admin/inventario.blade.php');

?>
