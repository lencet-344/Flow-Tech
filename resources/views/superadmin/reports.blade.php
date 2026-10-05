@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <!-- Icono de Bandera (Reportes) -->
            <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Reportes</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-10">Negocios y contenido reportado por usuarios</p>
    </div>

    <!-- Filtros -->
    <div class="flex items-center gap-3 mb-8 overflow-x-auto pb-2 md:pb-0">
        <button id="btn-pendiente" onclick="filtrarReportes('pendiente')" class="filter-btn bg-[#2563eb] text-white border border-transparent px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm transition whitespace-nowrap">Pendientes</button>
        <button id="btn-resuelto" onclick="filtrarReportes('resuelto')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Resueltos</button>
        <button id="btn-todos" onclick="filtrarReportes('todos')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Todos</button>
    </div>

    <!-- Lista de Tarjetas -->
    <div class="flex flex-col gap-4">
        
        <!-- Tarjeta 1 -->
        <div class="report-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="pendiente" onclick="abrirModalReporte(this, 'Moda Express', 'Información falsa en el perfil', 'Roberto Lima · 2026-08-18')">
            <div class="flex items-start gap-4">
                <span class="px-3 py-1 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full mt-0.5">Negocio</span>
                <div>
                    <h3 class="text-[16px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors">Moda Express</h3>
                    <p class="text-[14px] text-gray-700 mt-0.5">Información falsa en el perfil</p>
                    <p class="text-[12.5px] text-gray-500 mt-1">Reportado por Roberto Lima · 2026-08-18</p>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <span class="status-badge px-4 py-1.5 bg-red-50 text-red-500 text-[11px] font-bold rounded-full">Pendiente</span>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="report-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="pendiente" onclick="abrirModalReporte(this, 'TechSolutions GT', 'Imagen inapropiada', 'Laura Sánchez · 2026-08-20')">
            <div class="flex items-start gap-4">
                <span class="px-3 py-1 bg-purple-50 text-purple-600 text-[11px] font-bold rounded-full mt-0.5">Contenido</span>
                <div>
                    <h3 class="text-[16px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors">Foto de producto - Laptop HP</h3>
                    <p class="text-[14px] text-gray-700 mt-0.5">Imagen inapropiada</p>
                    <p class="text-[12.5px] text-gray-500 mt-1">Reportado por Laura Sánchez · 2026-08-20</p>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <span class="status-badge px-4 py-1.5 bg-red-50 text-red-500 text-[11px] font-bold rounded-full">Pendiente</span>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="report-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="pendiente" onclick="abrirModalReporte(this, 'Distribuidora Alimentos Norte', 'Negocio no existe', 'María González · 2026-08-21')">
            <div class="flex items-start gap-4">
                <span class="px-3 py-1 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full mt-0.5">Negocio</span>
                <div>
                    <h3 class="text-[16px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors">Distribuidora Alimentos Norte</h3>
                    <p class="text-[14px] text-gray-700 mt-0.5">Negocio no existe</p>
                    <p class="text-[12.5px] text-gray-500 mt-1">Reportado por María González · 2026-08-21</p>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <span class="status-badge px-4 py-1.5 bg-red-50 text-red-500 text-[11px] font-bold rounded-full">Pendiente</span>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <!-- Tarjeta Oculta de Prueba (Resuelto) -->
        <div class="report-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="resuelto" style="display: none;" onclick="abrirModalReporte(this, 'Construcciones Sólidas', 'Spam en los comentarios', 'Carlos Pérez · 2026-08-15')">
            <div class="flex items-start gap-4">
                <span class="px-3 py-1 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full mt-0.5">Negocio</span>
                <div>
                    <h3 class="text-[16px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors">Construcciones Sólidas</h3>
                    <p class="text-[14px] text-gray-700 mt-0.5">Spam en los comentarios</p>
                    <p class="text-[12.5px] text-gray-500 mt-1">Reportado por Carlos Pérez · 2026-08-15</p>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <span class="status-badge px-4 py-1.5 bg-green-50 text-green-600 text-[11px] font-bold rounded-full">Resuelto</span>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

    </div>
</div>

<!-- Modal Reporte SINGKI -->
<div id="modal-detalle-reporte" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-gray-100 p-6 text-left">
        <h3 class="text-xl font-bold text-gray-900 mb-4" id="modal-titulo-reporte">Título Reporte</h3>
        <p class="text-gray-700 font-medium mb-1"><strong>Motivo:</strong> <span id="modal-motivo-reporte">...</span></p>
        <p class="text-gray-500 text-sm mb-6"><strong>Detalle:</strong> <span id="modal-detalle-info">...</span></p>
        
        <div class="flex justify-end gap-3">
            <button type="button" onclick="cerrarModalReporte()" class="px-4 py-2 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Cerrar</button>
            <button type="button" id="btn-ver-negocio" class="px-4 py-2 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-100 transition">Ver negocio</button>
            <button type="button" id="btn-marcar-resuelto" class="px-4 py-2 bg-green-500 text-white font-bold rounded-xl hover:bg-green-600 transition shadow-sm">Marcar como Resuelto</button>
        </div>
    </div>
</div>

<!-- Lógica de Filtrado por Estado -->
<script>
    let filtroActivo = 'pendiente';

    function filtrarReportes(estado) {
        filtroActivo = estado;
        // 1. Reseteamos el estilo de todos los botones de filtro al estado inactivo
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        // 2. Pintamos de azul el botón que acabamos de clickear
        const botonActivo = document.getElementById('btn-' + estado);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        // 3. Filtramos las tarjetas instantáneamente
        const cartas = document.querySelectorAll('.report-card');
        cartas.forEach(carta => {
            if (estado === 'todos' || carta.getAttribute('data-estado') === estado) {
                carta.style.display = ''; // Mostrar
            } else {
                carta.style.display = 'none'; // Ocultar
            }
        });
    }

    let tarjetaActual = null;

    function abrirModalReporte(elemento, negocio, motivo, detalle) {
        tarjetaActual = elemento;
        document.getElementById('modal-titulo-reporte').innerText = 'Reporte sobre: ' + negocio;
        document.getElementById('modal-motivo-reporte').innerText = motivo;
        document.getElementById('modal-detalle-info').innerText = detalle;
        
        document.getElementById('btn-ver-negocio').onclick = function() {
            window.location.href = "{{ url('/perfil-publico') }}?negocio=" + encodeURIComponent(negocio.replace('Foto de producto - ', ''));
        };

        const btnResuelto = document.getElementById('btn-marcar-resuelto');
        if (elemento.getAttribute('data-estado') === 'resuelto') {
            btnResuelto.style.display = 'none';
        } else {
            btnResuelto.style.display = 'block';
            btnResuelto.onclick = function() {
                marcarComoResuelto(elemento);
            };
        }

        document.getElementById('modal-detalle-reporte').style.display = 'flex';
    }

    function cerrarModalReporte() {
        document.getElementById('modal-detalle-reporte').style.display = 'none';
        tarjetaActual = null;
    }

    function marcarComoResuelto(carta) {
        carta.setAttribute('data-estado', 'resuelto');
        const badge = carta.querySelector('.status-badge');
        if(badge) {
            badge.innerText = 'Resuelto';
            badge.className = 'status-badge px-4 py-1.5 bg-green-50 text-green-600 text-[11px] font-bold rounded-full';
        }
        cerrarModalReporte();
        filtrarReportes(filtroActivo);
    }
</script>
@endsection
