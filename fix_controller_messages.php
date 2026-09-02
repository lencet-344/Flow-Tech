<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('app/Http/Controllers'));

foreach ($files as $file) {
    if ($file->isDir() || $file->getExtension() !== 'php') continue;

    $content = file_get_contents($file->getPathname());
    $original = $content;

    // Fix "succes" typo
    $content = preg_replace("/with\(['\"]succes['\"]/i", "with('success'", $content);
    
    // Fix "a sido" to "ha sido"
    $content = preg_replace("/['\"]([a-zA-Z\s]+) a sido ([a-zA-Z\s]+) correctamente\.?['\"]/i", "'$1 ha sido $2 correctamente.'", $content);
    
    // Sometimes it's lowercase or capitalized strangely
    $content = preg_replace("/'([a-zA-Z\s]+) ha sido ([a-zA-Z\s]+) correctamente.'/i", "'$1 ha sido $2 correctamente.'", $content);
    
    if ($content !== $original) {
        // Capitalize the first letter of the message
        $content = preg_replace_callback("/with\('success',\s*'([^']+)'\)/i", function($m) {
            $msg = ucfirst(trim($m[1]));
            return "with('success', '$msg')";
        }, $content);
        
        file_put_contents($file->getPathname(), $content);
        echo "Updated: " . $file->getPathname() . "\n";
    }
}
?>
