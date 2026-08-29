@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 max-w-5xl mx-auto">
    
    <!-- 1. BANNER HEADER -->
    <div class="bg-gradient-to-br from-[#6d28d9] to-[#312e81] rounded-3xl p-10 mb-8 shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full border border-white/30 bg-white/10 text-white text-xs font-bold uppercase tracking-wider mb-6 backdrop-blur-sm">
                <span class="text-yellow-400 text-sm">⭐</span> Premium exclusivo
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

        <button class="w-full bg-[#8b5cf6] hover:bg-[#7c3aed] text-white font-semibold py-4 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2">
            <span class="text-yellow-300">⭐</span> Obtener Premium — desde C$199/mes
        </button>
    </div>

</div>
@endsection
