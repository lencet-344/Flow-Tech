<?php
$content = file_get_contents('resources/views/admin/perfil.blade.php');

$pattern = '/<button[^>]*>.*?Editar perfil.*?<\/button>/is';
$content = preg_replace($pattern, '', $content);

file_put_contents('resources/views/admin/perfil.blade.php', $content);
echo "Button removed.\n";
?>
