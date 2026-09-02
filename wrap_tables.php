<?php
$dir = new RecursiveDirectoryIterator('resources/views/superadmin');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $original = $content;

    // We check if the table is already wrapped in a similar div
    // We can do a regex to wrap <table ...> ... </table>
    // But since it might contain nested tables (rare in this dashboard), a simpler approach:
    // Look for <table... and check if the parent div has overflow-x-auto.
    // If not, wrap it. Or simpler, just wrap <table to </table>.
    
    // Better to use regex to wrap the table. Wait, blade tables might span multiple lines
    $content = preg_replace_callback('/<table\b[^>]*>(.*?)<\/table>/is', function($m) {
        $tableHtml = $m[0];
        // Don't wrap if it's already wrapped (heuristic check)
        // We will just always wrap it with a specific class and if there's an outer one, we'll let it be.
        return '<div class="overflow-x-auto w-full bg-white rounded-lg shadow">' . "\n" . $tableHtml . "\n" . '</div>';
    }, $content);
    
    // Also remove any existing overflow-x-auto from parents if possible, or just let it be.
    // Actually, in dashboard themes, they often have `<div class="overflow-x-auto">` already.
    // Let's check if the table is already preceded by `overflow-x-auto`.
    
    if ($content !== $original) {
        // Let's clean up double wrappers if they existed:
        $content = preg_replace('/<div class="overflow-x-auto">\s*<div class="overflow-x-auto w-full bg-white rounded-lg shadow">/i', '<div class="overflow-x-auto w-full bg-white rounded-lg shadow">', $content);
        $content = preg_replace('/<div class="bg-white rounded-\[1.2rem\] shadow-sm border border-gray-100 overflow-hidden">\s*<div class="overflow-x-auto">\s*<div class="overflow-x-auto w-full bg-white rounded-lg shadow">/is', '<div class="bg-white rounded-[1.2rem] shadow-sm border border-gray-100 mb-6"><div class="overflow-x-auto w-full">', $content);
        
        file_put_contents($path, $content);
        echo "Wrapped tables in $path\n";
    }
}
?>
