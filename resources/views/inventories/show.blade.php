<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Detalles de Inventario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Cantidad</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->quantity }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Batch number</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->batch_number }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Unit cost</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->unit_cost }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Estado</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->status }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Last restock</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->last_restock }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Update restock</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->update_restock }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Product id</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->product->name ?? $inventory->product->title ?? $inventory->product->id ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Supplier id</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->supplier->name ?? $inventory->supplier->title ?? $inventory->supplier->id ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Order detail id</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $inventory->order_detail->name ?? $inventory->order_detail->title ?? $inventory->order_detail->id ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('inventories.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>