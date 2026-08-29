@extends('layouts.admin')

@section('content')
<div class="p-8 md:p-10 max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h1 class="text-[28px] font-extrabold text-[#0f172a] tracking-tight">Comunidad de Crecimiento</h1>
                <span class="bg-[#8b5cf6] text-white text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1 uppercase tracking-wider">
                    <span class="text-yellow-300">⭐</span> Premium
                </span>
            </div>
            <p class="text-gray-500 text-sm">Resuelve dudas de tu negocio con apoyo oficial de SINGKI</p>
        </div>
        <button class="bg-[#8b5cf6] hover:bg-[#7c3aed] text-white font-medium px-6 py-2.5 rounded-xl text-sm shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Publicar pregunta
        </button>
    </div>

    <!-- CATEGORÍAS (Borde morado) -->
    <div class="bg-white border-[2.5px] border-[#a78bfa] rounded-3xl p-8 mb-6 shadow-sm">
        <h2 class="text-lg font-bold text-[#0f172a] mb-6">¿Qué necesitas resolver hoy?</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Items de Categoría -->
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Diseño e identidad<br>visual</span></button>
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Marketing y redes<br>sociales</span></button>
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Precios y finanzas</span></button>
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Ventas y clientes</span></button>
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Organización</span></button>
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Publicidad y promociones</span></button>
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Presentación de productos</span></button>
            <button class="flex flex-col items-center justify-center p-5 rounded-2xl bg-[#f5f3ff] border border-[#ddd6fe] hover:border-[#a78bfa] transition-colors text-center group h-28"><svg class="w-7 h-7 text-[#8b5cf6] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"></path></svg><span class="text-[13px] font-medium text-[#7c3aed] leading-tight">Crecimiento</span></button>
        </div>
    </div>

    <!-- INFO BOX -->
    <div class="bg-[#f5f3ff] border border-[#ddd6fe] rounded-xl p-5 mb-8 flex items-start gap-4 shadow-sm">
        <div class="bg-gray-300/50 text-gray-600 rounded w-6 h-6 flex items-center justify-center shrink-0 font-bold font-serif text-sm">i</div>
        <p class="text-[14px] text-[#475569]">
            Las preguntas son revisadas y respondidas únicamente por el equipo de SINGKI. Las respuestas aparecen como <span class="font-bold text-[#0f172a]">"Respuesta oficial de SINGKI"</span> y forman una biblioteca de conocimiento para emprendedores Premium.
        </p>
    </div>

    <!-- TABS -->
    <div class="flex gap-3 mb-6">
        <button class="bg-[#8b5cf6] text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm">Todas</button>
        <button class="bg-[#2563eb] text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm">En revisión</button>
        <button class="bg-[#2563eb] text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm">Respondidas</button>
    </div>

    <!-- LISTA DE PREGUNTAS -->
    <div class="flex flex-col gap-6">
        
        <!-- Pregunta 1 (Respondida) -->
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-2">
                    <span class="bg-[#8b5cf6] text-white px-3 py-1 rounded-full text-xs font-medium">Marketing</span>
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-xs font-medium">Respondida</span>
                </div>
                <span class="text-sm text-gray-500">2026-08-20</span>
            </div>
            <h3 class="text-lg font-bold text-[#0f172a] mb-1">¿Cuál es la mejor estrategia para dar a conocer mi negocio en SINGKI y atraer más clientes?</h3>
            <p class="text-sm text-gray-500 mb-6">TechSolutions GT</p>
            
            <div class="border-[2px] border-[#a78bfa] rounded-[20px] p-6 bg-white shadow-sm relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-[#8b5cf6] text-white rounded-full flex items-center justify-center font-bold text-sm">S</div>
                        <span class="font-bold text-[#0f172a] text-sm">Respuesta oficial de SINGKI</span>
                    </div>
                    <span class="text-xs text-gray-500">2026-08-21</span>
                </div>
                <p class="text-[14px] text-gray-600 leading-relaxed md:pl-11">Te recomendamos mantener tu perfil completo y actualizado, subir fotos de calidad de tus productos y responder rápidamente los chats. Publicar ofertas periódicas también aumenta tu visibilidad en los resultados de búsqueda.</p>
            </div>
        </div>

        <!-- Pregunta 2 (Respondida) -->
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-2">
                    <span class="bg-[#8b5cf6] text-white px-3 py-1 rounded-full text-xs font-medium">Precios</span>
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-xs font-medium">Respondida</span>
                </div>
                <span class="text-sm text-gray-500">2026-08-21</span>
            </div>
            <h3 class="text-lg font-bold text-[#0f172a] mb-1">¿Cómo establezco precios competitivos cuando hay otros negocios del mismo rubro con precios muy bajos?</h3>
            <p class="text-sm text-gray-500 mb-6">Moda Express</p>
            
            <div class="border-[2px] border-[#a78bfa] rounded-[20px] p-6 bg-white shadow-sm relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-[#8b5cf6] text-white rounded-full flex items-center justify-center font-bold text-sm">S</div>
                        <span class="font-bold text-[#0f172a] text-sm">Respuesta oficial de SINGKI</span>
                    </div>
                    <span class="text-xs text-gray-500">2026-08-22</span>
                </div>
                <p class="text-[14px] text-gray-600 leading-relaxed md:pl-11">Diferenciarte por valor es clave. Destaca la calidad, el servicio al cliente y la confiabilidad. Evita competir solo por precio; en cambio, asegúrate de que tu propuesta de valor sea clara en tu perfil y descripción de productos.</p>
            </div>
        </div>

        <!-- Pregunta 3 (En revisión) -->
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-2">
                    <span class="bg-[#8b5cf6] text-white px-3 py-1 rounded-full text-xs font-medium">Finanzas</span>
                    <span class="bg-orange-50 text-orange-600 px-3 py-1 rounded-full text-xs font-medium">En revisión</span>
                </div>
                <span class="text-sm text-gray-500">2026-08-22</span>
            </div>
            <h3 class="text-lg font-bold text-[#0f172a] mb-1">¿Cómo puedo gestionar mejor el flujo de caja de mi negocio en temporadas bajas?</h3>
            <p class="text-sm text-gray-500">Construcciones Sólidas</p>
        </div>

        <!-- Pregunta 4 (En revisión) -->
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-2">
                    <span class="bg-[#8b5cf6] text-white px-3 py-1 rounded-full text-xs font-medium">Ventas</span>
                    <span class="bg-orange-50 text-orange-600 px-3 py-1 rounded-full text-xs font-medium">En revisión</span>
                </div>
                <span class="text-sm text-gray-500">2026-08-23</span>
            </div>
            <h3 class="text-lg font-bold text-[#0f172a] mb-1">¿Hay alguna recomendación para aumentar la cantidad de reservas a través de SINGKI?</h3>
            <p class="text-sm text-gray-500">Distribuidora Alimentos Norte</p>
        </div>

    </div>
</div>
@endsection
