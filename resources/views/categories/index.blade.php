@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Botón de Escape -->
    <div class="mb-6">
        <a href="{{ url('/') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold text-sm gap-2 transition-colors bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            &larr; Regresar al inicio
        </a>
    </div>

    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Categorías</h1>
        <p class="text-gray-500 text-sm mt-1">Explora todos los departamentos disponibles</p>
    </div>

    <!-- Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Total Categorías</span>
            <span class="text-3xl font-bold text-[#040116]">{{ $categories->count() }}</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Destacadas</span>
            <span class="text-3xl font-bold text-[#040116]">4</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-sm font-medium text-gray-500 mb-2">Nuevas</span>
            <span class="text-3xl font-bold text-[#040116]">0</span>
        </div>
    </div>

    <!-- Tabla Principal (Grid para categorías) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($categories ?? [] as $category)
        <a href="{{ route('products.index', ['search' => $category->name]) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:-translate-y-1 hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-[#040116]">{{ $category->name ?? 'Sin nombre' }}</h3>
                <p class="text-xs text-gray-500 mt-1">Ver productos &rarr;</p>
            </div>
        </a>
        @empty
        <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center text-gray-500">
            No hay categorías disponibles
        </div>
        @endforelse
    </div>
</div>
@endsection