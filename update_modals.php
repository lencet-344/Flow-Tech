<?php
$dir = new RecursiveDirectoryIterator('resources/views/superadmin');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    
    // Look for modal inner container which typically has `w-full max-w-lg` or `w-full max-w-md`
    // and inject `mx-4` if not present.
    $original = $content;
    
    $content = preg_replace_callback('/<div [^>]*class="([^"]*w-full[^"]*max-w-[a-z]+[^"]*)"[^>]*>/i', function($m) {
        $fullTag = $m[0];
        $classes = $m[1];
        if (strpos($classes, 'mx-4') === false) {
            return str_replace('w-full', 'w-full mx-4', $fullTag);
        }
        return $fullTag;
    }, $content);
    
    // Some might just have `max-w-md w-full`
    
    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Updated modals in $path\n";
    }
}
?>
