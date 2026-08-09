<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Detalle de Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $product->name }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Tipo</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $product->type }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Cantidad</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $product->quantity }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Costo</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $product->cost }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Presentación</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $product->presentation }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Estado</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $product->state }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Code_bar</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $product->code_bar }}</p>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>