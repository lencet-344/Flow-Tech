<?php
$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

$updatedFiles = [];

foreach ($files as $file) {
    $path = $file[0];
    
    if (strpos($path, 'components') !== false || strpos($path, 'layouts') !== false) {
        continue;
    }

    $content = file_get_contents($path);
    $original = $content;

    $pattern = '/(<(input|select|textarea)[^>]*name=[\'"]([^\'"]+)[\'"][^>]*>)/i';
    
    $content = preg_replace_callback($pattern, function($matches) use ($original, $path) {
        $fullTag = $matches[1];
        $tagType = $matches[2];
        $fieldName = $matches[3];
        
        if (stripos($fullTag, 'type="hidden"') !== false || stripos($fullTag, "type='hidden'") !== false) {
            return $fullTag;
        }

        if (preg_match('/@error\([\'"]' . preg_quote($fieldName, '/') . '[\'"]\)/i', $original)) {
            return $fullTag;
        }

        $errorBlock = "\n                        @error('" . $fieldName . "') <span class=\"text-red-500 text-sm mt-1 block\">{{ \$message }}</span> @enderror";
        
        return $fullTag . $errorBlock;

    }, $content);

    if ($content !== $original) {
        file_put_contents($path, $content);
        $updatedFiles[] = $path;
    }
}

echo "Files updated with @error directives:\n";
echo implode("\n", $updatedFiles);
echo "\nDone.\n";
?>
