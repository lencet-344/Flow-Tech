<?php
$filepath = 'routes/web.php';
$content = file_get_contents($filepath);

if (strpos($content, "Route::get('/admin/premium/planes'") === false) {
    // Add the route somewhere inside the admin auth block or at the end. The user just said "agrega esta nueva ruta dentro de tu grupo de rutas protegidas de administrador". Let's check how the file is structured.
    // I will append it to the file and it will be fine, or check if there's a Route::middleware(['auth', 'role:admin'])->group...
}
?>
