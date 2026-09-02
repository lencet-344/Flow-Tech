@extends('layouts.admin')

@section('content')
@php
    $plan = request('plan', 'mensual');
    $precios = [
        'mensual' => 299,
        'trimestral' => 249,
        'anual' => 199
    ];
@endphp

<div class="max-w-xl mx-auto p-8 mt-12 mb-20 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 font-sans relative">
    <a href="{{ route('premium.planes') }}" class="absolute -top-10 left-0 text-sm text-gray-500 hover:text-[#8b5cf6]">&larr; Volver a planes</a>
    <h2 class="text-2xl font-extrabold text-[#0f172a] mb-6 tracking-tight">Confirmar plan</h2>
    
    <div class="bg-[#f8fafc] p-5 rounded-2xl flex justify-between items-center mb-8 border border-gray-100">
        <div>
            <p class="text-xs text-gray-500 font-medium mb-1">Plan seleccionado</p>
            <p class="font-bold capitalize text-[#0f172a] text-[15px]">Premium {{ $plan }}</p>
        </div>
        <div class="text-[#8b5cf6] font-black text-2xl">C$ {{ $precios[$plan] ?? 199 }}<span class="text-xs font-medium text-gray-500">/mes</span></div>
    </div>

    <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm">
        <h3 class="font-bold text-[#0f172a] mb-1 text-[15px]">Datos de pago</h3>
        <p class="text-[10px] text-gray-400 mb-5">Simulación de pago — no se procesará ningún cobro real</p>
        
        <form action="{{ route('premium.success') }}" method="GET" class="space-y-4">
            <div>
                <label class="block text-[11px] font-bold text-gray-700 mb-2">Nombre en la tarjeta</label>
                <input type="text" class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-[#8b5cf6] transition" placeholder="Carlos Pérez" required>
            </div>
            <div>
                <label class="block text-[11px] font-bold text-gray-700 mb-2">Número de tarjeta</label>
                <input type="text" class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-[#8b5cf6] transition" placeholder="4242 4242 4242 4242" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-gray-700 mb-2">Vencimiento</label>
                    <input type="text" class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-[#8b5cf6] transition" placeholder="MM/AA" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-700 mb-2">CVV</label>
                    <input type="text" class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-[#8b5cf6] transition" placeholder="123" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-[#8b5cf6] text-white font-bold py-3.5 rounded-xl hover:bg-[#7c3aed] transition mt-6 text-sm">
                Activar Premium — C$ {{ $precios[$plan] ?? 199 }}/mes
            </button>
        </form>
    </div>
</div>
@endsection
