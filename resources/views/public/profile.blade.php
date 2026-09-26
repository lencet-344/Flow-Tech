<!-- ========================================== -->
<!-- VISTA: PERFIL PÚBLICO DEL NEGOCIO          -->
<!-- ========================================== -->
<div class="relative bg-gray-50 min-h-screen pb-12">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- BANNER SUPERIOR -->
    <div class="h-64 w-full bg-gray-800 overflow-hidden">
        <img src="{{ $negocio->banner_url ?? asset('images/default-banner.jpg') }}" alt="Banner de {{ $negocio->name }}" class="w-full h-full object-cover opacity-80">
    </div>

    <!-- TARJETA PRINCIPAL DE INFORMACIÓN -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 mb-8">
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                <!-- Logo -->
                <div class="shrink-0">
                    <div class="w-32 h-32 bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 flex items-center justify-center">
                        @if(!empty($negocio->logo))
                            <img src="{{ asset('storage/' . $negocio->logo) }}" alt="{{ $negocio->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-4xl font-extrabold text-white tracking-widest uppercase w-full h-full flex items-center justify-center bg-gradient-to-br from-[#1F51FF] to-indigo-600">
                                {{ mb_substr($negocio->name, 0, 2) }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Info Central -->
                <div class="flex-grow">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-2xl font-extrabold text-[#0f172a]">{{ $negocio->name }}</h1>
                        <span class="bg-[#dcfce7] text-[#16a34a] px-2 py-0.5 rounded-full text-[10px] font-bold flex items-center gap-1 border border-green-200">
                            ✓ Verificado
                        </span>
                        @if($negocio->is_premium)
                            <span class="bg-[#f5f3ff] text-[#8b5cf6] px-2 py-0.5 rounded-full text-[10px] font-bold flex items-center gap-1 border border-purple-200 uppercase">
                                <span class="text-yellow-400">★</span> PREMIUM
                            </span>
                        @endif
                    </div>

                    <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[12px] font-medium px-3 py-1 rounded-full mb-3">
                        {{ $negocio->category->name ?? 'Categoría General' }}
                    </span>

                    <p class="text-gray-500 text-[14px] mb-6 font-light max-w-3xl">
                        {{ $negocio->description ?? 'Sin descripción detallada registrada en el sistema.' }}
                    </p>

                    <!-- Botones de Acción -->
                    <div class="flex flex-wrap gap-3 mb-2">
                        <button class="px-5 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition">
                            ♡ Favorito
                        </button>
                        <button class="px-5 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition">
                            📍 Ver ubicación
                        </button>
                        <button class="px-6 py-2.5 bg-[#2563eb] text-white rounded-full text-sm font-bold hover:bg-blue-700 flex items-center gap-2 shadow-md transition">
                            💬 Chatear
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer de Tarjeta -->
            <div class="flex flex-wrap items-center justify-between mt-6 pt-5 border-t border-gray-100 text-[13px] text-gray-500">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-1">
                        <span class="text-yellow-400 text-lg leading-none">★</span> 
                        <span class="font-bold text-gray-900">{{ $negocio->rating ?? '5.0' }}</span> 
                        <span>({{ $negocio->reviews_count ?? '0' }} reseñas)</span>
                    </div>
                    <div class="flex items-center gap-1">📍 {{ $negocio->address ?? 'Ubicación no especificada' }}</div>
                    <div class="flex items-center gap-1">🕒 Lun-Vie 8:00-18:00</div>
                    <div class="flex items-center gap-1">✉️ {{ $negocio->email ?? 'contacto@' . strtolower(str_replace(' ', '', $negocio->name)) . '.com' }}</div>
                </div>
                <button class="flex items-center gap-1 text-gray-400 hover:text-red-500 transition">
                    🚩 Reportar negocio
                </button>
            </div>
        </div>
    </div>

    <!-- PESTAÑAS DE NAVEGACIÓN -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="flex gap-3">
            <button class="bg-[#2563eb] text-white px-6 py-2.5 rounded-full text-[14px] font-bold shadow-md flex items-center gap-2">
                📦 Productos y Stock
            </button>
            <button class="bg-white text-gray-600 border border-gray-200 px-6 py-2.5 rounded-full text-[14px] font-medium hover:bg-gray-50 flex items-center gap-2">
                ☆ Reseñas
            </button>
            <button class="bg-white text-gray-600 border border-gray-200 px-6 py-2.5 rounded-full text-[14px] font-medium hover:bg-gray-50 flex items-center gap-2">
                ⓘ Información
            </button>
        </div>
    </div>

    <!-- SECCIÓN DE PRODUCTOS Y DISPONIBILIDAD -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            
            <!-- Cabecera de tabla -->
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-xl font-extrabold text-[#0f172a]">Productos y disponibilidad</h2>
                
                <!-- Conteo dinámico de stock (Opcional si tienes la lógica en el modelo) -->
                <div class="flex gap-3 text-[11px] font-bold">
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1.5 rounded-full">
                        {{ $negocio->products->where('quantity', '>', 0)->count() ?? 0 }} disponibles
                    </span>
                    <span class="bg-[#fee2e2] text-[#ef4444] px-3 py-1.5 rounded-full">
                        {{ $negocio->products->where('quantity', '<=', 0)->count() ?? 0 }} agotados
                    </span>
                </div>
            </div>

            <!-- Tabla de inventario -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="pb-4 pl-2">Producto</th>
                            <th class="pb-4">Marca</th>
                            <th class="pb-4">Stock</th>
                            <th class="pb-4">Estado</th>
                            <th class="pb-4 text-right pr-2">Precio</th>
                        </tr>
                    </thead>
                    <tbody class="text-[14px]">
                        @forelse($negocio->products ?? [] as $producto)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="py-4 pl-2 font-medium text-gray-900">{{ $producto->name }}</td>
                            <td class="py-4 text-gray-500">{{ $producto->brand ?? 'N/A' }}</td>
                            <td class="py-4 text-gray-500">{{ $producto->quantity }} und.</td>
                            <td class="py-4">
                                @if($producto->quantity > 0)
                                    <span class="text-[#16a34a] font-medium">En stock</span>
                                @else
                                    <span class="text-[#ef4444] font-medium">Agotado</span>
                                @endif
                            </td>
                            <td class="py-4 text-right pr-2 font-bold text-[#0f172a]">C$ {{ number_format($producto->price, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-500 font-light">
                                Este proveedor aún no ha registrado productos en su inventario.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>