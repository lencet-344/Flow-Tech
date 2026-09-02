@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-1">
            <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Usuarios</h1>
        </div>
        <p class="text-gray-500 text-sm font-light ml-9">6 usuarios registrados en la plataforma</p>
    </div>

    <!-- Barra de Búsqueda y Filtros -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div class="w-full md:w-1/2 relative">
            <input type="text" placeholder="Buscar por nombre o correo..." class="w-full pl-5 pr-4 py-3 rounded-2xl border-0 shadow-sm text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
        </div>
        <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
            <button class="bg-[#040116] text-white px-6 py-3 rounded-2xl text-sm font-medium shadow-sm hover:bg-gray-900 transition whitespace-nowrap">Buscar</button>
            <button id="btn-todos" onclick="filtrarUsuarios('todos')" class="filter-btn bg-[#2563eb] text-white border border-transparent px-6 py-3 rounded-2xl text-sm font-medium shadow-sm transition whitespace-nowrap">Todos</button>
            <button id="btn-cliente" onclick="filtrarUsuarios('cliente')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-3 rounded-2xl text-sm font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Clientes</button>
            <button id="btn-proveedor" onclick="filtrarUsuarios('proveedor')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-3 rounded-2xl text-sm font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Proveedores</button>
        </div>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-[1.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto w-full bg-white rounded-lg shadow">
<table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-5">Usuario</th>
                        <th class="px-6 py-5">Correo</th>
                        <th class="px-6 py-5">Rol</th>
                        <th class="px-6 py-5">Registro</th>
                        <th class="px-6 py-5">Estado</th>
                        <th class="px-6 py-5 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] text-gray-700 divide-y divide-gray-50" id="tabla-usuarios">
                    @forelse($users as $user)
                    <tr class="user-row hover:bg-gray-50/50 transition" data-rol="{{ strtolower($user->role) }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span class="font-medium text-[#040116]">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if(strtolower($user->role) === 'cliente')
                                <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-xs font-semibold">Cliente</span>
                            @elseif(strtolower($user->role) === 'proveedor')
                                <span class="bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full text-xs font-semibold">Proveedor</span>
                            @else
                                <span class="bg-gray-50 text-gray-600 px-4 py-1.5 rounded-full text-xs font-semibold">{{ ucfirst($user->role) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @if(($user->status ?? 'activo') === 'activo')
                                <span class="bg-green-50 text-green-500 px-4 py-1.5 rounded-full text-xs font-semibold">Activo</span>
                            @else
                                <span class="bg-red-50 text-red-500 px-4 py-1.5 rounded-full text-xs font-semibold">Suspendido</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                @if(($user->status ?? 'activo') === 'activo')
                                    <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-100 px-4 py-1.5 rounded-md text-xs font-semibold transition">Suspender</button>
                                @else
                                    <button type="submit" class="bg-green-50 text-green-600 hover:bg-green-100 px-4 py-1.5 rounded-md text-xs font-semibold transition">Reactivar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-sm">No hay usuarios registrados en el sistema.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
</div>
        </div>
    </div>
</div>

<!-- Lógica de Filtrado por Rol -->
<script>
    function filtrarUsuarios(rol) {
        // 1. Reseteamos el estilo de todos los botones de filtro al estado inactivo (blanco)
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        // 2. Pintamos de azul el botón que acabamos de clickear
        const botonActivo = document.getElementById('btn-' + rol);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        // 3. Filtramos las filas de la tabla instantáneamente
        const filas = document.querySelectorAll('.user-row');
        filas.forEach(fila => {
            if (rol === 'todos' || fila.getAttribute('data-rol') === rol) {
                fila.style.display = ''; // Mostrar
            } else {
                fila.style.display = 'none'; // Ocultar
            }
        });
    }
</script>
@endsection
