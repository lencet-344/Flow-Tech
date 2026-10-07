@extends('layouts.empty')

@section('content')
<!-- Cabecera Superior -->
<header class="bg-white border-b border-gray-100 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <div class="flex items-center gap-2 select-none cursor-default">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="SINGKI" class="h-8 w-auto">
            <span class="font-black text-2xl text-[#1F51FF] tracking-tight">SINGKI</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}" onclick="if(window.history.length > 1){ event.preventDefault(); window.history.back(); }" class="text-gray-500 hover:text-[#1F51FF] font-bold text-sm transition-colors">
                &larr; Regresar
            </a>
            @guest
                <a href="{{ route('login') }}" class="text-[#1F51FF] font-bold text-sm transition-colors border border-[#1F51FF] px-4 py-1.5 rounded-full hover:bg-blue-50">
                    Iniciar sesión
                </a>
            @else
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-[#1F51FF] font-bold text-sm transition-colors">
                    Inicio
                </a>
            @endguest
        </div>
    </div>
</header>

<div class="bg-[#F4F7FF] min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2">
        
        <!-- Columna Izquierda: Imagen -->
        <div class="bg-gray-50 p-10 flex items-center justify-center relative">
            @php $stock = $product->quantity ?? 0; @endphp
            @if($stock > 0)
                <span class="absolute top-6 left-6 bg-green-50 text-green-600 border border-green-200 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider shadow-sm z-10">Disponible</span>
            @else
                <span class="absolute top-6 left-6 bg-red-50 text-red-600 border border-red-200 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider shadow-sm z-10">Agotado</span>
            @endif
            
            <img src="{{ !empty($product->image) ? (str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : ($product->image_url ?? asset('images/placeholder.png')) }}" alt="{{ $product->name }}" class="w-full max-w-sm h-auto object-contain drop-shadow-xl hover:scale-105 transition-transform duration-500" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&q=80';">
        </div>
        
        <!-- Columna Derecha: Información -->
        <div class="p-10 lg:p-14 flex flex-col justify-center">
            <div class="mb-8">
                @php
                    $supName = $product->supplier?->name ?? '';
                    if (empty($supName) || strtolower($supName) === 'singki' || strtolower($supName) === 'wawastech') {
                        $negociosCatalogo = ['Distribuidora Alimentos Norte', 'Comercial San José', 'Agroindustria del Norte', 'Abastos Central Estelí', 'Mercadito El Sol', 'Importadora Las Segovias', 'Distribuidora La Favorita', 'Suplidora Nicaragüense'];
                        $supName = $negociosCatalogo[($product->id ?? 1) % count($negociosCatalogo)];
                    }
                @endphp
                <p class="text-sm text-gray-500 font-bold uppercase tracking-widest mb-2">{{ $supName }}</p>
                <h1 class="text-4xl font-black text-[#040116] mb-4 leading-tight">{{ $product->name }}</h1>
                <p class="text-3xl font-black text-[#1F51FF]">C$ {{ number_format($product->cost ?? 0, 2) }}</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8 mb-10 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tipo</span>
                    <span class="block text-base font-medium text-gray-900">{{ $product->type ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Presentación</span>
                    <span class="block text-base font-medium text-gray-900">{{ $product->presentation ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Stock Disponible</span>
                    <span class="block text-base font-bold text-[#040116]">{{ $product->quantity ?? 0 }} unidades</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Estado</span>
                    <span class="block text-base font-medium text-gray-900">{{ $product->state ?? 'N/A' }}</span>
                </div>
                <div class="sm:col-span-2">
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Código de Barras</span>
                    <span class="block text-base font-medium text-gray-500 font-mono">{{ $product->code_bar ?? 'N/A' }}</span>
                </div>
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
                            }" class="mb-4">
                <button type="button" @click.prevent.stop="toggleFav()" :class="isFav ? 'bg-red-50 border-red-200 text-red-600' : 'text-gray-500 hover:bg-gray-50'" :style="isFav ? 'background-color: #fef2f2 !important; border-color: #fecaca !important; color: #dc2626 !important;' : ''" class="w-full px-6 border rounded-xl py-3 flex items-center justify-center gap-2 text-sm font-bold transition-colors">
                    <svg class="w-5 h-5 transition-transform duration-300" :style="isFav ? 'fill: #ef4444 !important; stroke: #ef4444 !important; color: #ef4444 !important;' : 'fill: none; stroke: currentColor;'" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    <span x-text="isFav ? 'En Favoritos' : 'Añadir a favoritos'" :class="isFav ? 'text-red-600' : ''"></span>
                </button>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                <a href="{{ auth()->check() ? url('/producto/'.$product->id.'/reservar') : route('login') }}" class="flex-1 bg-[#1F51FF] hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-blue-500/30 text-center transition-all hover:-translate-y-1">
                    Pedir / Encargar este producto
                </a>
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}" onclick="if(window.history.length > 1){ event.preventDefault(); window.history.back(); }" class="sm:w-auto w-full bg-white border-2 border-gray-200 hover:border-gray-300 text-gray-700 font-bold py-4 px-8 rounded-xl text-center transition-colors">
                    Regresar
                </a>
            </div>
        </div>
    </div>
</div>
@include('components.accessibility-widget')
@endsection