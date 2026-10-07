@extends('layouts.empty')

@section('content')
<!-- Cabecera Superior -->
<header class="bg-white border-b border-gray-100 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <div class="flex items-center gap-2 select-none cursor-default">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="SINGKI" class="h-8 w-auto">
            <span class="font-black text-2xl text-[#1F51FF] tracking-tight">SINGKI</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-[#1F51FF] font-bold text-sm transition-colors">
                &larr; Regresar al inicio
            </a>
            @guest
                <a href="{{ route('login') }}" class="text-[#1F51FF] font-bold text-sm transition-colors border border-[#1F51FF] px-4 py-1.5 rounded-full hover:bg-blue-50">
                    Iniciar sesión
                </a>
            @endguest
        </div>
    </div>
</header>

<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Cabecera -->
        <div class="mb-10 text-center max-w-2xl mx-auto">
            <h1 class="text-4xl font-extrabold text-[#040116] tracking-tight mb-4">
                Todos los productos
            </h1>
            <p class="text-gray-500 text-base mb-8">
                Explora productos de proveedores verificados en nuestra red
            </p>

            <form action="{{ route('products.index') }}" method="GET" class="relative flex items-center bg-white p-2 rounded-full shadow-sm border border-gray-200">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar productos por nombre, tipo o presentación..." class="w-full pl-6 pr-4 py-3 bg-transparent border-0 focus:ring-0 text-gray-700 outline-none rounded-l-full">
                @if($search)
                    <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-red-500 font-medium px-4 transition-colors">Limpiar</a>
                @endif
                <button type="submit" class="bg-[#1F51FF] hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-full transition-colors whitespace-nowrap">
                    Buscar
                </button>
            </form>
        </div>

        <!-- Tarjetas de Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center text-center">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-2">Total Productos</span>
                <span class="text-4xl font-black text-[#040116]">{{ collect($products)->count() }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center text-center">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-2">Disponibles</span>
                <span class="text-4xl font-black text-[#040116]">{{ collect($products)->filter(function($p) { return strtolower($p->state ?? '') === 'activo' && ($p->quantity ?? 0) > 0; })->count() }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center text-center">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-2">Agotados</span>
                <span class="text-4xl font-black text-[#040116]">{{ collect($products)->filter(function($p) { return strtolower($p->state ?? '') !== 'activo' || ($p->quantity ?? 0) <= 0; })->count() }}</span>
            </div>
        </div>

        <!-- Cuadrícula de Productos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products ?? [] as $product)
                @php $stock = $product->quantity ?? 0; @endphp
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col h-full hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-300 relative group">
                    
                    <div class="relative h-48 bg-gray-50 flex items-center justify-center p-4">
                        <img src="{{ !empty($product->image) ? (str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : ($product->image_url ?? asset('images/placeholder.png')) }}" alt="{{ $product->name }}" class="w-full h-full object-contain rounded-lg group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&q=80';">
                        @if($stock > 0)
                            <span class="absolute top-4 right-4 bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Disponible</span>
                        @else
                            <span class="absolute top-4 right-4 bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Agotado</span>
                        @endif
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            @php
                                $supName = $product->brand->name ?? $product->supplier->name ?? '';
                                if (empty($supName) || strtolower($supName) === 'singki' || strtolower($supName) === 'wawastech') {
                                    $negociosCatalogo = ['Distribuidora Alimentos Norte', 'Comercial San José', 'Agroindustria del Norte', 'Abastos Central Estelí', 'Mercadito El Sol', 'Importadora Las Segovias', 'Distribuidora La Favorita', 'Suplidora Nicaragüense'];
                                    $supName = $negociosCatalogo[($product->id ?? 1) % count($negociosCatalogo)];
                                }
                            @endphp
                            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wide mb-1">{{ $supName }}</p>
                            <h4 class="text-base font-extrabold text-[#040116] mb-1 leading-tight">{{ $product->name }}</h4>
                            <p class="text-xs text-gray-500 mb-3">{{ $product->presentation ?? 'Sin especificación' }}</p>
                            <p class="text-xl font-black text-[#1F51FF] mb-5">C$ {{ number_format($product->cost ?? 0, 2) }}</p>
                        </div>
                        @php
                            $isFav = false;
                            if (auth()->check()) {
                                $isFav = \App\Models\Favorite::where('user_id', auth()->id())
                                    ->where('name', 'U:' . auth()->id() . '|P:' . $product->id)
                                    ->exists();
                            }
                        @endphp
                        <div x-data="{ 
                            isFav: {{ $isFav ? 'true' : 'false' }},
                            animating: false,
                            init() {
                                if(localStorage.getItem('fav_product_{{ $product->id }}') === 'true') {
                                    this.isFav = true;
                                }
                            },
                            async toggleFav() {
                                @if(!auth()->check()) window.location.href = '{{ route('login') }}'; return; @endif
                                this.animating = true;
                                setTimeout(() => this.animating = false, 300);
                                this.isFav = !this.isFav;

                                if(this.isFav) {
                                    localStorage.setItem('fav_product_{{ $product->id }}', 'true');
                                    let arr = JSON.parse(localStorage.getItem('singki_fav_products') || '[]');
                                    if(!arr.some(p => p.id == {{ $product->id }})) {
                                        arr.push({id: {{ $product->id }}, name: '{{ addslashes($product->name) }}', price: '{{ $product->price }}', image: '{{ $product->image }}'});
                                        localStorage.setItem('singki_fav_products', JSON.stringify(arr));
                                    }
                                    if(typeof window.showSingkiToast === 'function') window.showSingkiToast('✓ Producto añadido a favoritos');
                                } else {
                                    localStorage.removeItem('fav_product_{{ $product->id }}');
                                    let arr = JSON.parse(localStorage.getItem('singki_fav_products') || '[]');
                                    localStorage.setItem('singki_fav_products', JSON.stringify(arr.filter(p => p.id != {{ $product->id }})));
                                    if(typeof window.showSingkiToast === 'function') window.showSingkiToast('Eliminado de tus favoritos');
                                }

                                try {
                                    fetch('{{ route('favorites.toggle') }}', {
                                        method: 'POST',
                                        headers: { 
                                            'Content-Type': 'application/json', 
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({ type: 'product', id: {{ $product->id }} })
                                    });
                                } catch(e) { }
                            }
                        }" class="mb-3">
                            <button type="button" @click.prevent.stop="toggleFav()" :class="isFav ? 'bg-red-50 border-red-200 text-red-600' : 'text-gray-500 hover:bg-gray-100'" :style="isFav ? 'background-color: #fef2f2 !important; border-color: #fecaca !important; color: #dc2626 !important;' : ''" class="w-full border rounded-xl py-2 flex items-center justify-center gap-2 text-xs font-bold transition-colors">
                                <svg class="w-4 h-4 transition-transform duration-300" :style="isFav ? 'fill: #ef4444 !important; stroke: #ef4444 !important; color: #ef4444 !important;' : 'fill: none; stroke: currentColor;'" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                <span x-text="isFav ? 'En Favoritos' : 'Favorito'" :class="isFav ? 'text-red-600' : ''"></span>
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 mt-auto">
                            <a href="{{ auth()->check() ? route('products.show', $product->id) : route('login') }}" class="border-2 border-gray-100 hover:border-gray-200 text-gray-600 hover:text-gray-900 text-center py-2.5 rounded-xl text-sm font-bold transition-colors">
                                Detalles
                            </a>
                            <a href="{{ auth()->check() ? url('/producto/'.$product->id.'/reservar') : route('login') }}" class="bg-[#1F51FF] hover:bg-blue-700 text-white text-center py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/20 transition-colors">
                                Encargar
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <p class="text-xl font-bold text-[#040116] mb-2">No encontramos nada</p>
                    <p class="text-gray-500">Intenta con otros términos de búsqueda.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@include('components.accessibility-widget')
@include('components.welcome-scroll-animations')
@endsection