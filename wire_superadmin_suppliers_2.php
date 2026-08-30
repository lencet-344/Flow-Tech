<?php
$file = 'resources/views/superadmin/suppliers.blade.php';

$content = <<<'HTML'
@extends('layouts.superadmin')

@section('content')
@php
    $providers = \App\Models\User::where('role', 'proveedor')->with('company')->orderBy('created_at', 'desc')->get();
@endphp
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <svg class="w-8 h-8 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Proveedores</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-11">{{ $providers->count() }} proveedores y emprendedores registrados</p>
    </div>

    <!-- Lista de Tarjetas de Proveedores -->
    <div class="flex flex-col gap-6">
        
        @forelse ($providers as $provider)
        <div class="bg-white rounded-[1.5rem] border border-gray-100 shadow-sm p-8 hover:shadow-md transition-shadow">
            <!-- Info Personal -->
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 font-bold text-xl flex items-center justify-center">{{ strtoupper(substr($provider->name, 0, 1)) }}</div>
                    <div>
                        <h3 class="text-[17px] font-bold text-gray-900">{{ $provider->name }}</h3>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">{{ $provider->email }}</p>
                        <p class="text-[13.5px] text-gray-500 mt-0.5">Registrado: {{ $provider->created_at ? $provider->created_at->format('Y-m-d') : 'N/A' }}</p>
                    </div>
                </div>
                @if(($provider->status ?? 'activo') === 'activo')
                    <span class="px-4 py-1.5 bg-green-50 text-green-500 text-[11px] font-bold rounded-full">Activo</span>
                @else
                    <span class="px-4 py-1.5 bg-red-50 text-red-500 text-[11px] font-bold rounded-full">Suspendido</span>
                @endif
            </div>
            
            <!-- Divisor y Info del Negocio -->
            <div class="border-t border-gray-50 pt-6">
                @if($provider->company)
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[12px] text-gray-500 mb-1">Negocio asociado</p>
                        <h4 class="text-[16px] font-bold text-gray-900">{{ $provider->company->name }}</h4>
                        <p class="text-[13.5px] text-gray-600 mt-0.5">{{ $provider->company->category->name ?? 'Sin categoría' }} · {{ method_exists($provider->company, 'inventories') ? $provider->company->inventories()->count() : ($provider->company->products()->count() ?? 0) }} productos</p>
                    </div>
                    <a href="{{ url('/companies/' . $provider->company->id) }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-5 py-2.5 rounded-xl text-[13px] font-semibold transition-colors">
                        Ver negocio
                    </a>
                </div>
                @else
                <div class="flex justify-between items-center text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <p class="text-[13px] italic">El proveedor aún no ha configurado su negocio.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm p-8 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <p class="text-lg font-medium">No hay proveedores activos</p>
                <p class="text-sm">Los usuarios registrados como proveedores aparecerán aquí.</p>
            </div>
        @endforelse

    </div>
</div>
@endsection
HTML;

file_put_contents($file, $content);
echo "View overwritten safely.\n";
?>
