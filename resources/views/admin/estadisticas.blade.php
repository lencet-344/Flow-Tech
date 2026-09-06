@extends('layouts.admin') {{-- Ajusta si tu layout se llama diferente --}}

@section('content')

@if(request()->has('premium'))
    @php 
        session(['is_premium' => true]);
        session()->save(); 
    @endphp
@endif

@if(session('is_premium') || request()->has('premium'))
<!-- VISTA: ESTADÍSTICAS (MODO PREMIUM DESBLOQUEADO) -->
<div class="max-w-6xl mx-auto p-6 bg-[#f8fafc] min-h-screen">
    
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-[#0f172a] flex items-center gap-3 tracking-tight">
                <!-- Ícono de Edificios (Figma) -->
                <svg class="w-8 h-8 text-[#0f172a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Estadísticas 
                <span class="bg-[#8b5cf6] text-white text-[11px] px-3 py-1 rounded-md font-bold uppercase tracking-wider flex items-center gap-1 shadow-sm">
                    <svg class="w-3 h-3 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    PREMIUM
                </span>
            </h2>
            <p class="text-gray-500 text-sm mt-1">Rendimiento de tu negocio en los últimos 7 días</p>
        </div>
        <button class="bg-white border border-gray-200 text-gray-700 font-medium px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition shadow-sm">
            Últ. 7 días
        </button>
    </div>

    <!-- 4 Tarjetas de Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative">
            <p class="text-sm text-gray-500 font-medium mb-1">Visitas al perfil</p>
            <h3 class="text-4xl font-extrabold text-[#0f172a] mb-2">382</h3>
            <p class="text-green-500 text-xs font-bold">↑ +14% <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-6 right-6 w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative">
            <p class="text-sm text-gray-500 font-medium mb-1">Guardados</p>
            <h3 class="text-4xl font-extrabold text-[#0f172a] mb-2">60</h3>
            <p class="text-green-500 text-xs font-bold">↑ +8% <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-6 right-6 w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative">
            <p class="text-sm text-gray-500 font-medium mb-1">Contactos / Chat</p>
            <h3 class="text-4xl font-extrabold text-[#0f172a] mb-2">47</h3>
            <p class="text-green-500 text-xs font-bold">↑ +22% <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-6 right-6 w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative">
            <p class="text-sm text-gray-500 font-medium mb-1">Reservas generadas</p>
            <h3 class="text-4xl font-extrabold text-[#0f172a] mb-2">3</h3>
            <p class="text-green-500 text-xs font-bold">↑ +1 <span class="text-gray-400 font-normal">vs semana anterior</span></p>
            <svg class="absolute top-6 right-6 w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
    </div>

    <!-- Gráfico de Barras (Reparado con style puro) -->
    <div class="bg-white p-8 rounded-[24px] border border-gray-100 shadow-sm mb-8">
        <h3 class="font-bold text-[#0f172a] text-lg mb-1">Visitas diarias al perfil</h3>
        <p class="text-sm text-gray-500 mb-10">Cantidad de veces que clientes vieron tu negocio</p>
        
        <div class="flex items-end justify-between gap-4 h-56 mt-8">
            <div class="w-full flex flex-col items-center group h-full justify-end">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">28</span>
                <div class="w-full bg-[#b498fc] rounded-t-[8px] hover:bg-[#8b5cf6] transition-colors cursor-pointer" style="height: 28%;"></div>
                <span class="text-gray-500 text-xs mt-3 font-medium">Lun</span>
            </div>
            <div class="w-full flex flex-col items-center group h-full justify-end">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">42</span>
                <div class="w-full bg-[#b498fc] rounded-t-[8px] hover:bg-[#8b5cf6] transition-colors cursor-pointer" style="height: 42%;"></div>
                <span class="text-gray-500 text-xs mt-3 font-medium">Mar</span>
            </div>
            <div class="w-full flex flex-col items-center group h-full justify-end">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">35</span>
                <div class="w-full bg-[#b498fc] rounded-t-[8px] hover:bg-[#8b5cf6] transition-colors cursor-pointer" style="height: 35%;"></div>
                <span class="text-gray-500 text-xs mt-3 font-medium">Mié</span>
            </div>
            <div class="w-full flex flex-col items-center group h-full justify-end">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">61</span>
                <div class="w-full bg-[#b498fc] rounded-t-[8px] hover:bg-[#8b5cf6] transition-colors cursor-pointer" style="height: 61%;"></div>
                <span class="text-gray-500 text-xs mt-3 font-medium">Jue</span>
            </div>
            <div class="w-full flex flex-col items-center group h-full justify-end">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">74</span>
                <div class="w-full bg-[#b498fc] rounded-t-[8px] hover:bg-[#8b5cf6] transition-colors cursor-pointer" style="height: 74%;"></div>
                <span class="text-gray-500 text-xs mt-3 font-medium">Vie</span>
            </div>
            <div class="w-full flex flex-col items-center group h-full justify-end">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">89</span>
                <div class="w-full bg-[#b498fc] rounded-t-[8px] hover:bg-[#8b5cf6] transition-colors cursor-pointer" style="height: 89%;"></div>
                <span class="text-gray-500 text-xs mt-3 font-medium">Sáb</span>
            </div>
            <div class="w-full flex flex-col items-center group h-full justify-end">
                <span class="text-[#8b5cf6] font-bold text-sm mb-2 opacity-0 group-hover:opacity-100 transition-opacity">53</span>
                <div class="w-full bg-[#b498fc] rounded-t-[8px] hover:bg-[#8b5cf6] transition-colors cursor-pointer" style="height: 53%;"></div>
                <span class="text-gray-500 text-xs mt-3 font-medium">Dom</span>
            </div>
        </div>
    </div>

    <!-- Tabla Detalle por Día -->
    <div class="bg-white p-8 rounded-[24px] border border-gray-100 shadow-sm">
        <h3 class="font-bold text-[#0f172a] text-lg mb-6">Detalle por día</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[11px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                        <th class="pb-4 w-1/4">Día</th>
                        <th class="pb-4 w-1/4">Visitas</th>
                        <th class="pb-4 w-1/4">Guardados</th>
                        <th class="pb-4 w-1/4">Contactos</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-gray-700">
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Lun</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-12 bg-indigo-50 rounded-full h-1.5"><div class="bg-[#8b5cf6] h-1.5 rounded-full" style="width: 28%"></div></div> 28</td>
                        <td class="py-4">4</td>
                        <td class="py-4">2</td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Mar</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-12 bg-indigo-50 rounded-full h-1.5"><div class="bg-[#8b5cf6] h-1.5 rounded-full" style="width: 42%"></div></div> 42</td>
                        <td class="py-4">7</td>
                        <td class="py-4">5</td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Mié</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-12 bg-indigo-50 rounded-full h-1.5"><div class="bg-[#8b5cf6] h-1.5 rounded-full" style="width: 35%"></div></div> 35</td>
                        <td class="py-4">5</td>
                        <td class="py-4">3</td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Jue</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-12 bg-indigo-50 rounded-full h-1.5"><div class="bg-[#8b5cf6] h-1.5 rounded-full" style="width: 61%"></div></div> 61</td>
                        <td class="py-4">9</td>
                        <td class="py-4">8</td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Vie</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-12 bg-indigo-50 rounded-full h-1.5"><div class="bg-[#8b5cf6] h-1.5 rounded-full" style="width: 74%"></div></div> 74</td>
                        <td class="py-4">12</td>
                        <td class="py-4">10</td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Sáb</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-12 bg-indigo-50 rounded-full h-1.5"><div class="bg-[#8b5cf6] h-1.5 rounded-full" style="width: 89%"></div></div> 89</td>
                        <td class="py-4">15</td>
                        <td class="py-4">13</td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-medium">Dom</td>
                        <td class="py-4 flex items-center gap-3"><div class="w-12 bg-indigo-50 rounded-full h-1.5"><div class="bg-[#8b5cf6] h-1.5 rounded-full" style="width: 53%"></div></div> 53</td>
                        <td class="py-4">8</td>
                        <td class="py-4">6</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="font-bold text-[#0f172a] text-[15px]">
                        <td class="pt-6">Total</td>
                        <td class="pt-6 text-[#8b5cf6]">382</td>
                        <td class="pt-6">60</td>
                        <td class="pt-6">47</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@else
<!-- PAYWALL: OBTENER PREMIUM -->
<div class="p-8 md:p-10 flex items-center justify-center min-h-[calc(100vh-80px)] bg-[#f8fafc]">
    <div class="bg-white rounded-[24px] shadow-sm max-w-lg w-full p-10 md:p-12 text-center border border-gray-100">
        <div class="w-20 h-20 bg-[#f5f3ff] rounded-[20px] flex items-center justify-center mx-auto mb-8">
            <svg class="w-10 h-10 text-[#7c3aed]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-[#0f172a] mb-4 tracking-tight">Estadísticas Premium</h2>
        <p class="text-[#475569] text-[15px] mb-8 font-light leading-relaxed px-2">
            Accede a visitas, guardados, conexiones y tu curva de crecimiento con <span class="text-[#7c3aed] font-medium">SINGKI Premium</span>.
        </p>
        <a href="{{ url('/admin/premium/planes') }}" class="w-full bg-[#7c3aed] hover:bg-[#6d28d9] text-white font-medium py-3.5 rounded-2xl transition-colors shadow-sm text-[15px] flex items-center justify-center gap-2">
            <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.006z" clip-rule="evenodd" /></svg> Obtener Premium
        </a>
    </div>
</div>
@endif

@endsection