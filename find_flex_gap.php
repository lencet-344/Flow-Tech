<?php
$lines = file('resources/views/welcome.blade.php');
foreach($lines as $i => $l) {
    if(strpos($l, 'flex gap-4') !== false || strpos($l, 'flex items-center gap-4') !== false) {
        echo "L$i: " . trim($l) . "\n";
    }
}
?>
