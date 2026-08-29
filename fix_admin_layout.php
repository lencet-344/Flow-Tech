<?php
$path = 'resources/views/layouts/admin.blade.php';
if (file_exists($path)) {
    $content = file_get_contents($path);
    
    // Replace URL paths with routes, but keep the active request check matching the new routes.
    // Inventario
    $content = str_replace('url(\'/admin/inventario\')', 'route(\'inventories.index\')', $content);
    $content = str_replace('request()->is(\'admin/inventario\')', 'request()->routeIs(\'inventories.*\')', $content);
    
    // Reservas
    $content = str_replace('url(\'/admin/reservas\')', 'route(\'bookings.index\')', $content);
    $content = str_replace('request()->is(\'admin/reservas\')', 'request()->routeIs(\'bookings.*\')', $content);
    
    // Ofertas
    $content = str_replace('url(\'/admin/ofertas\')', 'route(\'offers.index\')', $content);
    $content = str_replace('request()->is(\'admin/ofertas\')', 'request()->routeIs(\'offers.*\')', $content);
    
    file_put_contents($path, $content);
    echo "Fixed layout admin\n";
}
?>
