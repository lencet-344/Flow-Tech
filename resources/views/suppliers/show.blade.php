<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Detalle de Supplier
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Name</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->name }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Age</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->age }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Gender</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->gender }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Address</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->address }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->email }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Telephone</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->telephone }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Identification_card</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->identification_card }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Company</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->company }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Code_company</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->code_company }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">No_inss</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $supplier->No_INSS }}</p>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>