<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Editar Inventory
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-8">
                <form action="{{ route('inventories.update', $inventory->id) }}" method="POST" id="form-edit-{{ $inventory->id }}" onsubmit="confirmarActualizacion(event, {{ $inventory->id }})">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                        <input type="text" name="quantity" id="quantity" value="{{ old('quantity', $inventory->quantity) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="batch_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Batch number</label>
                        <input type="text" name="batch_number" id="batch_number" value="{{ old('batch_number', $inventory->batch_number) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('batch_number')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="unit_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit cost</label>
                        <input type="text" name="unit_cost" id="unit_cost" value="{{ old('unit_cost', $inventory->unit_cost) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('unit_cost')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <input type="text" name="status" id="status" value="{{ old('status', $inventory->status) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="last_restock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last restock</label>
                        <input type="text" name="last_restock" id="last_restock" value="{{ old('last_restock', $inventory->last_restock) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('last_restock')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="update_restock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Update restock</label>
                        <input type="text" name="update_restock" id="update_restock" value="{{ old('update_restock', $inventory->update_restock) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('update_restock')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product id</label>
                        <select name="product_id" id="product_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Seleccione una opción</option>
                            @foreach($products as $item)
                                <option value="{{ $item->id }}" {{ old('product_id', $inventory->product_id) == $item->id ? 'selected' : '' }}>{{ $item->name ?? $item->title ?? $item->id }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier id</label>
                        <select name="supplier_id" id="supplier_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Seleccione una opción</option>
                            @foreach($suppliers as $item)
                                <option value="{{ $item->id }}" {{ old('supplier_id', $inventory->supplier_id) == $item->id ? 'selected' : '' }}>{{ $item->name ?? $item->title ?? $item->id }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="order_detail_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order detail id</label>
                        <select name="order_detail_id" id="order_detail_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Seleccione una opción</option>
                            @foreach($order_details as $item)
                                <option value="{{ $item->id }}" {{ old('order_detail_id', $inventory->order_detail_id) == $item->id ? 'selected' : '' }}>{{ $item->name ?? $item->title ?? $item->id }}</option>
                            @endforeach
                        </select>
                        @error('order_detail_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('inventories.index') }}" class="mr-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 active:text-gray-800 active:bg-gray-50 transition">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarActualizacion(event, id) {
            event.preventDefault();
            Swal.fire({
                title: '¿Guardar cambios?',
                text: "Se actualizará el registro",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#f8fafc' : '#000'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-edit-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>