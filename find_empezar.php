<?php
$content = file_get_contents('resources/views/welcome.blade.php');
$lines = explode("\n", $content);
foreach($lines as $i => $line) {
    if(strpos($line, 'Empezar ahora') !== false) {
        echo "L$i: " . trim($line) . "\n";
        // Get the parent div by going backwards up to 3 lines
        for($j = max(0, $i-3); $j <= $i; $j++) {
            echo "L$j: " . trim($lines[$j]) . "\n";
        }
    }
}
?>
