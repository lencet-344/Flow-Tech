@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 bg-[#F4F7FF] min-h-screen">
    <!-- Cabecera -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#040116] tracking-tight">Editar Oferta</h1>
        <p class="text-gray-500 text-sm mt-1">Actualiza los detalles de la promoción</p>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-4xl">
        <form action="{{ route('offers.update', $offer->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Título de la Oferta</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $offer->title) }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Producto -->
                <div>
                    <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-2">Producto Aplicable</label>
                    <select name="product_id" id="product_id" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="">Seleccione un producto...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ (old('product_id', $offer->product_id) == $product->id) ? 'selected' : '' }}>{{ $product->name ?? $product->id }}</option>
                        @endforeach
                    </select>
                    @error('product_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Tipo de Oferta -->
                <div>
                    <label for="type_offer" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Oferta</label>
                    <select name="type_offer" id="type_offer" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                        <option value="Porcentaje" {{ old('type_offer', $offer->type_offer) == 'Porcentaje' ? 'selected' : '' }}>Descuento por Porcentaje</option>
                        <option value="Monto Fijo" {{ old('type_offer', $offer->type_offer) == 'Monto Fijo' ? 'selected' : '' }}>Descuento Monto Fijo</option>
                        <option value="2x1" {{ old('type_offer', $offer->type_offer) == '2x1' ? 'selected' : '' }}>2x1</option>
                    </select>
                    @error('type_offer') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Descuento -->
                <div>
                    <label for="discount" class="block text-sm font-semibold text-gray-700 mb-2">Valor del Descuento</label>
                    <input type="number" step="0.01" name="discount" id="discount" value="{{ old('discount', $offer->discount) }}" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">
                    @error('discount') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Descripción -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Descripción Corta</label>
                    <textarea name="description" id="description" rows="3" required class="w-full rounded-lg border-gray-200 shadow-sm focus:ring-[#2563eb] focus:border-[#2563eb] text-sm text-gray-700">{{ old('description', $offer->description) }}</textarea>
                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('offers.index') }}" class="px-6 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors text-sm shadow-sm">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm">
                    Actualizar oferta
                </button>
            </div>
        </form>
    </div>
</div>
@endsection