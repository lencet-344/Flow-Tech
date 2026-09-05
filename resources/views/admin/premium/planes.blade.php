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
            <div class="text-white p-6 rounded-2xl shadow-sm border" style="background-color: #7847FF; border-color: #5F39CC;">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                <h4 class="font-bold text-sm mb-2">Posicionamiento destacado</h4>
                <p class="text-[11px] font-light text-white/90">Tu negocio aparece primero en búsquedas, categorías y recomendaciones, con insignia PREMIUM visible.</p>
            </div>
            <!-- 2. Comunidad -->
            <div class="text-white p-6 rounded-2xl shadow-sm border" style="background-color: #7847FF; border-color: #5F39CC;">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <h4 class="font-bold text-sm mb-2">Comunidad de Crecimiento</h4>
                <p class="text-[11px] font-light text-white/90">Publica preguntas sobre diseño, marketing, finanzas, ventas y más. Recibe respuestas oficiales exclusivas de SINGKI.</p>
            </div>
            <!-- 3. Estadísticas -->
            <div class="text-white p-6 rounded-2xl shadow-sm border" style="background-color: #7847FF; border-color: #5F39CC;">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <h4 class="font-bold text-sm mb-2">Estadísticas avanzadas</h4>
                <p class="text-[11px] font-light text-white/90">Visitas al perfil, guardados, conexiones, compras y curva de crecimiento. Todo en tiempo real.</p>
            </div>
            <!-- 4. Publicidad -->
            <div class="text-white p-6 rounded-2xl shadow-sm border" style="background-color: #7847FF; border-color: #5F39CC;">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                <h4 class="font-bold text-sm mb-2">Publicidad incluida</h4>
                <p class="text-[11px] font-light text-white/90">Campañas publicitarias con alcance estimado de hasta 100 personas/día incluidas en tu plan.</p>
            </div>
            <!-- 5. Insignia -->
            <div class="text-white p-6 rounded-2xl shadow-sm border" style="background-color: #7847FF; border-color: #5F39CC;">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <h4 class="font-bold text-sm mb-2">Insignia PREMIUM</h4>
                <p class="text-[11px] font-light text-white/90">Tus clientes identifican visualmente que tu negocio tiene respaldo premium de SINGKI.</p>
            </div>
            <!-- 6. Notificaciones -->
            <div class="text-white p-6 rounded-2xl shadow-sm border" style="background-color: #7847FF; border-color: #5F39CC;">
                <svg class="w-8 h-8 text-yellow-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <h4 class="font-bold text-sm mb-2">Notificaciones prioritarias</h4>
                <p class="text-[11px] font-light text-white/90">Recibe alertas inmediatas de reservas, mensajes y reseñas antes que los demás.</p>
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
