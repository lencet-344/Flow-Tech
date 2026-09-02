<?php
$models = glob('app/Models/*.php');
foreach ($models as $file) {
    echo basename($file) . ":\n";
    $content = file_get_contents($file);
    preg_match_all('/public\s+function\s+([a-zA-Z0-9_]+)\s*\(\s*\).*?return\s+\$this->(hasMany|belongsTo|hasOne|belongsToMany)\(\s*([a-zA-Z0-9_]+)::class/is', $content, $matches, PREG_SET_ORDER);
    if(empty($matches)){
        echo "  - (Sin relaciones o no detectadas)\n";
    }
    foreach ($matches as $m) {
        echo "  - {$m[1]}() -> {$m[2]} {$m[3]}\n";
    }
}
?>
