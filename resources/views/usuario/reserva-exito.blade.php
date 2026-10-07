<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Limpio con el Logo Blanco (Sin Cajas Azules) -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100">
        <div class="flex items-center gap-2 select-none cursor-default">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </div>
        
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-full hover:bg-blue-50/80 transition cursor-pointer group" title="Mi perfil">
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm overflow-hidden border border-blue-200">
                @if(Auth::check() && file_exists(public_path('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg')))
                    <img src="{{ asset('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg') . '?v=' . filemtime(public_path('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg')) }}" class="w-full h-full object-cover rounded-full">
                @else
                    {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'S' }}
                @endif
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Sharon' }}
            </span>
        </a>
    </header>

    <!-- Contenedor Principal Centrado -->
    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <!-- Tarjeta Blanca Principal (Ancho restringido para que no se estire) -->
        <div class="bg-white max-w-[420px] w-full rounded-[24px] shadow-sm p-8 sm:p-10 border border-gray-100 text-center">
            
            <!-- Círculo Verde con Check Blanco -->
            <style>
                @keyframes singkiScalePop {
                    0% { transform: scale(0); opacity: 0; }
                    60% { transform: scale(1.1); opacity: 1; }
                    100% { transform: scale(1); opacity: 1; }
                }
                @keyframes singkiDrawCheck {
                    to { stroke-dashoffset: 0; }
                }
            </style>
            <div class="w-20 h-20 bg-[#86efac] rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm" style="animation: singkiScalePop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" style="stroke-dasharray: 50; stroke-dashoffset: 50; animation: singkiDrawCheck 0.4s ease-out 0.25s forwards;"></path>
                </svg>
            </div>
            
            <h1 class="text-[24px] font-extrabold text-[#0f172a] mb-2 tracking-tight">¡Reserva confirmada!</h1>
            @php
                $meta = session("booking_meta_{$reserva->id}", []);
                $p_name = $meta['product_name'] ?? request('p', $reserva->product->name ?? 'Producto');
                $p_qty = $meta['quantity'] ?? request('cantidad', 1);
                $p_unit = $meta['unit'] ?? request('unidad', 'Unidades');
                $p_addr = $meta['delivery_address'] ?? 'No especificada';
                $p_lat = $meta['latitude'] ?? request('lat');
                $p_total = $meta['total_amount'] ?? request('total', $reserva->total_amount ?? 0);
                
                $p_supplier = $meta['supplier_name'] ?? $reserva->supplier->name ?? '';
                if (empty($p_supplier) || strtolower($p_supplier) === 'singki' || strtolower($p_supplier) === 'wawastech') {
                    $negociosCatalogo = ['Distribuidora Alimentos Norte', 'Comercial San José', 'Agroindustria del Norte', 'Abastos Central Estelí', 'Mercadito El Sol', 'Importadora Las Segovias', 'Distribuidora La Favorita', 'Suplidora Nicaragüense'];
                    $p_supplier = $negociosCatalogo[($reserva->product->id ?? 1) % count($negociosCatalogo)];
                }
            @endphp
            
            <p class="text-gray-500 text-[14.5px] mb-8 font-light leading-relaxed">
                Se ha registrado tu reserva para <span class="font-bold text-[#0f172a]">{{ $p_name }}</span>.<br>
                Te notificaremos cuando el producto esté disponible en <span class="font-bold text-[#0f172a]">{{ $p_supplier }}</span>.
            </p>

            <!-- Caja de Detalles de la Reserva -->
            <div class="bg-[#F8FAFC] rounded-xl p-5 mb-8 text-left border border-gray-100">
                <p class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-4">DETALLES DEL PEDIDO</p>
                <div class="space-y-3 text-[13px]">
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Producto</span><span class="font-bold text-[#0f172a]">{{ $p_name }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Cantidad</span><span class="font-bold text-[#0f172a]">{{ $p_qty }} {{ $p_unit }}</span></div>
                    <div class="flex justify-between gap-4"><span class="text-gray-500 font-medium shrink-0">Dirección</span><span class="font-bold text-[#0f172a] truncate text-right" title="{{ $p_addr }}">{{ $p_addr }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Ubicación mapa</span><span class="font-bold {{ $p_lat ? 'text-[#10b981]' : 'text-gray-400' }}">{{ $p_lat ? 'Confirmada ✓' : 'No especificada' }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-medium">Total Estimado</span><span class="font-bold text-[#1F51FF]">C$ {{ number_format($p_total, 2) }}</span></div>
                    <div class="flex justify-between border-t border-gray-200 pt-3 mt-3"><span class="text-gray-500 font-medium">Negocio</span><span class="font-bold text-[#0f172a]">{{ $p_supplier }}</span></div>
                </div>
            </div>

            <!-- Botonera -->
            <div class="flex gap-4 w-full">
                <a href="{{ route('products.index') }}" class="flex-1 text-center py-3.5 rounded-xl border border-gray-200 text-[#0f172a] font-semibold text-[14px] hover:bg-gray-50 transition-colors">
                    Volver al catálogo
                </a>
                <a href="{{ route('bookings.index') }}" class="flex-1 text-center py-3.5 rounded-xl bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold text-[14px] shadow-sm transition-colors">
                    Mis reservas
                </a>
            </div>
            
        </div>
    </main>

    <!-- Footer Oscuro -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @else
        <footer class="bg-[#020617] text-gray-400 py-12 mt-auto border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-2xl font-black text-[#1F51FF] mb-2">SINGKI</h2>
                <p class="text-xs font-light">© 2026 SINGKI. Todos los derechos reservados.</p>
            </div>
        </footer>
    @endif
</body>
</html>
