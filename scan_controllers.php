<?php
$controllers = glob('app/Http/Controllers/*.php');
foreach ($controllers as $file) {
    if (basename($file) === 'Controller.php') continue;
    $content = file_get_contents($file);
    
    // We want to match: return view('view.name', compact('var1', 'var2'));
    // Or: return view('view.name', ['var1' => $val1]);
    preg_match_all('/return\s+view\(\s*[\'"]([^\'"]+)[\'"]\s*(?:,\s*compact\(([^)]+)\)|\s*,\s*\[(.*?)\])?/is', $content, $matches, PREG_SET_ORDER);
    
    if (!empty($matches)) {
        echo basename($file) . ":\n";
        foreach ($matches as $m) {
            $view = $m[1];
            $vars = '';
            
            if (!empty($m[2])) { // compact
                $vars = str_replace(['\'', '"', ' '], '', $m[2]);
                $vars = '$' . str_replace(',', ', $', $vars);
            } elseif (!empty($m[3])) { // array
                preg_match_all('/[\'"]([a-zA-Z0-9_]+)[\'"]\s*=>/', $m[3], $arrKeys);
                if (!empty($arrKeys[1])) {
                    $vars = '$' . implode(', $', $arrKeys[1]);
                }
            }
            if (empty($vars)) $vars = 'Ninguna';
            echo "  -> $view.blade.php -> Recibe: $vars\n";
        }
    }
}
?>
