@extends('layouts.admin')

@section('content')
<div class="w-full bg-white min-h-screen pb-20 font-sans">
    <!-- Header Morado -->
    <div class="bg-[#8b5cf6] w-full pt-16 pb-24 px-4 text-center">
        <span class="bg-white/20 text-white text-[10px] font-bold uppercase tracking-[0.2em] px-4 py-1.5 rounded-full mb-6 inline-block shadow-sm">SINGKI Premium</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Lleva tu negocio al siguiente nivel</h1>
        <p class="text-white/90 text-sm md:text-base font-light max-w-2xl mx-auto">Destaca en SINGKI, accede a conocimiento exclusivo y crece con datos reales de tu mercado.</p>
    </div>

    <!-- Sección Beneficios -->
    <div class="max-w-5xl mx-auto px-4 -mt-10 mb-20 relative z-10">
        <h3 class="text-center text-white font-bold text-xl mb-6">Beneficios del PREMIUM</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- 1. Posicionamiento -->
            <div class="bg-[#8b5cf6] text-white p-6 rounded-2xl shadow-sm border border-[#7c3aed]">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                <h4 class="font-bold text-sm mb-2">Posicionamiento destacado</h4>
                <p class="text-[11px] font-light text-white/90">Tu negocio aparece primero en búsquedas, categorías y recomendaciones, con insignia PREMIUM visible.</p>
            </div>
            <!-- 2. Comunidad -->
            <div class="bg-[#8b5cf6] text-white p-6 rounded-2xl shadow-sm border border-[#7c3aed]">
                <svg class="w-8 h-8 text-white mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                <h4 class="font-bold text-sm mb-2">Comunidad de Crecimiento</h4>
                <p class="text-[11px] font-light text-white/90">Publica preguntas sobre diseño, marketing, finanzas, ventas y más. Recibe respuestas oficiales exclusivas de SINGKI.</p>
            </div>
            <!-- 3. Estadísticas -->
            <div class="bg-[#8b5cf6] text-white p-6 rounded-2xl shadow-sm border border-[#7c3aed]">
                <svg class="w-8 h-8 text-[#c4b5fd] mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
                <h4 class="font-bold text-sm mb-2">Estadísticas avanzadas</h4>
                <p class="text-[11px] font-light text-white/90">Visitas al perfil, guardados, conexiones, compras y curva de crecimiento. Todo en tiempo real.</p>
            </div>
            <!-- 4. Publicidad -->
            <div class="bg-[#8b5cf6] text-white p-6 rounded-2xl shadow-sm border border-[#7c3aed]">
                <svg class="w-8 h-8 text-yellow-500 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v4a2 2 0 002 2h7l5 5V3l-5 5z"/></svg>
                <h4 class="font-bold text-sm mb-2">Publicidad incluida</h4>
                <p class="text-[11px] font-light text-white/90">Campañas publicitarias con alcance estimado de hasta 100 personas/día incluidas en tu plan.</p>
            </div>
            <!-- 5. Insignia -->
            <div class="bg-[#8b5cf6] text-white p-6 rounded-2xl shadow-sm border border-[#7c3aed]">
                <svg class="w-8 h-8 text-yellow-400 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 15l-3 2.5 1-4.5-3-3 4.5-.5L12 3l2 4.5 4.5.5-3 3 1 4.5L12 15z"/></svg>
                <h4 class="font-bold text-sm mb-2">Insignia PREMIUM</h4>
                <p class="text-[11px] font-light text-white/90">Tus clientes identifican visualmente que tu negocio tiene respaldo premium de SINGKI.</p>
            </div>
            <!-- 6. Notificaciones -->
            <div class="bg-[#8b5cf6] text-white p-6 rounded-2xl shadow-sm border border-[#7c3aed]">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <h4 class="font-bold text-sm mb-2">Notificaciones prioritarias</h4>
                <p class="text-[11px] font-light text-white/90">Recibe alertas inmediatas de reservas, mensajes y reseñas antes que los demás.</p>
            </div>
        </div>
    </div>
    </div>

    <!-- Sección Precios -->
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-center text-[#0f172a] font-extrabold text-2xl mb-8 tracking-tight">Elige tu plan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
            
            <!-- Mensual -->
            <div class="bg-white border-2 border-gray-100 hover:border-[#8b5cf6] rounded-[2rem] p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="flex items-end gap-1 mb-2">
                    <span class="text-[11px] font-bold text-gray-400 mb-2">C$</span>
                    <span class="text-[2.5rem] font-black text-[#0f172a] leading-none">299</span>
                    <span class="text-xs text-gray-500 mb-1.5 font-medium">/mes</span>
                </div>
                <h4 class="font-bold text-[14px] text-[#0f172a] mb-6">Plan Mensual</h4>
                <ul class="text-[12px] text-gray-500 space-y-4 mb-8 flex-1 font-medium">
                    <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#8b5cf6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Facturación mensual</li>
                    <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#8b5cf6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Cancela cuando quieras</li>
                </ul>
                <a href="{{ url('/admin/premium/checkout?plan=mensual') }}" class="w-full bg-[#f8fafc] text-[#8b5cf6] group-hover:bg-[#8b5cf6] group-hover:text-white border border-[#e2e8f0] group-hover:border-[#8b5cf6] text-center py-3.5 rounded-xl font-bold text-[13px] transition-colors block shadow-sm">Elegir Mensual &rarr;</a>
            </div>

            <!-- Trimestral (Recomendado - Más Alto) -->
            <div class="bg-white border-2 border-[#8b5cf6] rounded-[2rem] p-8 shadow-xl transform md:-translate-y-6 flex flex-col relative">
                <span class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-[#8b5cf6] text-white text-[10px] font-bold uppercase tracking-widest px-4 py-1.5 rounded-full shadow-md">Recomendado</span>
                <div class="flex items-end gap-1 mb-2 mt-2">
                    <span class="text-[11px] font-bold text-gray-400 mb-2">C$</span>
                    <span class="text-[2.5rem] font-black text-[#0f172a] leading-none">249</span>
                    <span class="text-xs text-gray-500 mb-1.5 font-medium">/mes</span>
                </div>
                <h4 class="font-bold text-[14px] text-[#0f172a] mb-6">Plan Trimestral</h4>
                <ul class="text-[12px] text-gray-500 space-y-4 mb-8 flex-1 font-medium">
                    <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#8b5cf6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Facturación trimestral (C$ 747)</li>
                    <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#8b5cf6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Ahorro de C$ 150</li>
                </ul>
                <a href="{{ url('/admin/premium/checkout?plan=trimestral') }}" class="w-full bg-[#8b5cf6] text-white hover:bg-[#7c3aed] text-center py-3.5 rounded-xl font-bold text-[13px] transition-colors shadow-md block">Elegir Trimestral &rarr;</a>
            </div>

            <!-- Anual -->
            <div class="bg-white border-2 border-gray-100 hover:border-[#8b5cf6] rounded-[2rem] p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="flex items-end gap-1 mb-2">
                    <span class="text-[11px] font-bold text-gray-400 mb-2">C$</span>
                    <span class="text-[2.5rem] font-black text-[#0f172a] leading-none">199</span>
                    <span class="text-xs text-gray-500 mb-1.5 font-medium">/mes</span>
                </div>
                <h4 class="font-bold text-[14px] text-[#0f172a] mb-6">Plan Anual</h4>
                <ul class="text-[12px] text-gray-500 space-y-4 mb-8 flex-1 font-medium">
                    <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#8b5cf6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Facturación anual (C$ 2,388)</li>
                    <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#8b5cf6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Máximo ahorro a largo plazo</li>
                </ul>
                <a href="{{ url('/admin/premium/checkout?plan=anual') }}" class="w-full bg-[#f8fafc] text-[#8b5cf6] group-hover:bg-[#8b5cf6] group-hover:text-white border border-[#e2e8f0] group-hover:border-[#8b5cf6] text-center py-3.5 rounded-xl font-bold text-[13px] transition-colors block shadow-sm">Elegir Anual &rarr;</a>
            </div>

        </div>
    </div>
</div>
@endsection
