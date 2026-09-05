<?php
$content = file_get_contents('resources/views/welcome.blade.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, 'Empezar ahora') !== false || strpos($line, 'Explorar negocios') !== false) {
        echo "L$i: " . trim($line) . "\n";
        // print a few lines around it
        for($j=max(0, $i-3); $j<=min(count($lines)-1, $i+3); $j++) {
            echo "L$j: " . $lines[$j] . "\n";
        }
    }
}
?>
