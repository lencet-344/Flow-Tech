<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
                {{ __('Ver Usuario') }}
            </h2>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-xl font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-8">
                
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">Información del Usuario</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">ID del Usuario</span>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">#{{ $user->id }}</p>
                        </div>
                        
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</span>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                        </div>
                        
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Correo Electrónico</span>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                        </div>

                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Creación</span>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $user->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-100 dark:border-gray-700">
                    <form id="form-delete-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmarEliminacion({{ $user->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Eliminar
                        </button>
                    </form>

                    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                        Editar Usuario
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Eliminar de forma permanente?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#1e293b',
                color: '#ffffff',
                customClass: {
                    popup: 'rounded-2xl border border-gray-700'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-delete-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>