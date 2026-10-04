@php $isClient = auth()->check() && in_array(auth()->user()->role, ['usuario', 'cliente']); @endphp
@extends($isClient ? 'layouts.empty' : 'layouts.admin')

@section('content')
    @if($isClient)
        <!-- ========================================================== -->
        <!-- VISTA PARA CLIENTES (MIS RESERVAS)                         -->
        <!-- ========================================================== -->
        <div class="bg-[#F4F7FF] min-h-screen">
            <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100">
                <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
                    <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                    <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
                </a>
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
                            $parts = explode('| PRODUCTO:', $special_requests);
                            $product_name = trim($parts[1] ?? 'Producto Reservado');
                            $notes = trim($parts[0] ?? '');
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
                                <p class="text-gray-600 text-[14.5px] mb-2 font-medium">{{ $booking->supplier->name ?? 'Proveedor SINGKI' }}</p>
                                <p class="text-gray-400 text-[13px] font-light">Fecha: {{ $booking->date_booking }}</p>
                                @if(!empty($notes))
                                    <p class="text-gray-400 text-[12px] mt-2 italic">Notas: {{ $notes }}</p>
                                @endif
                                
                                <div class="flex items-center gap-3 mt-4">
                                    <a href="{{ url('/perfil-publico?negocio=' . urlencode($booking->supplier->name ?? '')) }}" class="border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-xs font-semibold transition">
                                        Ver negocio
                                    </a>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-xl text-xs font-semibold transition flex items-center gap-1.5" onclick="return confirm('¿Seguro que deseas cancelar esta reserva?')">
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
                                    $parts = explode('| PRODUCTO:', $booking->special_requests ?? '');
                                    $product_name = trim($parts[1] ?? 'Producto Reservado');
                                @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div>
                                        <h4 class="text-sm font-bold text-[#040116]">{{ $product_name }}</h4>
                                        <p class="text-[13px] text-gray-500">{{ $booking->supplier->name ?? 'Proveedor SINGKI' }}</p>
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
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('¿Eliminar reserva?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 text-xs font-medium px-4 py-2 rounded-lg transition-colors">Eliminar</button>
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
@endsection