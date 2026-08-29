<?php

$inventario = file_get_contents('resources/views/admin/inventario.blade.php');
// Replace hardcoded loops with $inventories
$inventario = preg_replace('/@forelse\(\$inventario ?? \[\] as \$item\)/', '@forelse($inventories ?? [] as $item)', $inventario);
$inventario = preg_replace('/\{\{ \$item->producto->nombre ?? \'Producto no encontrado\' \}\}/', '{{ $item->product->name ?? \'Producto no encontrado\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->producto->codigo ?? \'#0000\' \}\}/', '{{ $item->product->code_bar ?? \'#0000\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->estado ?? \'Disponible\' \}\}/', '{{ $item->status ?? \'Disponible\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->lote ?? \'-\' \}\}/', '{{ $item->batch_number ?? \'-\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->stock ?? \'0\' \}\}/', '{{ $item->quantity ?? \'0\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->producto->precio ?? \'0.00\' \}\}/', '{{ $item->product->cost ?? \'0.00\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->costo_total ?? \'0.00\' \}\}/', '{{ number_format(($item->quantity ?? 0) * ($item->product->cost ?? 0), 2) }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->categoria ?? \'Categoría\' \}\}/', '{{ $item->product->category->name ?? \'Categoría\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->proveedor ?? \'Proveedor\' \}\}/', '{{ $item->supplier->name ?? \'Proveedor\' }}', $inventario);
$inventario = preg_replace('/\{\{ \$item->ultima_entrada ?? date\(\'d\/m\/Y\'\) \}\}/', '{{ $item->last_restock ?? date(\'Y-m-d\') }}', $inventario);
$inventario = preg_replace('/<span class="text-4xl font-bold text-\[\#040116\]">6<\/span>/', '<span class="text-4xl font-bold text-[#040116]">{{ $inventories->count() }}</span>', $inventario);
$inventario = preg_replace('/<span class="text-4xl font-bold text-\[\#040116\]">4<\/span>/', '<span class="text-4xl font-bold text-[#040116]">{{ $inventories->where(\'status\', \'Disponible\')->count() }}</span>', $inventario);
$inventario = preg_replace('/<span class="text-4xl font-bold text-\[\#040116\] text-red-500">2<\/span>/', '<span class="text-4xl font-bold text-[#040116] text-red-500">{{ $inventories->where(\'quantity\', 0)->count() }}</span>', $inventario);
file_put_contents('resources/views/inventories/index.blade.php', $inventario);


$ofertas = file_get_contents('resources/views/admin/ofertas.blade.php');
$ofertas = preg_replace('/@forelse\(\$ofertas ?? \[\] as \$oferta\)/', '@forelse($offers ?? [] as $oferta)', $ofertas);
$ofertas = preg_replace('/\{\{ \$oferta->producto->nombre ?? \'Producto no encontrado\' \}\}/', '{{ $oferta->product->name ?? \'Producto no encontrado\' }}', $ofertas);
$ofertas = preg_replace('/\{\{ \$oferta->estado ?? \'Activa\' \}\}/', '{{ $oferta->state ?? \'Activa\' }}', $ofertas);
$ofertas = preg_replace('/\{\{ \$oferta->descuento ?? \'0%\' \}\}/', '{{ $oferta->percentage_discount ?? \'0\' }}%', $ofertas);
$ofertas = preg_replace('/\{\{ \$oferta->fecha_inicio ?? date\(\'d\/m\/Y\'\) \}\}/', '{{ $oferta->start_date ?? date(\'d/m/Y\') }}', $ofertas);
$ofertas = preg_replace('/\{\{ \$oferta->fecha_fin ?? date\(\'d\/m\/Y\'\) \}\}/', '{{ $oferta->end_date ?? date(\'d/m/Y\') }}', $ofertas);
$ofertas = preg_replace('/<span class="text-4xl font-bold text-\[\#040116\]">5<\/span>/', '<span class="text-4xl font-bold text-[#040116]">{{ $offers->count() }}</span>', $ofertas);
$ofertas = preg_replace('/<span class="text-4xl font-bold text-\[\#040116\]">3<\/span>/', '<span class="text-4xl font-bold text-[#040116]">{{ $offers->where(\'state\', \'Activa\')->count() }}</span>', $ofertas);
$ofertas = preg_replace('/<span class="text-4xl font-bold text-\[\#040116\]">2<\/span>/', '<span class="text-4xl font-bold text-[#040116]">{{ $offers->where(\'state\', \'Expirada\')->count() }}</span>', $ofertas);
file_put_contents('resources/views/offers/index.blade.php', $ofertas);


$reservas = file_get_contents('resources/views/admin/reservas.blade.php');
$reservas = preg_replace('/@forelse\(\$reservas ?? \[\] as \$reserva\)/', '@forelse($bookings ?? [] as $reserva)', $reservas);
$reservas = preg_replace('/\{\{ \$reserva->producto->nombre ?? \'Producto no encontrado\' \}\}/', '{{ $reserva->product->name ?? \'Producto no encontrado\' }}', $reservas);
$reservas = preg_replace('/\{\{ \$reserva->producto->proveedor->nombre ?? \'Proveedor\' \}\}/', '{{ $reserva->product->supplier->name ?? \'Proveedor\' }}', $reservas);
$reservas = preg_replace('/\{\{ \$reserva->fecha ?? date\(\'Y-m-d\'\) \}\}/', '{{ $reserva->reservation_date ?? date(\'Y-m-d\') }}', $reservas);
$reservas = preg_replace('/\{\{ \$reserva->notificacion \}\}/', '{{ $reserva->notification_state }}', $reservas);
$reservas = preg_replace('/\{\{ \$reserva->estado ?? \'Desconocido\' \}\}/', '{{ $reserva->status ?? \'Desconocido\' }}', $reservas);
$reservas = preg_replace('/<span class="text-3xl font-bold text-\[\#040116\]">2<\/span>/', '<span class="text-3xl font-bold text-[#040116]">{{ $bookings->count() }}</span>', $reservas);
$reservas = preg_replace('/<span class="text-3xl font-bold text-\[\#040116\]">1<\/span>/', '<span class="text-3xl font-bold text-[#040116]">{{ $bookings->where(\'status\', \'Pendiente\')->count() }}</span>', $reservas);
file_put_contents('resources/views/bookings/index.blade.php', $reservas);

echo "Copied views!\n";
?>
