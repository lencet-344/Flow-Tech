@extends('layouts.admin')

@section('content')

@if(auth()->check() && (optional(auth()->user())->is_premium || request()->has('premium')))
<!-- VISTA: COMUNIDAD (MODO PREMIUM DESBLOQUEADO) -->
<div class="max-w-5xl mx-auto p-6 bg-[#f8fafc] min-h-screen">
    
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-[#0f172a] flex items-center gap-3 tracking-tight">
                Comunidad de Crecimiento 
                <span class="bg-[#8b5cf6] text-white text-[10px] px-2.5 py-1 rounded-md font-bold uppercase tracking-wider flex items-center gap-1 shadow-sm"><svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.006z" clip-rule="evenodd" /></svg> Premium</span>
            </h2>
            <p class="text-gray-500 text-sm mt-1">Resuelve dudas de tu negocio con apoyo oficial de SINGKI</p>
        </div>
        <button class="bg-[#8b5cf6] hover:bg-purple-600 text-white font-bold px-6 py-2.5 rounded-lg text-sm transition shadow-md flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Publicar pregunta
        </button>
    </div>

    <!-- Cuadrícula de Categorías Premium -->
    <div class="bg-white border-2 border-[#e9d5ff] rounded-2xl p-6 shadow-sm mb-6">
        <h3 class="font-bold text-[#0f172a] text-lg mb-4">¿Qué necesitas resolver hoy?</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button class="border border-[#e9d5ff] bg-[#faf5ff] rounded-xl p-5 flex flex-col items-center text-center hover:bg-[#f3e8ff] transition-colors group">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                <span class="text-xs font-semibold text-[#6b21a8]">Diseño e identidad visual</span>
            </button>
            <button class="border border-[#e9d5ff] bg-[#faf5ff] rounded-xl p-5 flex flex-col items-center text-center hover:bg-[#f3e8ff] transition-colors group">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                <span class="text-xs font-semibold text-[#6b21a8]">Marketing y redes sociales</span>
            </button>
            <button class="border border-[#e9d5ff] bg-[#faf5ff] rounded-xl p-5 flex flex-col items-center text-center hover:bg-[#f3e8ff] transition-colors group">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-xs font-semibold text-[#6b21a8]">Precios y finanzas</span>
            </button>
            <button class="border border-[#e9d5ff] bg-[#faf5ff] rounded-xl p-5 flex flex-col items-center text-center hover:bg-[#f3e8ff] transition-colors group">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="text-xs font-semibold text-[#6b21a8]">Ventas y clientes</span>
            </button>
            <!-- Añade el resto de botones de tu grid de la misma manera -->
        </div>
    </div>

    <!-- Alerta Informativa -->
    <div class="bg-white border border-[#e9d5ff] rounded-xl p-4 flex gap-4 items-start shadow-sm mb-6">
        <div class="w-8 h-8 bg-[#e9d5ff] rounded-lg flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-[#6b21a8]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        </div>
        <p class="text-sm text-gray-700 leading-relaxed font-medium mt-1">
            Las preguntas son revisadas y respondidas únicamente por el equipo de SINGKI. Las respuestas aparecen como <strong>"Respuesta oficial de SINGKI"</strong> y forman una biblioteca de conocimiento para emprendedores Premium.
        </p>
    </div>

    <!-- Pestañas (Tabs) -->
    <div class="flex gap-2 mb-6">
        <button class="bg-[#8b5cf6] text-white px-5 py-2 rounded-full text-sm font-bold shadow-sm">Todas</button>
        <button class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-bold shadow-sm">En revisión</button>
        <button class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-bold shadow-sm">Respondidas</button>
    </div>

    <!-- Feed de Preguntas y Respuestas -->
    <div class="space-y-6">
        
        <!-- Tarjeta de Pregunta 1 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-3">
                <div class="flex gap-2">
                    <span class="bg-[#a855f7] text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">Marketing</span> 
                    <span class="border border-green-200 bg-green-50 text-green-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">Respondida</span>
                </div>
                <span class="text-xs text-gray-400 font-medium">2026-08-20</span>
            </div>
            <h4 class="font-bold text-[#0f172a] text-[15px] mb-1">¿Cuál es la mejor estrategia para dar a conocer mi negocio en SINGKI y atraer más clientes?</h4>
            <p class="text-[11px] text-gray-500 mb-5 font-medium">TechSolutions GT</p>
            
            <!-- Caja de Respuesta Oficial -->
            <div class="border border-[#e9d5ff] rounded-xl p-5 bg-[#faf5ff]">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-[#8b5cf6] text-white rounded-full flex items-center justify-center text-xs font-bold shadow-sm">S</div>
                        <span class="font-bold text-sm text-[#0f172a]">Respuesta oficial de SINGKI</span>
                    </div>
                    <span class="text-[11px] text-gray-400 font-medium">2026-08-21</span>
                </div>
                <p class="text-[13px] text-gray-700 leading-relaxed font-medium">
                    Te recomendamos mantener tu perfil completo y actualizado, subir fotos de calidad de tus productos y responder rápidamente los chats. Publicar ofertas periódicas también aumenta tu visibilidad en los resultados de búsqueda.
                </p>
            </div>
        </div>

        <!-- Tarjeta de Pregunta 2 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-3">
                <div class="flex gap-2">
                    <span class="bg-[#a855f7] text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">Precios</span> 
                    <span class="border border-green-200 bg-green-50 text-green-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">Respondida</span>
                </div>
                <span class="text-xs text-gray-400 font-medium">2026-08-21</span>
            </div>
            <h4 class="font-bold text-[#0f172a] text-[15px] mb-1">¿Cómo establezco precios competitivos cuando hay otros negocios del mismo rubro con precios muy bajos?</h4>
            <p class="text-[11px] text-gray-500 mb-5 font-medium">Moda Express</p>
            
            <div class="border border-[#e9d5ff] rounded-xl p-5 bg-[#faf5ff]">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-[#8b5cf6] text-white rounded-full flex items-center justify-center text-xs font-bold shadow-sm">S</div>
                        <span class="font-bold text-sm text-[#0f172a]">Respuesta oficial de SINGKI</span>
                    </div>
                    <span class="text-[11px] text-gray-400 font-medium">2026-08-22</span>
                </div>
                <p class="text-[13px] text-gray-700 leading-relaxed font-medium">
                    Diferenciarte por valor es clave. Destaca la calidad, el servicio al cliente y la confiabilidad. Evita competir solo por precio; en cambio, asegúrate de que tu propuesta de valor sea clara en tu perfil y descripción de productos.
                </p>
            </div>
        </div>
        
    </div>
</div>
@else
<div class="p-8 md:p-10 max-w-5xl mx-auto">
    
    <!-- 1. BANNER HEADER -->
    <div class="bg-gradient-to-br from-[#6d28d9] to-[#312e81] rounded-3xl p-10 mb-8 shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full border border-white/30 bg-white/10 text-white text-xs font-bold uppercase tracking-wider mb-6 backdrop-blur-sm">
                <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.006z" clip-rule="evenodd" /></svg> Premium exclusivo
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-4 tracking-tight">Comunidad de Crecimiento</h1>
            <p class="text-indigo-100 text-[15px] max-w-2xl font-light leading-relaxed">
                Publica preguntas sobre tu negocio y recibe respuestas oficiales del equipo de SINGKI. Accede a la biblioteca de conocimiento de emprendedores.
            </p>
        </div>
    </div>

    <!-- 2. SECCIÓN: CATEGORÍAS -->
    <div class="bg-white rounded-3xl p-8 mb-8 shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-[#0f172a] mb-6">¿Qué necesitas resolver hoy?</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Item 1 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Diseño e identidad<br>visual</span>
            </button>
            
            <!-- Item 2 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Marketing y redes<br>sociales</span>
            </button>
            
            <!-- Item 3 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Precios y finanzas</span>
            </button>
            
            <!-- Item 4 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Ventas y clientes</span>
            </button>
            
            <!-- Item 5 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Organización</span>
            </button>
            
            <!-- Item 6 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Publicidad y<br>promociones</span>
            </button>
            
            <!-- Item 7 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Presentación de<br>productos</span>
            </button>
            
            <!-- Item 8 -->
            <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-32">
                <svg class="w-8 h-8 text-[#8b5cf6] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"></path></svg>
                <span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Crecimiento</span>
            </button>
        </div>
    </div>

    <!-- 3. SECCIÓN: INCLUIDO EN PREMIUM -->
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-[#0f172a] mb-6">Incluido en Premium</h2>
        
        <ul class="space-y-4 mb-8">
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-[#8b5cf6] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                <span class="text-[15px] text-[#1e293b]">Publica preguntas sobre diseño, marketing, ventas, finanzas y más</span>
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-[#8b5cf6] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                <span class="text-[15px] text-[#1e293b]">Solo SINGKI puede responder — respuestas oficiales y verificadas</span>
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-[#8b5cf6] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                <span class="text-[15px] text-[#1e293b]">Preguntas y respuestas quedan como biblioteca de conocimiento accesible</span>
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-[#8b5cf6] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                <span class="text-[15px] text-[#1e293b]">Comunidad enfocada en crecimiento real de negocios</span>
            </li>
        </ul>

        <a href="{{ url('/admin/premium/planes') }}" class="w-full bg-[#8b5cf6] hover:bg-[#7c3aed] text-white font-semibold py-4 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2">
            <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.006z" clip-rule="evenodd" /></svg> Obtener Premium — desde C$199/mes
        </a>
    </div>

</div>
@endif

@endsection
