@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Cabecera -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Detalles de Inventario</h1>
            <p class="text-gray-500 text-sm mt-1">Información técnica y existencias del lote</p>
        </div>
        <a href="{{ route('inventories.index') }}" class="px-6 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors text-sm shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Regresar
        </a>
    </div>

    <!-- Contenedor -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-4xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <!-- Producto -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Producto</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->product->name ?? $inventory->product->title ?? $inventory->product->id ?? 'N/A' }}</p>
            </div>

            <!-- Proveedor -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Proveedor</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->supplier->name ?? $inventory->supplier->title ?? $inventory->supplier->id ?? 'N/A' }}</p>
            </div>

            <!-- Cantidad -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Cantidad (Stock)</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->quantity ?? 'N/A' }}</p>
            </div>

            <!-- Costo Unitario -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Costo Unitario ($)</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->unit_cost ?? 'N/A' }}</p>
            </div>

            <!-- Fecha Entrada -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Fecha de Entrada (Last Restock)</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->last_restock ?? 'N/A' }}</p>
            </div>

            <!-- Próxima Revisión -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Próxima Revisión (Update Restock)</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->update_restock ?? 'N/A' }}</p>
            </div>

            <!-- Número de Lote -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Número de Lote</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->batch_number ?? 'N/A' }}</p>
            </div>

            <!-- Estado -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Estado</label>
                <p class="text-gray-800 font-medium text-[15px] capitalize">{{ $inventory->status ?? 'N/A' }}</p>
            </div>
            
            <!-- Order Detail -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 md:col-span-2">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Order Detail ID</label>
                <p class="text-gray-800 font-medium text-[15px]">{{ $inventory->order_detail->name ?? $inventory->order_detail->title ?? $inventory->order_detail->id ?? 'N/A' }}</p>
            </div>

        </div>
    </div>
</div>
@endsection