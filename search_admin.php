<?php
function searchDir($dir) {
    foreach (new DirectoryIterator($dir) as $fileinfo) {
        if ($fileinfo->isDot()) continue;
        if ($fileinfo->isDir()) searchDir($fileinfo->getPathname());
        else {
            $content = file_get_contents($fileinfo->getPathname());
            if (strpos($content, 'PREMIUM EXCLUSIVO') !== false || strpos($content, 'desde C$199') !== false) {
                echo "Found in " . $fileinfo->getPathname() . "\n";
            }
        }
    }
}
searchDir('resources/views/admin');
?>
