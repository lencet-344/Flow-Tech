@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto mt-20 mb-32 bg-white rounded-3xl p-10 text-center shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100">
    <div class="w-20 h-20 bg-[#8b5cf6] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/30">
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
    </div>
    <h2 class="text-2xl font-extrabold text-[#0f172a] mb-3">Ya tienes Premium activo</h2>
    <p class="text-sm text-gray-500 font-light mb-8">Estás disfrutando de todos los beneficios exclusivos de SINGKI Premium.</p>
    
    <div class="grid grid-cols-2 gap-3 mb-8 text-left">
        <div class="border border-[#e9d5ff] rounded-xl p-3"><svg class="w-5 h-5 text-[#8b5cf6] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg><span class="text-[10px] font-bold text-[#8b5cf6]">Posicionamiento<br>destacado</span></div>
        <div class="border border-[#e9d5ff] rounded-xl p-3"><svg class="w-5 h-5 text-[#8b5cf6] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg><span class="text-[10px] font-bold text-[#8b5cf6]">Comunidad de<br>Crecimiento</span></div>
        <div class="border border-[#e9d5ff] rounded-xl p-3"><svg class="w-5 h-5 text-[#8b5cf6] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg><span class="text-[10px] font-bold text-[#8b5cf6]">Estadísticas<br>avanzadas</span></div>
        <div class="border border-[#e9d5ff] rounded-xl p-3"><svg class="w-5 h-5 text-[#8b5cf6] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path></svg><span class="text-[10px] font-bold text-[#8b5cf6]">Publicidad<br>incluida</span></div>
    </div>
    
    <!-- Importante: Ajusta esta URL a tu dashboard de administrador -->
    <a href="{{ url('/admin/dashboard') }}" class="block w-full bg-[#8b5cf6] text-white font-bold py-3.5 rounded-xl hover:bg-[#7c3aed] transition text-sm">
        Ir a mi panel Premium
    </a>
</div>
@endsection
