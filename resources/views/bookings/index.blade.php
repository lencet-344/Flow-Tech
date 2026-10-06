@php $isClient = auth()->check() && in_array(auth()->user()->role, ['usuario', 'cliente']); @endphp
@extends($isClient ? 'layouts.empty' : 'layouts.admin')

@section('content')
<div x-data="{ 
    showDeleteModal: false, 
    deleteFormId: null,
    showDetailsModal: false,
    detail: {}
}" @open-details.window="detail = $event.detail; showDetailsModal = true;">
    @if($isClient)
        <!-- ========================================================== -->
        <!-- VISTA PARA CLIENTES (MIS RESERVAS)                         -->
        <!-- ========================================================== -->
        <div class="bg-[#F4F7FF] min-h-screen">
            <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100">
                <div class="flex items-center gap-2 select-none cursor-default">
                    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                    <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
                </div>
                <a href="{{ url('/') }}" class="text-sm font-medium text-gray-600 hover:text-[#1F51FF] transition">&larr; Regresar al inicio</a>
            </header>

            <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
                <div class="mb-10">
                    <h1 class="text-[26px] font-extrabold text-[#0f172a] tracking-tight">Mis Reservas</h1>
                    <p class="text-gray-500 text-[15px] mt-2 font-light">Seguimiento de tus productos encargados y apartados</p>
                </div>

                <div class="space-y-6">
                    @forelse($bookings as $booking)
                        @php
                            $special_requests = $booking->special_requests ?? '';
                            if (str_contains($special_requests, '| Prod:')) {
                                $parts = explode('| Prod:', $special_requests);
                                $notes = trim($parts[0] ?? '');
                                $prodPart = trim($parts[1] ?? '');
                                $qtyParts = explode(' x', $prodPart);
                                $product_name = trim($qtyParts[0] ?? 'Producto Reservado');
                                $quantity = isset($qtyParts[1]) ? (int)$qtyParts[1] : 1;
                            } else {
                                $parts = explode('| PRODUCTO:', $special_requests);
                                $notes = trim($parts[0] ?? '');
                                $product_name = trim($parts[1] ?? 'Producto Reservado');
                                $quantity = 1;
                            }
                            
                            $metaPath = storage_path('app/booking_meta.json');
                            $allMetas = file_exists($metaPath) ? json_decode(file_get_contents($metaPath), true) : [];
                            if (!is_array($allMetas)) $allMetas = [];
                            $meta = $allMetas[$booking->id] ?? session("booking_meta_{$booking->id}", []);
                            
                            $quantity = $meta['quantity'] ?? $quantity;
                            $unit = $meta['unit'] ?? 'Unidades';
                            
                            $negociosCatalogo = ['Distribuidora Alimentos Norte', 'Comercial San José', 'Agroindustria del Norte', 'Abastos Central Estelí', 'Mercadito El Sol', 'Importadora Las Segovias', 'Distribuidora La Favorita', 'Suplidora Nicaragüense'];
                            $supName = $meta['supplier_name'] ?? $booking->supplier->name ?? '';
                            if (empty($supName) || strtolower($supName) === 'singki' || strtolower($supName) === 'wawastech') {
                                $supName = $negociosCatalogo[$booking->id % count($negociosCatalogo)];
                            }
                            
                            $delivery_address = $meta['delivery_address'] ?? 'Estelí, Barrio Central (Dirección registrada en el encargo)';
                            $lat = $meta['latitude'] ?? null;
                            $lng = $meta['longitude'] ?? null;
                        @endphp
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex flex-col sm:flex-row justify-between items-start mb-4 gap-4">
                                <div class="flex flex-wrap gap-2">
                                    <span class="bg-[#eff6ff] text-[#2563eb] px-3 py-1.5 rounded-full text-[11px] font-bold">{{ $booking->payment_method ?? 'En espera' }}</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-[18px] font-bold text-[#1F51FF]">C$ {{ number_format($booking->total_amount ?? 0, 2) }}</p>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-[18px] font-bold text-[#0f172a] mb-1">{{ $product_name }}</h3>
                                <p class="text-gray-600 text-[14.5px] mb-2 font-medium">{{ $supName }}</p>
                                <p class="text-gray-400 text-[13px] font-light">Fecha: {{ $booking->date_booking }}</p>
                                @if(!empty($notes))
                                    <p class="text-gray-400 text-[12px] mt-2 italic line-clamp-1">Notas: {{ $notes }}</p>
                                @endif
                                
                                <div class="flex items-center gap-3 mt-4">
                                    <a href="{{ url('/perfil-publico?negocio=' . urlencode($supName)) }}" class="border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-1.5 rounded-full text-xs font-semibold transition">
                                        Ver negocio
                                    </a>
                                    
                                    <button type="button" @click="$dispatch('open-details', { 
                                        product: '{{ addslashes($product_name) }}',
                                        supplier: '{{ addslashes($supName) }}',
                                        quantity: '{{ $quantity }} {{ $unit }}',
                                        total: '{{ number_format($booking->total_amount ?? 0, 2) }}',
                                        address: '{{ addslashes($delivery_address) }}',
                                        lat: '{{ $lat }}',
                                        lng: '{{ $lng }}',
                                        notes: '{{ addslashes($notes) }}',
                                        supplierUrl: '{{ url('/perfil-publico?negocio=' . urlencode($supName)) }}'
                                    })" class="bg-blue-50 hover:bg-blue-100 text-[#2563eb] border border-blue-200 px-4 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5">
                                        Ver detalles
                                    </button>

                                    <form id="delete-booking-{{ $booking->id }}" action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" @click="deleteFormId = 'delete-booking-{{ $booking->id }}'; showDeleteModal = true;" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-1.5 rounded-full text-xs font-semibold transition flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Cancelar reserva
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-white rounded-2xl border border-gray-200">
                            <p class="text-gray-500">No tienes reservas activas.</p>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    @else
        <!-- ========================================================== -->
        <!-- VISTA PARA ADMINISTRADORES / PROVEEDORES                   -->
        <!-- ========================================================== -->
        <div class="p-8 md:p-10">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Reservas</h1>
                <p class="text-gray-500 text-sm mt-1">Clientes que reservaron productos agotados</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
                    <span class="text-sm font-medium text-gray-500 mb-2">Total reservas</span>
                    <span class="text-3xl font-bold text-[#040116]">{{ $bookings->count() }}</span>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
                    <span class="text-sm font-medium text-gray-500 mb-2">Pendientes</span>
                    <span class="text-3xl font-bold text-[#040116]">{{ $bookings->where('payment_method', 'En espera')->count() }}</span>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
                    <span class="text-sm font-medium text-gray-500 mb-2">Notificados</span>
                    <span class="text-3xl font-bold text-[#040116]">{{ $bookings->where('payment_method', '!=', 'En espera')->count() }}</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Monto</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Notificación</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($bookings as $booking)
                                @php
                                    $special_requests = $booking->special_requests ?? '';
                                    if (str_contains($special_requests, '| Prod:')) {
                                        $parts = explode('| Prod:', $special_requests);
                                        $prodPart = trim($parts[1] ?? '');
                                        $qtyParts = explode(' x', $prodPart);
                                        $product_name = trim($qtyParts[0] ?? 'Producto Reservado');
                                    } else {
                                        $parts = explode('| PRODUCTO:', $special_requests);
                                        $product_name = trim($parts[1] ?? 'Producto Reservado');
                                    }
                                    
                                    $negociosCatalogo = ['Distribuidora Alimentos Norte', 'Comercial San José', 'Agroindustria del Norte', 'Abastos Central Estelí', 'Mercadito El Sol', 'Importadora Las Segovias', 'Distribuidora La Favorita', 'Suplidora Nicaragüense'];
                                    $supName = $booking->supplier->name ?? '';
                                    if (empty($supName) || strtolower($supName) === 'singki' || strtolower($supName) === 'wawastech') {
                                        $supName = $negociosCatalogo[$booking->id % count($negociosCatalogo)];
                                    }
                                @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div>
                                        <h4 class="text-sm font-bold text-[#040116]">{{ $product_name }}</h4>
                                        <p class="text-[13px] text-gray-500">{{ $supName }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->date_booking }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-[#1F51FF]">C$ {{ number_format($booking->total_amount ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 bg-green-50 border border-green-200 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Activada
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded text-xs font-semibold">{{ $booking->payment_method ?? 'En espera' }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <form id="delete-admin-booking-{{ $booking->id }}" action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" @click="deleteFormId = 'delete-admin-booking-{{ $booking->id }}'; showDeleteModal = true;" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 text-xs font-medium px-4 py-2 rounded-lg transition-colors">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No hay reservas registradas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- MODAL DE CONFIRMACIÓN DE ELIMINACIÓN ESTILO SINGKI -->
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-8 max-w-md w-full mx-4 text-center" @click.away="showDeleteModal = false">
            <div class="w-16 h-16 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-[#0f172a] mb-2">¿Cancelar esta reserva?</h3>
            <p class="text-sm text-gray-500 mb-7">Esta acción cancelará tu apartado del producto. ¿Estás seguro de que deseas continuar?</p>
            <div class="flex gap-3">
                <button type="button" @click="showDeleteModal = false" class="flex-1 py-3 px-4 rounded-xl border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition">No, conservar</button>
                <button type="button" @click="if(deleteFormId) document.getElementById(deleteFormId).submit()" class="flex-1 py-3 px-4 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold text-sm shadow-sm transition">Sí, cancelar reserva</button>
            </div>
        </div>
    </div>

    <!-- MODAL DE DETALLES DEL ENCARGO -->
    <div x-show="showDetailsModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 max-w-md w-full mx-4" @click.away="showDetailsModal = false">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-xl font-extrabold text-[#0f172a] mb-1">Detalles del Encargo</h3>
                    <p class="text-sm text-gray-500 font-medium" x-text="detail.supplier"></p>
                </div>
                <button @click="showDetailsModal = false" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 p-2 rounded-full transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="space-y-4 mb-8">
                <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                    <span class="text-sm text-gray-500">Producto</span>
                    <span class="text-sm font-bold text-[#0f172a]" x-text="detail.product"></span>
                </div>
                <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                    <span class="text-sm text-gray-500">Cantidad encargada</span>
                    <span class="text-sm font-bold text-[#0f172a]" x-text="detail.quantity"></span>
                </div>
                <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                    <span class="text-sm text-gray-500">Total estimado</span>
                    <span class="text-sm font-black text-[#1F51FF]" x-text="'C$ ' + detail.total"></span>
                </div>
                
                <div class="pt-2">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Dirección de entrega</span>
                    <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-xl border border-gray-100" x-text="detail.address"></p>
                </div>
                
                <template x-if="detail.lat && detail.lng">
                    <div class="bg-emerald-50 border border-emerald-200 p-3 rounded-xl flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-xs font-bold text-emerald-700">Ubicación GPS confirmada</span>
                        </div>
                        <a :href="'https://www.google.com/maps?q=' + detail.lat + ',' + detail.lng" target="_blank" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 hover:underline flex items-center gap-1">
                            Ver punto ↗
                        </a>
                    </div>
                </template>

                <template x-if="detail.notes">
                    <div class="pt-2">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Notas adicionales</span>
                        <p class="text-sm text-gray-600 italic" x-text="detail.notes"></p>
                    </div>
                </template>
            </div>
            
            <div class="flex gap-3">
                <a :href="detail.supplierUrl" class="flex-1 py-3 px-4 rounded-xl border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition text-center">Ir al negocio</a>
                <button type="button" @click="showDetailsModal = false" class="flex-1 py-3 px-4 rounded-xl bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold text-sm shadow-sm transition">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@include('components.accessibility-widget')
@endsection