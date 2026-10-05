@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10">
    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Dashboard</h1>
        <p class="text-gray-500 text-sm mt-1">{{ $company->name ?? auth()->user()->name }} · Resumen general</p>
    </div>

    <!-- 4 Tarjetas Superiores (Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Tarjeta 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-semibold text-gray-700">Total productos</span>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <span class="text-4xl font-bold text-[#040116] mt-4">{{ collect($inventories)->count() }}</span>
        </div>
        <!-- Tarjeta 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-semibold text-gray-700">Disponibles</span>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-4xl font-bold text-[#040116] mt-4">{{ collect($inventories)->where('quantity', '>', 0)->count() }}</span>
        </div>
        <!-- Tarjeta 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-semibold text-gray-700">Agotados</span>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
            <span class="text-4xl font-bold text-[#040116] mt-4">{{ collect($inventories)->where('quantity', '<=', 0)->count() }}</span>
        </div>
        <!-- Tarjeta 4 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-semibold text-gray-700">Reservas pendientes</span>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <span class="text-4xl font-bold text-[#040116] mt-4">{{ collect($bookings)->count() }}</span>
        </div>
    </div>

    <!-- 2 Columnas: Productos y Reservas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <!-- Productos Recientes -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-[#040116]">Productos recientes</h3>
                <a href="{{ route('inventories.index') }}" class="text-[#2563eb] text-sm font-medium hover:underline">Ver todos &rarr;</a>
            </div>
            <div class="space-y-5">
                @forelse(collect($inventories)->take(4) as $item)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#2563eb] text-white rounded-lg shrink-0 overflow-hidden flex items-center justify-center font-bold text-lg">
                            {{ substr($item->product->name ?? 'P', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-[#040116]">{{ $item->product->name ?? 'Sin nombre' }}</h4>
                            <p class="text-xs text-gray-500">Lote: {{ $item->batch_number ?? 'N/A' }} • Stock: {{ $item->quantity ?? 0 }} • C$ {{ number_format($item->unit_cost ?? 0, 2) }}</p>
                        </div>
                    </div>
                    @if(($item->quantity ?? 0) > 0)
                    <span class="text-[10px] font-bold text-green-600 bg-green-50 border border-green-100 px-2 py-1 rounded uppercase tracking-wider">Disponible</span>
                    @else
                    <span class="text-[10px] font-bold text-red-600 bg-red-50 border border-red-100 px-2 py-1 rounded uppercase tracking-wider">Agotado</span>
                    @endif
                </div>
                @empty
                <p class="text-sm text-gray-500">No hay productos recientes. <a href="{{ route('inventories.create') }}" class="text-[#2563eb] font-semibold hover:underline">+ Agregar producto</a></p>
                @endforelse
            </div>
        </div>

        <!-- Reservas Recientes -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-[#040116]">Reservas recientes</h3>
                <a href="{{ route('bookings.index') }}" class="text-[#2563eb] text-sm font-medium hover:underline">Ver todas &rarr;</a>
            </div>
            <div class="space-y-5">
                @forelse(collect($bookings)->take(4) as $reserva)
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-semibold text-[#040116]">{{ str_contains($reserva->special_requests ?? '', 'PRODUCTO: ') ? trim(explode('PRODUCTO:', $reserva->special_requests)[1]) : 'Producto Reservado' }}</h4>
                        <p class="text-xs text-gray-500">{{ $reserva->date_booking ?? date('Y-m-d') }}</p>
                    </div>
                    <span class="text-[10px] font-bold text-yellow-600 bg-yellow-50 border border-yellow-100 px-2 py-1 rounded uppercase tracking-wider">{{ $reserva->payment_method ?? 'En espera' }}</span>
                </div>
                @empty
                <p class="text-sm text-gray-500">No hay reservas recientes</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Reseñas Recientes -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" x-data="{
        storageKeySpecific: 'reviews_company_{{ $company->id ?? '' }}',
        reviews: [],
        get averageRating() {
            if (this.reviews.length === 0) return '0.0';
            const sum = this.reviews.reduce((acc, r) => acc + parseInt(r.estrellas), 0);
            return (sum / this.reviews.length).toFixed(1);
        },
        init() {
            let saved = localStorage.getItem(this.storageKeySpecific);
            let parsed = saved ? JSON.parse(saved) : [];
            
            if (parsed.length > 0) {
                this.reviews = parsed;
            } else {
                let allKeys = Object.keys(localStorage).filter(k => k.startsWith('reviews_company_'));
                let allReviews = [];
                allKeys.forEach(k => {
                    let items = JSON.parse(localStorage.getItem(k));
                    if(Array.isArray(items)) {
                        allReviews = allReviews.concat(items);
                    }
                });
                this.reviews = allReviews;
            }
        }
    }">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-lg text-[#040116]">Reseñas recientes</h3>
            <!-- CONEXIÓN AL PERFIL PÚBLICO -->
            <a href="{{ url('/perfil-publico?negocio=' . urlencode($company->name ?? '')) }}" class="text-[#2563eb] text-sm font-medium hover:underline">Ver perfil público &rarr;</a>
        </div>
        
        <!-- Bloque Azul Claro de Promedio -->
        <div class="bg-[#F4F7FF] rounded-xl p-6 flex items-center gap-6 mb-6">
            <div class="text-5xl font-extrabold text-[#2563eb]" x-text="averageRating">0.0</div>
            <div>
                <p class="text-sm text-gray-700 font-medium mb-1"><span x-text="reviews.length">0</span> reseñas totales</p>
                <div class="flex text-yellow-400 text-lg">
                    <template x-for="i in 5">
                        <span x-text="i <= Math.round(averageRating) ? '★' : '☆'"></span>
                    </template>
                </div>
            </div>
        </div>

        <!-- Lista de Reseñas -->
        <div class="space-y-6">
            <template x-for="resena in reviews.slice(0, 4)" :key="resena.fecha + resena.nombre">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm shrink-0" x-text="resena.nombre.substring(0,1).toUpperCase()"></div>
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h4 class="text-sm font-bold text-[#040116]" x-text="resena.nombre"></h4>
                            <div class="flex text-yellow-400 text-xs">
                                <template x-for="i in 5">
                                    <span x-text="i <= parseInt(resena.estrellas) ? '★' : '☆'"></span>
                                </template>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mb-1" x-text="resena.fecha"></p>
                        <p class="text-sm text-gray-600 leading-relaxed" x-text="resena.texto"></p>
                    </div>
                </div>
            </template>
            
            <div x-show="reviews.length === 0" style="display: none;">
                <p class="text-xs text-gray-500">No hay reseñas recientes</p>
            </div>
        </div>
    </div>
</div>
@endsection