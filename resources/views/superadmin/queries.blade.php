@extends('layouts.superadmin')

@section('content')
@php $item = null; @endphp
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <!-- Icono de Pregunta -->
            <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Consultas</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-10">Todas las consultas recibidas de usuarios y negocios</p>
    </div>

    <!-- Filtros -->
    <div class="flex items-center gap-3 mb-8 overflow-x-auto pb-2 md:pb-0">
        <button id="btn-abierta" onclick="filtrarConsultas('abierta')" class="filter-btn bg-[#2563eb] text-white border border-transparent px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm transition whitespace-nowrap">Abiertas</button>
        <button id="btn-cerrada" onclick="filtrarConsultas('cerrada')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Cerradas</button>
        <button id="btn-todos" onclick="filtrarConsultas('todos')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Todas</button>
    </div>

    <!-- 3 Tarjetas de Métricas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div id="count-total" class="text-[36px] font-bold text-[#040116] leading-none mb-2">5</div>
            <div class="text-[13px] text-gray-500 font-medium">Total consultas</div>
        </div>
        <!-- Abiertas -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div id="count-abiertas" class="text-[36px] font-bold text-[#040116] leading-none mb-2">4</div>
            <div class="text-[13px] text-gray-500 font-medium">Abiertas</div>
        </div>
        <!-- Cerradas -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div id="count-cerradas" class="text-[36px] font-bold text-[#040116] leading-none mb-2">1</div>
            <div class="text-[13px] text-gray-500 font-medium">Cerradas</div>
        </div>
    </div>

    <!-- Tabla de Consultas -->
    <div class="bg-white rounded-[1.2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto w-full bg-white rounded-lg shadow">
<table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-bold text-gray-900 uppercase tracking-wider">
                        <th class="px-6 py-5">Asunto</th>
                        <th class="px-6 py-5">Usuario</th>
                        <th class="px-6 py-5">Prioridad</th>
                        <th class="px-6 py-5">Fecha</th>
                        <th class="px-6 py-5">Estado</th>
                        <th class="px-6 py-5 text-center">Ver</th>
                    </tr>
                </thead>
                <tbody class="text-[13.5px] text-gray-800 divide-y divide-gray-50" id="tabla-consultas">
                    
                    <!-- Fila 1 -->
                    <tr class="consulta-row hover:bg-gray-50/50 transition" data-estado="abierta">
                        <td class="px-6 py-4 font-medium text-gray-900 consulta-asunto">No puedo completar mi registro</td>
                        <td class="px-6 py-4 text-gray-600">Diego Torres</td>
                        <td class="px-6 py-4">
                            <!-- Degradado Rojo -->
                            <span class="inline-block bg-gradient-to-r from-red-100 to-transparent text-red-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Alta</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-21</td>
                        <td class="px-6 py-4">
                            <span class="badge-estado inline-block bg-gradient-to-r from-blue-100 to-transparent text-blue-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Abierta</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="abrirModalConsulta(this, 'No puedo completar mi registro', 'Diego Torres', 'Alta')" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>
                        </td>
                    </tr>

                    <!-- Fila 2 -->
                    <tr class="consulta-row hover:bg-gray-50/50 transition" data-estado="abierta">
                        <td class="px-6 py-4 font-medium text-gray-900 consulta-asunto">Mi negocio no aparece en los resultados de búsqueda</td>
                        <td class="px-6 py-4 text-gray-600">Ana Rodríguez</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-yellow-100 to-transparent text-yellow-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Media</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-20</td>
                        <td class="px-6 py-4">
                            <span class="badge-estado inline-block bg-gradient-to-r from-blue-100 to-transparent text-blue-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Abierta</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="abrirModalConsulta(this, 'Mi negocio no aparece en los resultados de búsqueda', 'Ana Rodríguez', 'Media')" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>
                        </td>
                    </tr>

                    <!-- Fila 3 -->
                    <tr class="consulta-row hover:bg-gray-50/50 transition" data-estado="abierta">
                        <td class="px-6 py-4 font-medium text-gray-900 consulta-asunto">¿Cómo elimino una reserva de un cliente?</td>
                        <td class="px-6 py-4 text-gray-600">Carlos Pérez</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-slate-200 to-transparent text-slate-700 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Baja</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-19</td>
                        <td class="px-6 py-4">
                            <span class="badge-estado inline-block bg-gradient-to-r from-blue-100 to-transparent text-blue-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Abierta</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="abrirModalConsulta(this, '¿Cómo elimino una reserva de un cliente?', 'Carlos Pérez', 'Baja')" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>
                        </td>
                    </tr>

                    <!-- Fila 4 -->
                    <tr class="consulta-row hover:bg-gray-50/50 transition" data-estado="cerrada" style="display: none;">
                        <td class="px-6 py-4 font-medium text-gray-500 line-through consulta-asunto">Error al subir foto del negocio</td>
                        <td class="px-6 py-4 text-gray-600">Sofía Mejía</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-yellow-100 to-transparent text-yellow-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Media</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-18</td>
                        <td class="px-6 py-4">
                            <span class="badge-estado inline-block bg-gradient-to-r from-gray-200 to-transparent text-gray-800 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Cerrada</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="abrirModalConsulta(this, 'Error al subir foto del negocio', 'Sofía Mejía', 'Media')" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal SINGKI -->
<div id="modal-atencion-consulta" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-xl border border-gray-100 p-8 text-left">
        <div id="modal-alerta-consulta-exito" class="hidden bg-green-50 text-green-700 p-3 rounded-lg text-sm mb-4 font-bold">Respuesta enviada y caso cerrado con éxito.</div>
        <h3 class="text-xl font-bold text-gray-900 mb-2" id="modal-asunto-consulta">Asunto</h3>
        <p class="text-sm text-gray-500 mb-6">Usuario: <strong id="modal-usuario-consulta">...</strong> | Prioridad: <strong id="modal-prioridad-consulta">...</strong></p>
        
        <textarea id="modal-respuesta-consulta" class="w-full h-32 p-4 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6 resize-none" placeholder="Escribe una respuesta oficial para el usuario..."></textarea>
        
        <div class="flex justify-end gap-3" id="modal-controles-consulta">
            <button type="button" onclick="cerrarModalConsulta()" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Cancelar</button>
            <button type="button" id="btn-enviar-respuesta-consulta" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-sm">Enviar respuesta y Cerrar caso</button>
        </div>
    </div>
</div>

<script>
    let filtroConsultaActivo = 'abierta';

    function filtrarConsultas(estado) {
        filtroConsultaActivo = estado;
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        const botonActivo = document.getElementById('btn-' + estado);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        const filas = document.querySelectorAll('.consulta-row');
        filas.forEach(fila => {
            if (estado === 'todos' || fila.getAttribute('data-estado') === estado) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }

    let filaConsultaActual = null;

    function abrirModalConsulta(btnElement, asunto, usuario, prioridad) {
        filaConsultaActual = btnElement.closest('.consulta-row');
        document.getElementById('modal-alerta-consulta-exito').classList.add('hidden');
        document.getElementById('modal-asunto-consulta').innerText = asunto;
        document.getElementById('modal-usuario-consulta').innerText = usuario;
        document.getElementById('modal-prioridad-consulta').innerText = prioridad;
        document.getElementById('modal-respuesta-consulta').value = '';
        
        const btnEnviar = document.getElementById('btn-enviar-respuesta-consulta');
        const textarea = document.getElementById('modal-respuesta-consulta');

        if (filaConsultaActual.getAttribute('data-estado') === 'cerrada') {
            btnEnviar.style.display = 'none';
            textarea.disabled = true;
            textarea.placeholder = "Este caso ya se encuentra cerrado.";
        } else {
            btnEnviar.style.display = 'block';
            textarea.disabled = false;
            textarea.placeholder = "Escribe una respuesta oficial para el usuario...";
            btnEnviar.onclick = function() {
                if(textarea.value.trim() === '') {
                    textarea.focus();
                    return;
                }
                cerrarCasoConsulta();
            };
        }

        document.getElementById('modal-atencion-consulta').style.display = 'flex';
    }

    function cerrarModalConsulta() {
        document.getElementById('modal-atencion-consulta').style.display = 'none';
        filaConsultaActual = null;
    }

    function cerrarCasoConsulta() {
        document.getElementById('modal-alerta-consulta-exito').classList.remove('hidden');
        filaConsultaActual.setAttribute('data-estado', 'cerrada');
        
        const badge = filaConsultaActual.querySelector('.badge-estado');
        if(badge) {
            badge.innerText = 'Cerrada';
            badge.className = 'badge-estado inline-block bg-gradient-to-r from-gray-200 to-transparent text-gray-800 px-4 py-1.5 rounded-full text-[11px] font-bold w-24';
        }
        
        const asunto = filaConsultaActual.querySelector('.consulta-asunto');
        if(asunto) {
            asunto.classList.remove('text-gray-900');
            asunto.classList.add('text-gray-500', 'line-through');
        }

        // Actualizar contadores
        const countAbiertas = document.getElementById('count-abiertas');
        const countCerradas = document.getElementById('count-cerradas');
        
        if (countAbiertas) {
            countAbiertas.innerText = parseInt(countAbiertas.innerText) - 1;
        }
        if (countCerradas) {
            countCerradas.innerText = parseInt(countCerradas.innerText) + 1;
        }

        setTimeout(() => {
            cerrarModalConsulta();
            filtrarConsultas(filtroConsultaActivo);
        }, 1200);
    }

    // Inicializar filtro
    filtrarConsultas('abierta');
</script>
@endsection
