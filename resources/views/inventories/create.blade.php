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
                <div x-data="{
                    open: false,
                    search: '{{ old('product_name') }}',
                    selectedId: '{{ old('product_id') }}',
                    products: {{ json_encode($products->map(function($p) { return ['id' => $p->id, 'name' => $p->name ?? $p->id]; })) }},
                    get filteredProducts() {
                        if (this.search === '') return this.products;
                        return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()));
                    },
                    selectProduct(product) {
                        this.search = product.name;
                        this.selectedId = product.id;
                        this.open = false;
                    }
                }" class="relative">
                    <label for="product_name" class="block text-sm font-semibold text-gray-700 mb-2">Producto</label>
                    <input type="hidden" name="product_id" :value="selectedId">
                    <input type="text" name="product_name" id="product_name" x-model="search" @input="open = true; selectedId = ''" @focus="open = true" @click.away="open = false" class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700" placeholder="Buscar o escribir nuevo..." autocomplete="off">
                    
                    <div x-show="open" style="display: none;" class="absolute z-10 w-full bg-white border border-gray-200 mt-1 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                        <template x-for="product in filteredProducts" :key="product.id">
                            <div @click="selectProduct(product)" class="px-4 py-2 cursor-pointer hover:bg-blue-50 text-sm text-gray-700" x-text="product.name"></div>
                        </template>
                        <div x-show="search.length > 0 && !products.some(p => p.name.toLowerCase() === search.toLowerCase())" class="px-4 py-2 text-sm text-blue-600 bg-blue-50 cursor-pointer" @click="open = false">
                            Crear nuevo: <span x-text="search" class="font-bold"></span>
                        </div>
                    </div>
                    @error('product_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    @error('product_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Unidad de Medida / Presentación -->
                <div>
                    <label for="presentation" class="block text-sm font-semibold text-gray-700 mb-2">Unidad de Medida</label>
                    <select name="presentation" id="presentation" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="">Seleccione...</option>
                        <option value="Unidades" {{ old('presentation') == 'Unidades' ? 'selected' : '' }}>Unidades</option>
                        <option value="Libras (lb)" {{ old('presentation') == 'Libras (lb)' ? 'selected' : '' }}>Libras (lb)</option>
                        <option value="Litros (L)" {{ old('presentation') == 'Litros (L)' ? 'selected' : '' }}>Litros (L)</option>
                        <option value="Kilogramos (kg)" {{ old('presentation') == 'Kilogramos (kg)' ? 'selected' : '' }}>Kilogramos (kg)</option>
                        <option value="Gramos (g)" {{ old('presentation') == 'Gramos (g)' ? 'selected' : '' }}>Gramos (g)</option>
                        <option value="Mililitros (ml)" {{ old('presentation') == 'Mililitros (ml)' ? 'selected' : '' }}>Mililitros (ml)</option>
                        <option value="Cajas" {{ old('presentation') == 'Cajas' ? 'selected' : '' }}>Cajas</option>
                        <option value="Sacos" {{ old('presentation') == 'Sacos' ? 'selected' : '' }}>Sacos</option>
                        <option value="Paquetes" {{ old('presentation') == 'Paquetes' ? 'selected' : '' }}>Paquetes</option>
                        <option value="Galones" {{ old('presentation') == 'Galones' ? 'selected' : '' }}>Galones</option>
                        <option value="Docenas" {{ old('presentation') == 'Docenas' ? 'selected' : '' }}>Docenas</option>
                        <option value="Lotes" {{ old('presentation') == 'Lotes' ? 'selected' : '' }}>Lotes</option>
                    </select>
                    @error('presentation') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Proveedor -->
                <div>
                    <label for="supplier_id" class="block text-sm font-semibold text-gray-700 mb-2">Proveedor</label>
                    <select name="supplier_id" id="supplier_id" class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="">Seleccione un proveedor (Opcional - Aleatorio si se deja vacío)...</option>
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