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

    <!-- 3 Tarjetas de Métricas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div class="text-[36px] font-bold text-[#040116] leading-none mb-2">5</div>
            <div class="text-[13px] text-gray-500 font-medium">Total consultas</div>
        </div>
        <!-- Abiertas -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div class="text-[36px] font-bold text-[#040116] leading-none mb-2">4</div>
            <div class="text-[13px] text-gray-500 font-medium">Abiertas</div>
        </div>
        <!-- Cerradas -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.02)] text-center">
            <div class="text-[36px] font-bold text-[#040116] leading-none mb-2">1</div>
            <div class="text-[13px] text-gray-500 font-medium">Cerradas</div>
        </div>
    </div>

    <!-- Tabla de Consultas -->
    <div class="bg-white rounded-[1.2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
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
                <tbody class="text-[13.5px] text-gray-800 divide-y divide-gray-50">
                    
                    <!-- Fila 1 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">No puedo completar mi registro</td>
                        <td class="px-6 py-4 text-gray-600">Diego Torres</td>
                        <td class="px-6 py-4">
                            <!-- Degradado Rojo -->
                            <span class="inline-block bg-gradient-to-r from-red-100 to-transparent text-red-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Alta</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-21</td>
                        <td class="px-6 py-4">
                            <!-- Degradado Azul -->
                            <span class="inline-block bg-gradient-to-r from-blue-100 to-transparent text-blue-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Abierta</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div x-data="{ openConsulta: false }">
                                <button @click="openConsulta = true" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>

                                <!-- Modal de Consulta -->
                                <div x-show="openConsulta" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50" x-transition>
                                    <div @click.away="openConsulta = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 text-left relative mx-4 whitespace-normal">
                                        
                                        <!-- Cabecera -->
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item?->subject ?? 'Detalle de la consulta' }}</h3>
                                        
                                        <!-- Metadatos -->
                                        <p class="text-sm text-gray-500 mb-6">
                                            Enviado por: <strong>{{ $item?->user?->name ?? 'Usuario' }}</strong> el {{ isset($item) && $item->created_at ? $item->created_at->format('Y-m-d') : 'fecha' }}
                                        </p>

                                        <!-- Cuerpo del mensaje -->
                                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 mb-6 border border-gray-100 text-sm leading-relaxed">
                                            {{ $item?->message ?? 'El usuario no proporcionó más detalles en su consulta inicial.' }}
                                        </div>

                                        <!-- Controles -->
                                        <div class="flex justify-end gap-3 mt-4">
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Volver</button>
                                            
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Marcar como Resuelta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 2 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">Mi negocio no aparece en los resultados de búsqueda</td>
                        <td class="px-6 py-4 text-gray-600">Ana Rodríguez</td>
                        <td class="px-6 py-4">
                            <!-- Degradado Amarillo -->
                            <span class="inline-block bg-gradient-to-r from-yellow-100 to-transparent text-yellow-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Media</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-20</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-blue-100 to-transparent text-blue-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Abierta</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div x-data="{ openConsulta: false }">
                                <button @click="openConsulta = true" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>

                                <!-- Modal de Consulta -->
                                <div x-show="openConsulta" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50" x-transition>
                                    <div @click.away="openConsulta = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 text-left relative mx-4 whitespace-normal">
                                        
                                        <!-- Cabecera -->
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item?->subject ?? 'Detalle de la consulta' }}</h3>
                                        
                                        <!-- Metadatos -->
                                        <p class="text-sm text-gray-500 mb-6">
                                            Enviado por: <strong>{{ $item?->user?->name ?? 'Usuario' }}</strong> el {{ isset($item) && $item->created_at ? $item->created_at->format('Y-m-d') : 'fecha' }}
                                        </p>

                                        <!-- Cuerpo del mensaje -->
                                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 mb-6 border border-gray-100 text-sm leading-relaxed">
                                            {{ $item?->message ?? 'El usuario no proporcionó más detalles en su consulta inicial.' }}
                                        </div>

                                        <!-- Controles -->
                                        <div class="flex justify-end gap-3 mt-4">
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Volver</button>
                                            
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Marcar como Resuelta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 3 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">¿Cómo elimino una reserva de un cliente?</td>
                        <td class="px-6 py-4 text-gray-600">Carlos Pérez</td>
                        <td class="px-6 py-4">
                            <!-- Degradado Azul grisáceo -->
                            <span class="inline-block bg-gradient-to-r from-slate-200 to-transparent text-slate-700 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Baja</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-19</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-blue-100 to-transparent text-blue-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Abierta</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div x-data="{ openConsulta: false }">
                                <button @click="openConsulta = true" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>

                                <!-- Modal de Consulta -->
                                <div x-show="openConsulta" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50" x-transition>
                                    <div @click.away="openConsulta = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 text-left relative mx-4 whitespace-normal">
                                        
                                        <!-- Cabecera -->
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item?->subject ?? 'Detalle de la consulta' }}</h3>
                                        
                                        <!-- Metadatos -->
                                        <p class="text-sm text-gray-500 mb-6">
                                            Enviado por: <strong>{{ $item?->user?->name ?? 'Usuario' }}</strong> el {{ isset($item) && $item->created_at ? $item->created_at->format('Y-m-d') : 'fecha' }}
                                        </p>

                                        <!-- Cuerpo del mensaje -->
                                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 mb-6 border border-gray-100 text-sm leading-relaxed">
                                            {{ $item?->message ?? 'El usuario no proporcionó más detalles en su consulta inicial.' }}
                                        </div>

                                        <!-- Controles -->
                                        <div class="flex justify-end gap-3 mt-4">
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Volver</button>
                                            
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Marcar como Resuelta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 4 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">Error al subir foto del negocio</td>
                        <td class="px-6 py-4 text-gray-600">Sofía Mejía</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-yellow-100 to-transparent text-yellow-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Media</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-18</td>
                        <td class="px-6 py-4">
                            <!-- Degradado Gris -->
                            <span class="inline-block bg-gradient-to-r from-gray-200 to-transparent text-gray-800 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Cerrada</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div x-data="{ openConsulta: false }">
                                <button @click="openConsulta = true" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>

                                <!-- Modal de Consulta -->
                                <div x-show="openConsulta" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50" x-transition>
                                    <div @click.away="openConsulta = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 text-left relative mx-4 whitespace-normal">
                                        
                                        <!-- Cabecera -->
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item?->subject ?? 'Detalle de la consulta' }}</h3>
                                        
                                        <!-- Metadatos -->
                                        <p class="text-sm text-gray-500 mb-6">
                                            Enviado por: <strong>{{ $item?->user?->name ?? 'Usuario' }}</strong> el {{ isset($item) && $item->created_at ? $item->created_at->format('Y-m-d') : 'fecha' }}
                                        </p>

                                        <!-- Cuerpo del mensaje -->
                                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 mb-6 border border-gray-100 text-sm leading-relaxed">
                                            {{ $item?->message ?? 'El usuario no proporcionó más detalles en su consulta inicial.' }}
                                        </div>

                                        <!-- Controles -->
                                        <div class="flex justify-end gap-3 mt-4">
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Volver</button>
                                            
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Marcar como Resuelta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Fila 5 -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">¿Puedo tener más de un negocio registrado?</td>
                        <td class="px-6 py-4 text-gray-600">Roberto Lima</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-slate-200 to-transparent text-slate-700 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Baja</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">2026-08-17</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gradient-to-r from-blue-100 to-transparent text-blue-600 px-4 py-1.5 rounded-full text-[11px] font-bold w-24">Abierta</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div x-data="{ openConsulta: false }">
                                <button @click="openConsulta = true" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer">Abrir</button>

                                <!-- Modal de Consulta -->
                                <div x-show="openConsulta" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50" x-transition>
                                    <div @click.away="openConsulta = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 text-left relative mx-4 whitespace-normal">
                                        
                                        <!-- Cabecera -->
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item?->subject ?? 'Detalle de la consulta' }}</h3>
                                        
                                        <!-- Metadatos -->
                                        <p class="text-sm text-gray-500 mb-6">
                                            Enviado por: <strong>{{ $item?->user?->name ?? 'Usuario' }}</strong> el {{ isset($item) && $item->created_at ? $item->created_at->format('Y-m-d') : 'fecha' }}
                                        </p>

                                        <!-- Cuerpo del mensaje -->
                                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 mb-6 border border-gray-100 text-sm leading-relaxed">
                                            {{ $item?->message ?? 'El usuario no proporcionó más detalles en su consulta inicial.' }}
                                        </div>

                                        <!-- Controles -->
                                        <div class="flex justify-end gap-3 mt-4">
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Volver</button>
                                            
                                            <button @click="openConsulta = false" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Marcar como Resuelta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
