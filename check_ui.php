<?php
$files = [
    'resources/views/welcome.blade.php',
    'resources/views/public/profile.blade.php',
    'resources/views/admin/perfil.blade.php',
    'resources/views/inventories/show.blade.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    echo "--- $file ---\n";
    $content = file_get_contents($file);
    preg_match_all('/class="([^"]*)"/', $content, $matches);
    foreach ($matches[1] as $class) {
        if (strpos($class, 'flex') !== false || strpos($class, 'grid') !== false) {
            // Check if missing responsive variants
            $has_flex_col = strpos($class, 'flex-col') !== false;
            $has_md_flex_row = strpos($class, 'md:flex-row') !== false;
            $has_md_flex_col = strpos($class, 'md:flex-col') !== false;
            $has_flex = strpos($class, 'flex') !== false;
            
            // Log suspicious flex wrappers (flex without flex-col and without flex-wrap on mobile)
            if ($has_flex && !preg_match('/\bflex-col\b/', $class) && !preg_match('/\bflex-wrap\b/', $class) && !preg_match('/\bmd:flex\b/', $class)) {
                echo "SUSPICIOUS FLEX (might squish/overflow): $class\n";
            }
            
            // Check grids without responsive cols
            if (strpos($class, 'grid ') !== false && !preg_match('/\bmd:grid-cols-\d+\b/', $class) && !preg_match('/\bsm:grid-cols-\d+\b/', $class) && !preg_match('/\blg:grid-cols-\d+\b/', $class)) {
                echo "SUSPICIOUS GRID (no responsive cols): $class\n";
            }
        }
    }
}
?>
