<?php
$file = 'resources/views/admin/perfil.blade.php';
$content = file_get_contents($file);

$fields = ['telephone', 'email', 'address', 'website', 'horario', 'description', 'category_id'];

foreach ($fields as $field) {
    // Check if @error already exists for this field
    if (strpos($content, "@error('$field')") === false) {
        // Regex to find the input/textarea/select with this name
        $regex = '/(<(input|textarea|select)[^>]*name=[\'"]' . $field . '[\'"][^>]*>)/i';
        // Add @error block right after it
        $replacement = "$1\n                        @error('$field') <span class=\"text-red-500 text-sm mt-1 block\">{{ \$message }}</span> @enderror";
        $content = preg_replace($regex, $replacement, $content);
    }
}

file_put_contents($file, $content);
echo "Added missing @error directives to admin/perfil.blade.php\n";
?>
