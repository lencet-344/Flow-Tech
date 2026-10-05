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
            Reportados <span id="contador-reportados" class="bg-red-50 text-red-500 text-[11px] font-bold px-2 py-0.5 rounded-full">2</span>
        </button>
        <button id="btn-sin_reporte" onclick="filtrarModeracion('sin_reporte')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Sin reportes</button>
    </div>

    <!-- Grid de Tarjetas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="contenedor-moderacion">
        
        <!-- Tarjeta 1 (Reportada) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="reportado" id="mod-card-1">
            <div class="relative h-48 w-full">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=500&q=80" alt="Ropa" class="w-full h-full object-cover">
                <span class="insignia-reportado absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-[11px] font-bold shadow-md tracking-wide">Reportado</span>
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Foto principal del negocio</h3>
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-semibold">Fotografía</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('Moda Express')">Moda Express</span> · 2026-08-20</p>
                </div>
                <div class="caja-motivo bg-red-50 text-red-600 p-3.5 rounded-xl text-[13px] font-medium border border-red-100">
                    <strong>Motivo:</strong> Reportada por usuario
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button type="button" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('Moda Express')" class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button type="button" onclick="aprobarContenido(this)" class="btn-aprobar flex-1 bg-green-50 text-green-600 hover:bg-green-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Aprobar</button>
                    <button type="button" onclick="abrirModalEliminarContenido(this)" class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2 (Reportada) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="reportado" id="mod-card-2">
            <div class="relative h-48 w-full">
                <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500&q=80" alt="Laptop" class="w-full h-full object-cover">
                <span class="insignia-reportado absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-[11px] font-bold shadow-md tracking-wide">Reportado</span>
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Foto de producto - Laptop HP</h3>
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-semibold">Fotografía</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('TechSolutions GT')">TechSolutions GT</span> · 2026-08-18</p>
                </div>
                <div class="caja-motivo bg-red-50 text-red-600 p-3.5 rounded-xl text-[13px] font-medium border border-red-100">
                    <strong>Motivo:</strong> Imagen no corresponde al producto
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button type="button" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('TechSolutions GT')" class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button type="button" onclick="aprobarContenido(this)" class="btn-aprobar flex-1 bg-green-50 text-green-600 hover:bg-green-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Aprobar</button>
                    <button type="button" onclick="abrirModalEliminarContenido(this)" class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3 (Sin Reporte) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="sin_reporte" id="mod-card-3">
            <div class="relative h-48 w-full">
                <img src="https://images.unsplash.com/photo-1534452203293-494d7ddbf7e0?w=500&q=80" alt="Local" class="w-full h-full object-cover">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Foto del local</h3>
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-semibold">Fotografía</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('Distribuidora Alimentos Norte')">Distribuidora Alimentos Norte</span> · 2026-08-15</p>
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button type="button" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('Distribuidora Alimentos Norte')" class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button type="button" onclick="abrirModalEliminarContenido(this)" class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta 4 (Sin Reporte - Texto) -->
        <div class="mod-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col" data-estado="sin_reporte" id="mod-card-4">
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div>
                    <h3 class="text-[16px] font-bold text-gray-900 mb-2">Descripción del negocio</h3>
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-[11px] font-semibold">Publicación</span>
                    <p class="text-[13px] text-gray-500 mt-3"><span class="text-blue-600 font-medium cursor-pointer hover:underline" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('Construcciones Sólidas')">Construcciones Sólidas</span> · 2026-08-10</p>
                </div>
                <div class="flex items-center gap-2 mt-auto pt-2">
                    <button type="button" onclick="window.location.href='{{ url('/perfil-publico') }}?negocio=' + encodeURIComponent('Construcciones Sólidas')" class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-semibold transition">Ver negocio</button>
                    <button type="button" onclick="abrirModalEliminarContenido(this)" class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 py-2.5 rounded-xl text-[13px] font-semibold transition">Eliminar</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Pequeño Modal de Confirmación de Eliminación -->
<div id="modal-confirmar-eliminar" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-xl border border-gray-100 p-6 text-center">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">¿Eliminar este contenido?</h3>
        <p class="text-sm text-gray-500 mb-6">Esta acción es permanente y no se puede deshacer.</p>
        
        <div class="flex justify-center gap-3">
            <button type="button" onclick="cerrarModalEliminar()" class="px-4 py-2 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Cancelar</button>
            <button type="button" id="btn-confirmar-eliminar" class="px-4 py-2 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition shadow-sm">Sí, Eliminar</button>
        </div>
    </div>
</div>

<script>
    let filtroModeracionActivo = 'todos';

    function filtrarModeracion(estado) {
        filtroModeracionActivo = estado;
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        const botonActivo = document.getElementById('btn-' + estado);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        const cartas = document.querySelectorAll('.mod-card');
        cartas.forEach(carta => {
            if (estado === 'todos' || carta.getAttribute('data-estado') === estado) {
                carta.style.display = 'flex';
            } else {
                carta.style.display = 'none';
            }
        });
    }

    function actualizarContadorReportados(cambio) {
        const badge = document.getElementById('contador-reportados');
        if (badge) {
            let actual = parseInt(badge.innerText);
            let nuevo = actual + cambio;
            if (nuevo < 0) nuevo = 0;
            badge.innerText = nuevo;
        }
    }

    function aprobarContenido(btnElement) {
        const tarjeta = btnElement.closest('.mod-card');
        
        if (tarjeta.getAttribute('data-estado') === 'reportado') {
            actualizarContadorReportados(-1);
        }

        tarjeta.setAttribute('data-estado', 'sin_reporte');
        
        const insignia = tarjeta.querySelector('.insignia-reportado');
        if (insignia) insignia.style.display = 'none';
        
        const cajaMotivo = tarjeta.querySelector('.caja-motivo');
        if (cajaMotivo) cajaMotivo.style.display = 'none';
        
        btnElement.style.display = 'none';

        if (filtroModeracionActivo !== 'todos') {
            filtrarModeracion(filtroModeracionActivo);
        }
    }

    let tarjetaEliminarActual = null;

    function abrirModalEliminarContenido(btnElement) {
        tarjetaEliminarActual = btnElement.closest('.mod-card');
        document.getElementById('modal-confirmar-eliminar').style.display = 'flex';
    }

    function cerrarModalEliminar() {
        document.getElementById('modal-confirmar-eliminar').style.display = 'none';
        tarjetaEliminarActual = null;
    }

    document.getElementById('btn-confirmar-eliminar').addEventListener('click', function() {
        if (tarjetaEliminarActual) {
            if (tarjetaEliminarActual.getAttribute('data-estado') === 'reportado') {
                actualizarContadorReportados(-1);
            }
            tarjetaEliminarActual.remove();
        }
        cerrarModalEliminar();
    });
</script>
@endsection
