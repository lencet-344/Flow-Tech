@extends('layouts.empty')

@section('content')
<div class="bg-[#F4F7FF] min-h-screen pb-20">
    <!-- CABECERA LIMPIA OFICIAL SINGKI -->
    <header class="bg-white shadow-sm border-b border-gray-100 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2 select-none cursor-default">
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
            </div>
            
            <a href="{{ url('/') }}" class="text-[#1F51FF] font-bold text-sm flex items-center gap-2 hover:underline transition">
                &larr; Regresar al inicio
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ tab: 'todos' }">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight flex items-center gap-3">
                <svg class="w-8 h-8 text-[#1F51FF]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>
                Mis Favoritos
            </h1>
            <p class="text-gray-500 mt-2">Gestiona los negocios y productos que has guardado.</p>
        </div>

        <!-- MÉTRICAS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <p class="text-sm font-medium text-gray-500 mb-1">Total Favoritos</p>
                <p class="text-3xl font-extrabold text-[#040116]">{{ count($companies) + count($products) }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <p class="text-sm font-medium text-gray-500 mb-1">Negocios Guardados</p>
                <p class="text-3xl font-extrabold text-[#1F51FF]">{{ count($companies) }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <p class="text-sm font-medium text-gray-500 mb-1">Productos Guardados</p>
                <p class="text-3xl font-extrabold text-[#1F51FF]">{{ count($products) }}</p>
            </div>
        </div>

        <!-- PESTAÑAS ALPINE.JS -->
        <div class="flex space-x-2 mb-8 bg-white p-1.5 rounded-full inline-flex border border-gray-200 shadow-sm">
            <button @click="tab = 'todos'" :class="tab === 'todos' ? 'bg-[#1F51FF] text-white' : 'text-gray-600 hover:bg-gray-50'" class="px-6 py-2 rounded-full text-sm font-bold transition-colors">Todos</button>
            <button @click="tab = 'negocios'" :class="tab === 'negocios' ? 'bg-[#1F51FF] text-white' : 'text-gray-600 hover:bg-gray-50'" class="px-6 py-2 rounded-full text-sm font-bold transition-colors">Negocios</button>
            <button @click="tab = 'productos'" :class="tab === 'productos' ? 'bg-[#1F51FF] text-white' : 'text-gray-600 hover:bg-gray-50'" class="px-6 py-2 rounded-full text-sm font-bold transition-colors">Productos</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- TARJETAS DE NEGOCIOS -->
            @foreach($companies as $company)
            <div x-show="tab === 'todos' || tab === 'negocios'" class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow relative">
                <div class="absolute top-3 left-3 bg-[#1F51FF] text-white text-[10px] font-bold px-3 py-1 rounded-full z-10 shadow-sm">
                    NEGOCIO
                </div>
                <div class="h-40 bg-gray-100 relative">
                    @if(!empty($company->logo))
                        <img src="{{ asset('storage/' . $company->logo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#1F51FF] to-blue-800">
                            <span class="text-4xl font-extrabold text-white">{{ mb_substr($company->name, 0, 2) }}</span>
                        </div>
                    @endif
                </div>
                <div class="p-5 flex-grow flex flex-col">
                    <h3 class="font-extrabold text-[#040116] text-lg mb-1">{{ $company->name }}</h3>
                    <p class="text-[11px] font-bold text-[#1F51FF] bg-blue-50 inline-block px-2 py-0.5 rounded-full self-start mb-3">{{ $company->category->name ?? 'Categoría' }}</p>
                    <p class="text-sm text-gray-500 mb-6 flex-grow">{{ $company->address ?? $company->city ?? 'Nicaragua' }}</p>
                    
                    <div class="flex items-center gap-2 mt-auto">
                        <a href="{{ url('/perfil-publico?negocio=' . urlencode($company->name)) }}" class="flex-grow bg-[#1F51FF] hover:bg-blue-700 text-white text-center font-bold py-2 rounded-xl text-sm transition-colors">Ver perfil</a>
                        <form action="{{ route('favorites.destroy', $company->favorite_id) }}" method="POST" class="shrink-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-xl text-sm font-bold transition-colors">Quitar</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- TARJETAS DE PRODUCTOS -->
            @foreach($products as $product)
            <div x-show="tab === 'todos' || tab === 'productos'" class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow relative">
                <div class="absolute top-3 left-3 bg-[#f59e0b] text-white text-[10px] font-bold px-3 py-1 rounded-full z-10 shadow-sm">
                    PRODUCTO
                </div>
                <div class="h-40 bg-gray-50 flex items-center justify-center p-3">
                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" class="max-h-full max-w-full object-contain" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&q=80';">
                </div>
                <div class="p-5 flex-grow flex flex-col">
                    <h3 class="font-extrabold text-[#040116] text-base mb-1">{{ $product->name }}</h3>
                    <p class="text-xs text-gray-400 mb-2">{{ $product->presentation ?? $product->brand->name ?? 'Presentación' }}</p>
                    <p class="text-lg font-black text-[#1F51FF] mb-6 flex-grow">C$ {{ number_format($product->cost ?? $product->price ?? 0, 2) }}</p>
                    
                    <div class="grid grid-cols-2 gap-2 mb-2 mt-auto">
                        <a href="{{ route('products.show', $product->id) }}" class="bg-gray-100 hover:bg-gray-200 text-[#040116] text-center font-bold py-2 rounded-xl text-xs transition-colors">Detalles</a>
                        <a href="{{ url('/producto/'.$product->id.'/reservar') }}" class="bg-[#1F51FF] hover:bg-blue-700 text-white text-center font-bold py-2 rounded-xl text-xs transition-colors">Encargar</a>
                    </div>
                    <form action="{{ route('favorites.destroy', $product->favorite_id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-xl text-xs font-bold transition-colors">Quitar de favoritos</button>
                    </form>
                </div>
            </div>
            @endforeach

            <!-- ESTADO VACÍO -->
            @if(count($companies) === 0 && count($products) === 0)
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-dashed border-gray-300">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <h3 class="text-xl font-bold text-[#040116] mb-2">Aún no tienes favoritos</h3>
                <p class="text-gray-500 mb-6">Explora negocios y productos y guárdalos aquí para verlos más tarde.</p>
                <a href="{{ url('/explorar') }}" class="bg-[#1F51FF] hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-full transition-colors inline-block">Explorar ahora</a>
            </div>
            @endif
        </div>
    </main>
</div>
@endsection