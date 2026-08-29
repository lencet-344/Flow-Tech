@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Nuevo Inventario</h1>
        <p class="text-gray-500 text-sm mt-1">Ingresa los detalles del nuevo lote de productos</p>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-4xl">
        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Producto -->
                <div>
                    <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-2">Producto</label>
                    <select name="product_id" id="product_id" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="">Seleccione un producto...</option>
                        @foreach($products as $item)
                            <option value="{{ $item->id }}" {{ old('product_id') == $item->id ? 'selected' : '' }}>{{ $item->name ?? $item->id }}</option>
                        @endforeach
                    </select>
                    @error('product_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Proveedor -->
                <div>
                    <label for="supplier_id" class="block text-sm font-semibold text-gray-700 mb-2">Proveedor</label>
                    <select name="supplier_id" id="supplier_id" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="">Seleccione un proveedor...</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name ?? $supplier->id }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Cantidad -->
                <div>
                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">Cantidad (Stock)</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700" placeholder="Ej: 50">
                    @error('quantity') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Costo Unitario -->
                <div>
                    <label for="unit_cost" class="block text-sm font-semibold text-gray-700 mb-2">Costo Unitario ($)</label>
                    <input type="number" step="0.01" name="unit_cost" id="unit_cost" value="{{ old('unit_cost') }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700" placeholder="Ej: 19.99">
                    @error('unit_cost') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Fecha Entrada -->
                <div>
                    <label for="last_restock" class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Entrada</label>
                    <input type="date" name="last_restock" id="last_restock" value="{{ old('last_restock', date('Y-m-d')) }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('last_restock') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Próxima Actualización -->
                <div>
                    <label for="update_restock" class="block text-sm font-semibold text-gray-700 mb-2">Próxima Revisión</label>
                    <input type="date" name="update_restock" id="update_restock" value="{{ old('update_restock', date('Y-m-d', strtotime('+1 month'))) }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('update_restock') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Campos ocultos necesarios para la validación del Request -->
            <input type="hidden" name="batch_number" value="123456">
            <input type="hidden" name="status" value="Activo">

            <!-- Botones de Acción -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('inventories.index') }}" class="px-6 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors text-sm">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-[#2563eb] hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm">
                    Guardar Inventario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection