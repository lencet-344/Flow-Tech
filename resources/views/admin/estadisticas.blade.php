@extends('layouts.admin')

@section('content')

@if(auth()->check() && (optional(auth()->user())->is_premium || request()->has('premium')))
<!-- VISTA: ESTADÍSTICAS (MODO PREMIUM DESBLOQUEADO) -->
<div class="max-w-6xl mx-auto p-6 bg-[#f8fafc] min-h-screen">
    
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-[#0f172a] flex items-center gap-3 tracking-tight">
                <svg class="w-8 h-8 text-[#0f172a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Estadísticas 
                <span class="bg-[#8b5cf6] text-white text-[10px] px-2.5 py-1 rounded-md font-bold uppercase tracking-wider flex items-center gap-1 shadow-sm"><span class="text-yellow-300 text-xs">★</span> Premium</span>
            </h2>
            <p class="text-gray-500 text-sm mt-1">Rendimiento de tu negocio en los últimos 7 días</p>
        </div>
        <button class="bg-white border border-gray-200 text-gray-700 font-medium px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition shadow-sm">
            Últ. 7 días
        </button>
    </div>

    <!-- 4 Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
        <!-- Tarjeta 1 -->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
            <p class="text-sm text-gray-500 font-medium mb-1">Visitas al perfil</p>
            <h3 class="text-3xl font-extrabold text-[#0f172a] mb-2">382</h3>
            <p class="text-green-500 text-xs font-bold flex items-center gap-1">↑ +14% <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-5 right-5 w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        </div>
        <!-- Tarjeta 2 -->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
            <p class="text-sm text-gray-500 font-medium mb-1">Guardados</p>
            <h3 class="text-3xl font-extrabold text-[#0f172a] mb-2">60</h3>
            <p class="text-green-500 text-xs font-bold flex items-center gap-1">↑ +8% <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-5 right-5 w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
        </div>
        <!-- Tarjeta 3 -->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
            <p class="text-sm text-gray-500 font-medium mb-1">Contactos / Chat</p>
            <h3 class="text-3xl font-extrabold text-[#0f172a] mb-2">47</h3>
            <p class="text-green-500 text-xs font-bold flex items-center gap-1">↑ +22% <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-5 right-5 w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
        </div>
        <!-- Tarjeta 4 -->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
            <p class="text-sm text-gray-500 font-medium mb-1">Reservas generadas</p>
            <h3 class="text-3xl font-extrabold text-[#0f172a] mb-2">3</h3>
            <p class="text-green-500 text-xs font-bold flex items-center gap-1">↑ +1 <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-5 right-5 w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
    </div>

    <!-- Gráfico de Barras (Diseño CSS Puro calcado del Figma) -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-8">
        <h3 class="font-bold text-[#0f172a] text-lg mb-1">Visitas diarias al perfil</h3>
        <p class="text-sm text-gray-500 mb-10">Cantidad de veces que clientes vieron tu negocio</p>
        
        <div class="flex items-end justify-between gap-4 h-48 mt-8">
            <!-- Lun -->
            <div class="w-full flex flex-col items-center group">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">28</span>
                <div class="w-full bg-[#a78bfa] rounded-t-lg h-[28%] hover:bg-[#8b5cf6] transition-colors cursor-pointer"></div>
                <span class="text-gray-400 text-xs mt-3 font-medium">Lun</span>
            </div>
            <!-- Mar -->
            <div class="w-full flex flex-col items-center group">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">42</span>
                <div class="w-full bg-[#a78bfa] rounded-t-lg h-[42%] hover:bg-[#8b5cf6] transition-colors cursor-pointer"></div>
                <span class="text-gray-400 text-xs mt-3 font-medium">Mar</span>
            </div>
            <!-- Mié -->
            <div class="w-full flex flex-col items-center group">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">35</span>
                <div class="w-full bg-[#a78bfa] rounded-t-lg h-[35%] hover:bg-[#8b5cf6] transition-colors cursor-pointer"></div>
                <span class="text-gray-400 text-xs mt-3 font-medium">Mié</span>
            </div>
            <!-- Jue -->
            <div class="w-full flex flex-col items-center group">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">61</span>
                <div class="w-full bg-[#a78bfa] rounded-t-lg h-[61%] hover:bg-[#8b5cf6] transition-colors cursor-pointer"></div>
                <span class="text-gray-400 text-xs mt-3 font-medium">Jue</span>
            </div>
            <!-- Vie -->
            <div class="w-full flex flex-col items-center group">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">74</span>
                <div class="w-full bg-[#a78bfa] rounded-t-lg h-[74%] hover:bg-[#8b5cf6] transition-colors cursor-pointer"></div>
                <span class="text-gray-400 text-xs mt-3 font-medium">Vie</span>
            </div>
            <!-- Sáb -->
            <div class="w-full flex flex-col items-center group">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">89</span>
                <div class="w-full bg-[#a78bfa] rounded-t-lg h-[89%] hover:bg-[#8b5cf6] transition-colors cursor-pointer"></div>
                <span class="text-gray-400 text-xs mt-3 font-medium">Sáb</span>
            </div>
            <!-- Dom -->
            <div class="w-full flex flex-col items-center group">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">53</span>
                <div class="w-full bg-[#a78bfa] rounded-t-lg h-[53%] hover:bg-[#8b5cf6] transition-colors cursor-pointer"></div>
                <span class="text-gray-400 text-xs mt-3 font-medium">Dom</span>
            </div>
        </div>
    </div>

    <!-- Tabla Detalle por Día -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <h3 class="font-bold text-[#0f172a] text-lg mb-6">Detalle por día</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                        <th class="pb-4 w-1/4">Día</th>
                        <th class="pb-4 w-1/4">Visitas</th>
                        <th class="pb-4 w-1/4">Guardados</th>
                        <th class="pb-4 w-1/4">Contactos</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    <!-- Fila -->
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Lun</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-8 bg-gray-100 rounded-full h-2"><div class="bg-[#a78bfa] h-2 rounded-full" style="width: 28%"></div></div> 28</td>
                        <td class="py-4">4</td>
                        <td class="py-4">2</td>
                    </tr>
                    <!-- Fila -->
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Mar</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-8 bg-gray-100 rounded-full h-2"><div class="bg-[#a78bfa] h-2 rounded-full" style="width: 42%"></div></div> 42</td>
                        <td class="py-4">7</td>
                        <td class="py-4">5</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="font-bold text-[#0f172a]">
                        <td class="py-4">Total</td>
                        <td class="py-4 text-[#8b5cf6]">382</td>
                        <td class="py-4">60</td>
                        <td class="py-4">47</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@else
<div class="p-8 md:p-10 flex items-center justify-center min-h-[calc(100vh-80px)]">
    
    <!-- Paywall Card -->
    <div class="bg-white rounded-[24px] shadow-sm max-w-lg w-full p-10 md:p-12 text-center border border-gray-100">
        
        <!-- Ícono Morado -->
        <div class="w-20 h-20 bg-[#f5f3ff] rounded-[20px] flex items-center justify-center mx-auto mb-8">
            <svg class="w-10 h-10 text-[#7c3aed]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"></path>
            </svg>
        </div>

        <!-- Textos -->
        <h2 class="text-2xl font-bold text-[#0f172a] mb-4 tracking-tight">Estadísticas Premium</h2>
        <p class="text-[#475569] text-[15px] mb-8 font-light leading-relaxed px-2">
            Accede a visitas, guardados, conexiones y tu curva de crecimiento con <span class="text-[#7c3aed] font-medium">SINGKI Premium</span>.
        </p>

        <!-- Botón CTA -->
        <a href="{{ url('/admin/premium/planes') }}" class="w-full bg-[#7c3aed] hover:bg-[#6d28d9] text-white font-medium py-3.5 rounded-2xl transition-colors shadow-sm text-[15px] flex items-center justify-center gap-2">
            <span class="text-yellow-400 text-lg">⭐</span> Obtener Premium
        </a>
        
    </div>

</div>
@endif

@endsection
