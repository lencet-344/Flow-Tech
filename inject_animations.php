<?php
$layouts = [
    'resources/views/layouts/app.blade.php',
    'resources/views/layouts/superadmin.blade.php',
    'resources/views/layouts/guest.blade.php'
];

$sweetalertScript = <<<HTML
    <script>
        @if(session('success'))
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: "{{ session('success') }}", showConfirmButton: false, timer: 3000, timerProgressBar: true });
        @endif
        @if(session('error'))
            Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: "{{ session('error') }}", showConfirmButton: false, timer: 4000, timerProgressBar: true });
        @endif
        @if(session('status'))
            Swal.fire({ toast: true, position: 'top-end', icon: 'info', title: "{{ session('status') }}", showConfirmButton: false, timer: 3000, timerProgressBar: true });
        @endif
    </script>
</body>
HTML;

foreach ($layouts as $layout) {
    if (!file_exists($layout)) {
        echo "File $layout not found!\n";
        continue;
    }
    
    $content = file_get_contents($layout);
    
    // 1. Add sweetalert script before </body>
    if (strpos($content, "Swal.fire({ toast: true") === false) {
        $content = preg_replace('/<\/body>\s*(<\/html>)?\s*$/i', $sweetalertScript . "\n</html>", $content);
    }
    
    // 2. Add Alpine animation to <main>
    if (strpos($content, "x-data=\"{ mounted: false }\"") === false) {
        // Regex to match <main class="..."> or just <main>
        // Use a callback to preserve classes
        $content = preg_replace_callback('/<main([^>]*)>/i', function($matches) {
            $attrs = $matches[1];
            // If it already has x-data, we might need to be careful, but we'll assume it doesn't
            return "<main{$attrs} x-data=\"{ mounted: false }\" x-init=\"setTimeout(() => mounted = true, 50)\" x-show=\"mounted\" x-transition:enter=\"transition ease-out duration-700\" x-transition:enter-start=\"opacity-0 translate-y-6\" x-transition:enter-end=\"opacity-100 translate-y-0\">";
        }, $content);
    }
    
    file_put_contents($layout, $content);
    echo "Updated $layout\n";
}
?>
