<?php
$lines = file('resources/views/welcome.blade.php');
foreach($lines as $i => $l) {
    if(strpos($l, 'mt-6') !== false && strpos($l, 'flex') !== false) {
        echo "L$i: " . trim($l) . "\n";
    }
}
?>
