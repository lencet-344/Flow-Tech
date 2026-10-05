@extends('layouts.superadmin')

@section('content')
<div class="p-8 md:p-10 bg-[#f4f7ff] min-h-screen">
    
    <!-- Encabezado -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <!-- Icono de Mensaje -->
            <svg class="w-7 h-7 text-[#040116]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight">Servicio al cliente</h1>
        </div>
        <p class="text-gray-500 text-[14px] font-light ml-10">Consultas y solicitudes de soporte de usuarios</p>
    </div>

    <!-- Filtros -->
    <div class="flex items-center gap-3 mb-8 overflow-x-auto pb-2 md:pb-0">
        <button id="btn-abierta" onclick="filtrarSoporte('abierta')" class="filter-btn bg-[#2563eb] text-white border border-transparent px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm transition whitespace-nowrap">Abiertas</button>
        <button id="btn-cerrada" onclick="filtrarSoporte('cerrada')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Cerradas</button>
        <button id="btn-todos" onclick="filtrarSoporte('todos')" class="filter-btn bg-white text-gray-700 border border-gray-200 px-6 py-2.5 rounded-xl text-[14px] font-medium shadow-sm hover:bg-gray-50 transition whitespace-nowrap">Todas</button>
    </div>

    <!-- Lista de Tickets -->
    <div class="flex flex-col gap-4">
        
        <!-- Ticket 1 (Alta) -->
        <div class="support-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="abierta" onclick="abrirModalSoporte(this, 'No puedo completar mi registro', 'Diego Torres · diego@construcciones.com', 'Alta')">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-0.5 bg-red-50 text-red-500 text-[11px] font-bold rounded-full badge-prioridad">Alta</span>
                    <span class="px-3 py-0.5 bg-blue-50 text-blue-500 text-[11px] font-bold rounded-full badge-estado">Abierta</span>
                </div>
                <h3 class="text-[17px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors titulo-ticket">No puedo completar mi registro</h3>
                <p class="text-[14px] text-gray-700 mt-1">Diego Torres · diego@construcciones.com</p>
                <p class="text-[13px] text-gray-500 mt-1 info-extra">2 mensajes · 2026-08-21</p>
            </div>
            <div class="pr-2">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <!-- Ticket 2 (Media) -->
        <div class="support-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="abierta" onclick="abrirModalSoporte(this, 'Mi negocio no aparece en los resultados de búsqueda', 'Ana Rodríguez · ana@modaexpress.com', 'Media')">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-0.5 bg-yellow-50 text-yellow-600 text-[11px] font-bold rounded-full badge-prioridad">Media</span>
                    <span class="px-3 py-0.5 bg-blue-50 text-blue-500 text-[11px] font-bold rounded-full badge-estado">Abierta</span>
                </div>
                <h3 class="text-[17px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors titulo-ticket">Mi negocio no aparece en los resultados de búsqueda</h3>
                <p class="text-[14px] text-gray-700 mt-1">Ana Rodríguez · ana@modaexpress.com</p>
                <p class="text-[13px] text-gray-500 mt-1 info-extra">1 mensaje · 2026-08-20</p>
            </div>
            <div class="pr-2">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <!-- Ticket 3 (Baja) -->
        <div class="support-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="abierta" onclick="abrirModalSoporte(this, '¿Cómo elimino una reserva de un cliente?', 'Carlos Pérez · carlos@techsolutions.com', 'Baja')">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-0.5 bg-gray-100 text-gray-600 text-[11px] font-bold rounded-full badge-prioridad">Baja</span>
                    <span class="px-3 py-0.5 bg-blue-50 text-blue-500 text-[11px] font-bold rounded-full badge-estado">Abierta</span>
                </div>
                <h3 class="text-[17px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors titulo-ticket">¿Cómo elimino una reserva de un cliente?</h3>
                <p class="text-[14px] text-gray-700 mt-1">Carlos Pérez · carlos@techsolutions.com</p>
                <p class="text-[13px] text-gray-500 mt-1 info-extra">3 mensajes · 2026-08-19</p>
            </div>
            <div class="pr-2">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <!-- Ticket 4 (Baja) -->
        <div class="support-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="abierta" onclick="abrirModalSoporte(this, '¿Puedo tener más de un negocio registrado?', 'Roberto Lima · roberto@correo.com', 'Baja')">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-0.5 bg-gray-100 text-gray-600 text-[11px] font-bold rounded-full badge-prioridad">Baja</span>
                    <span class="px-3 py-0.5 bg-blue-50 text-blue-500 text-[11px] font-bold rounded-full badge-estado">Abierta</span>
                </div>
                <h3 class="text-[17px] font-bold text-[#040116] group-hover:text-blue-600 transition-colors titulo-ticket">¿Puedo tener más de un negocio registrado?</h3>
                <p class="text-[14px] text-gray-700 mt-1">Roberto Lima · roberto@correo.com</p>
                <p class="text-[13px] text-gray-500 mt-1 info-extra">1 mensaje · 2026-08-17</p>
            </div>
            <div class="pr-2">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <!-- Ticket Oculto de Prueba (Cerrada) -->
        <div class="support-card flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow cursor-pointer group" data-estado="cerrada" style="display: none;" onclick="abrirModalSoporte(this, 'Duda sobre la facturación del mes', 'María González · maria@correo.com', 'Baja')">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-0.5 bg-gray-100 text-gray-600 text-[11px] font-bold rounded-full badge-prioridad">Baja</span>
                    <span class="px-3 py-0.5 bg-green-50 text-green-600 text-[11px] font-bold rounded-full badge-estado">Cerrada</span>
                </div>
                <h3 class="text-[17px] font-bold text-gray-500 line-through group-hover:text-blue-600 transition-colors titulo-ticket">Duda sobre la facturación del mes</h3>
                <p class="text-[14px] text-gray-400 mt-1">María González · maria@correo.com</p>
                <p class="text-[13px] text-gray-400 mt-1 info-extra">5 mensajes · Resuelto: 2026-08-10</p>
            </div>
            <div class="pr-2">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#040116] group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

    </div>
</div>

<!-- Modal Soporte SINGKI -->
<div id="modal-atencion-cliente" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-xl border border-gray-100 p-8 text-left">
        <div id="modal-alerta-exito" class="hidden bg-green-50 text-green-700 p-3 rounded-lg text-sm mb-4 font-bold">Respuesta enviada y caso cerrado con éxito.</div>
        <h3 class="text-xl font-bold text-gray-900 mb-2" id="modal-asunto-soporte">Asunto</h3>
        <p class="text-sm text-gray-500 mb-6">Usuario: <strong id="modal-usuario-soporte">...</strong> | Prioridad: <strong id="modal-prioridad-soporte">...</strong></p>
        
        <textarea id="modal-respuesta-soporte" class="w-full h-32 p-4 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6 resize-none" placeholder="Escribe una respuesta oficial para el usuario..."></textarea>
        
        <div class="flex justify-end gap-3" id="modal-controles-soporte">
            <button type="button" onclick="cerrarModalSoporte()" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Cancelar</button>
            <button type="button" id="btn-enviar-respuesta" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-sm">Enviar respuesta y Cerrar caso</button>
        </div>
    </div>
</div>

<!-- Lógica de Filtrado y Modal -->
<script>
    let filtroSoporteActivo = 'abierta';

    function filtrarSoporte(estado) {
        filtroSoporteActivo = estado;
        const botones = document.querySelectorAll('.filter-btn');
        botones.forEach(btn => {
            btn.classList.remove('bg-[#2563eb]', 'text-white', 'border-transparent');
            btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200');
        });

        const botonActivo = document.getElementById('btn-' + estado);
        botonActivo.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');
        botonActivo.classList.add('bg-[#2563eb]', 'text-white', 'border-transparent');

        const cartas = document.querySelectorAll('.support-card');
        cartas.forEach(carta => {
            if (estado === 'todos' || carta.getAttribute('data-estado') === estado) {
                carta.style.display = ''; // Mostrar
            } else {
                carta.style.display = 'none'; // Ocultar
            }
        });
    }

    let tarjetaSoporteActual = null;

    function abrirModalSoporte(elemento, asunto, usuario, prioridad) {
        tarjetaSoporteActual = elemento;
        document.getElementById('modal-alerta-exito').classList.add('hidden');
        document.getElementById('modal-asunto-soporte').innerText = asunto;
        document.getElementById('modal-usuario-soporte').innerText = usuario;
        document.getElementById('modal-prioridad-soporte').innerText = prioridad;
        document.getElementById('modal-respuesta-soporte').value = '';
        
        const btnEnviar = document.getElementById('btn-enviar-respuesta');
        const controles = document.getElementById('modal-controles-soporte');
        const textarea = document.getElementById('modal-respuesta-soporte');

        if (elemento.getAttribute('data-estado') === 'cerrada') {
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
                cerrarCasoSoporte();
            };
        }

        document.getElementById('modal-atencion-cliente').style.display = 'flex';
    }

    function cerrarModalSoporte() {
        document.getElementById('modal-atencion-cliente').style.display = 'none';
        tarjetaSoporteActual = null;
    }

    function cerrarCasoSoporte() {
        document.getElementById('modal-alerta-exito').classList.remove('hidden');
        tarjetaSoporteActual.setAttribute('data-estado', 'cerrada');
        
        const badge = tarjetaSoporteActual.querySelector('.badge-estado');
        if(badge) {
            badge.innerText = 'Cerrada';
            badge.className = 'px-3 py-0.5 bg-green-50 text-green-600 text-[11px] font-bold rounded-full badge-estado';
        }
        const title = tarjetaSoporteActual.querySelector('.titulo-ticket');
        if(title) {
            title.classList.remove('text-[#040116]');
            title.classList.add('text-gray-500', 'line-through');
        }

        setTimeout(() => {
            cerrarModalSoporte();
            filtrarSoporte(filtroSoporteActivo);
        }, 1200);
    }
</script>
@endsection
