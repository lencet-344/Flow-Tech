<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Detalles de Orden
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Cantidad</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $order->quantity }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Precio</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $order->price }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Costo</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $order->cost }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Entrega</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $order->date_delivery }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Verificación de Compra</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $order->buy_verification->name ?? $order->buy_verification->title ?? $order->buy_verification->id ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Usuario</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $order->user->name ?? $order->user->title ?? $order->user->id ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>