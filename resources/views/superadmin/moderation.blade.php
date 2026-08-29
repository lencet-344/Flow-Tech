@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <!-- Icono de Moderación -->
            <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><circle cx="12" cy="11" r="3"></circle></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Moderación</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-10">Revisión de fotografías y publicaciones de negocios</p>
    </div>

    <!-- Filtros -->
    <div class="flex items-center gap-3 mb-8 overflow-x-auto pb-2 md:pb-0">
        <button id="btn-todos" onclick="filtrarModeracion('todos')" class="filter-btn bg-[#2563eb] text-white border border-transparent px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm transition whitespace-nowrap">Todo el contenido</button>
        <button id="btn-reportado" onclick="filtrarModeracion('reportado')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap flex items-center gap-2">
            Reportados <span class="bg-red-50 text-red-500 text-[11px] font-bold px-2 py-0.5 rounded-full">2</span>
        </button>
        <button id="btn-sin_reporte" onclick="filtrarModeracion('sin_reporte')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Sin reportes</button>
    </div>

    <!-- Grid de Tarjetas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Tarjeta 1 (Reportada) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="reportado">
            <div class="relative h-48 w-full">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=500&q=80" alt="Ropa" class="w-full h-full object-cover">
                <span class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-[11px] font-bold shadow-md tracking-wide">Reportado</span>
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Foto principal del negocio</h3>
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-semibold">Fotografía</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline">Moda Express</span> · 2026-08-20</p>
                </div>
                <div class="bg-red-50 text-red-600 p-3.5 rounded-xl text-[13px] font-medium border border-red-100">
                    <strong>Motivo:</strong> Reportada por usuario
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button class="flex-1 bg-green-50 text-green-600 hover:bg-green-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Aprobar</button>
                    <button class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2 (Reportada) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="reportado">
            <div class="relative h-48 w-full">
                <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500&q=80" alt="Laptop" class="w-full h-full object-cover">
                <span class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-[11px] font-bold shadow-md tracking-wide">Reportado</span>
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Foto de producto - Laptop HP</h3>
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-semibold">Fotografía</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline">TechSolutions GT</span> · 2026-08-18</p>
                </div>
                <div class="bg-red-50 text-red-600 p-3.5 rounded-xl text-[13px] font-medium border border-red-100">
                    <strong>Motivo:</strong> Imagen no corresponde al producto
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button class="flex-1 bg-green-50 text-green-600 hover:bg-green-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Aprobar</button>
                    <button class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3 (Sin Reporte) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="sin_reporte">
            <div class="relative h-48 w-full">
                <img src="https://images.unsplash.com/photo-1534452203293-494d7ddbf7e0?w=500&q=80" alt="Local" class="w-full h-full object-cover">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Foto del local</h3>
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-semibold">Fotografía</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline">Distribuidora Alimentos Norte</span> · 2026-08-15</p>
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 4 (Sin Reporte - Texto) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="sin_reporte">
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Descripción del negocio</h3>
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-[11px] font-semibold">Publicación</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline">Construcciones Sólidas</span> · 2026-08-10</p>
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Lógica de Filtrado -->
<script>
    function filtrarModeracion(estado) {
        // 1. Reseteamos los botones
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        // 2. Pintamos de azul el botón activo
        const botonActivo = document.getElementById('btn-' + estado);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        // 3. Filtramos las tarjetas instantáneamente
        const cartas = document.querySelectorAll('.mod-card');
        cartas.forEach(carta => {
            if (estado === 'todos' || carta.getAttribute('data-estado') === estado) {
                carta.style.display = 'flex'; // Usamos flex para no romper la estructura interna de la tarjeta
            } else {
                carta.style.display = 'none'; // Ocultar
            }
        });
    }
</script>
@endsection
