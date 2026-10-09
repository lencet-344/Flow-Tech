@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Editar Inventario</h1>
        <p class="text-gray-500 text-sm mt-1">Actualiza los datos del lote registrado</p>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-4xl">
        <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Producto -->
                <div x-data="{
                    open: false,
                    search: '{{ old('product_name', $inventory->product->name ?? '') }}',
                    selectedId: '{{ old('product_id', $inventory->product_id ?? '') }}',
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
                        @php $currentPres = old('presentation', $inventory->product->presentation ?? ''); @endphp
                        <option value="Unidades" {{ $currentPres == 'Unidades' ? 'selected' : '' }}>Unidades</option>
                        <option value="Libras (lb)" {{ $currentPres == 'Libras (lb)' ? 'selected' : '' }}>Libras (lb)</option>
                        <option value="Litros (L)" {{ $currentPres == 'Litros (L)' ? 'selected' : '' }}>Litros (L)</option>
                        <option value="Kilogramos (kg)" {{ $currentPres == 'Kilogramos (kg)' ? 'selected' : '' }}>Kilogramos (kg)</option>
                        <option value="Gramos (g)" {{ $currentPres == 'Gramos (g)' ? 'selected' : '' }}>Gramos (g)</option>
                        <option value="Mililitros (ml)" {{ $currentPres == 'Mililitros (ml)' ? 'selected' : '' }}>Mililitros (ml)</option>
                        <option value="Cajas" {{ $currentPres == 'Cajas' ? 'selected' : '' }}>Cajas</option>
                        <option value="Sacos" {{ $currentPres == 'Sacos' ? 'selected' : '' }}>Sacos</option>
                        <option value="Paquetes" {{ $currentPres == 'Paquetes' ? 'selected' : '' }}>Paquetes</option>
                        <option value="Galones" {{ $currentPres == 'Galones' ? 'selected' : '' }}>Galones</option>
                        <option value="Docenas" {{ $currentPres == 'Docenas' ? 'selected' : '' }}>Docenas</option>
                        <option value="Lotes" {{ $currentPres == 'Lotes' ? 'selected' : '' }}>Lotes</option>
                        @if($currentPres && !in_array($currentPres, ['Unidades','Libras (lb)','Litros (L)','Kilogramos (kg)','Gramos (g)','Mililitros (ml)','Cajas','Sacos','Paquetes','Galones','Docenas','Lotes']))
                            <option value="{{ $currentPres }}" selected>{{ $currentPres }}</option>
                        @endif
                    </select>
                    @error('presentation') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Proveedor -->
                <div>
                    <label for="supplier_id" class="block text-sm font-semibold text-gray-700 mb-2">Proveedor</label>
                    <select name="supplier_id" id="supplier_id" class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="">Seleccione un proveedor (Opcional - Aleatorio si se deja vacío)...</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ (old('supplier_id', $inventory->supplier_id) == $supplier->id) ? 'selected' : '' }}>{{ $supplier->name ?? $supplier->id }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Cantidad -->
                <div>
                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">Cantidad (Stock)</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $inventory->quantity) }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('quantity') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Costo Unitario -->
                <div>
                    <label for="unit_cost" class="block text-sm font-semibold text-gray-700 mb-2">Costo Unitario ($)</label>
                    <input type="number" step="0.01" name="unit_cost" id="unit_cost" value="{{ old('unit_cost', $inventory->unit_cost) }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('unit_cost') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Fecha Entrada -->
                <div>
                    <label for="last_restock" class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Entrada</label>
                    <input type="date" name="last_restock" id="last_restock" value="{{ old('last_restock', $inventory->last_restock ? date('Y-m-d', strtotime($inventory->last_restock)) : '') }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('last_restock') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Próxima Actualización -->
                <div>
                    <label for="update_restock" class="block text-sm font-semibold text-gray-700 mb-2">Próxima Revisión</label>
                    <input type="date" name="update_restock" id="update_restock" value="{{ old('update_restock', $inventory->update_restock ? date('Y-m-d', strtotime($inventory->update_restock)) : '') }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('update_restock') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Número de Lote (Editable en el Update) -->
                <div>
                    <label for="batch_number" class="block text-sm font-semibold text-gray-700 mb-2">Número de Lote</label>
                    <input type="text" name="batch_number" id="batch_number" value="{{ old('batch_number', $inventory->batch_number) }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('batch_number') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                    <select name="status" id="status" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="Disponible" {{ old('status', $inventory->status) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Agotado" {{ old('status', $inventory->status) == 'Agotado' ? 'selected' : '' }}>Agotado</option>
                        <option value="Activo" {{ old('status', $inventory->status) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('status', $inventory->status) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('inventories.index') }}" class="px-6 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors text-sm">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-[#2563eb] hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm">
                    Actualizar Inventario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection