@extends('layouts.admin')

@section('content')
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
        <button class="w-full bg-[#7c3aed] hover:bg-[#6d28d9] text-white font-medium py-3.5 rounded-2xl transition-colors shadow-sm text-[15px] flex items-center justify-center gap-2">
            <span class="text-yellow-400 text-lg">⭐</span> Obtener Premium
        </button>
        
    </div>

</div>
@endsection
