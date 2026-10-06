<!-- ========================================== -->
<!-- VISTA: PERFIL PÚBLICO DEL NEGOCIO          -->
<!-- ========================================== -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
</head>
<body>
<div class="relative bg-gray-50 min-h-screen pb-12" x-data="{
        tab: 'productos',
        showReviewModal: false,
        reviewStep: 1,
        rating: 0,
        hoverRating: 0,
        reviewText: '',
        storageKey: 'reviews_company_{{ $negocio->id ?? md5($negocio->name ?? 'default') }}',
        userName: '{{ auth()->check() ? explode(' ', auth()->user()->name)[0] : 'Usuario' }}',
        reportModalOpen: false,
        reportStep: 1,
        selectedReason: '',
        reportDetails: '',
        reportError: false,
        reviews: [],
        get averageRating() {
            if (this.reviews.length === 0) return '0.0';
            const sum = this.reviews.reduce((acc, r) => acc + parseInt(r.estrellas), 0);
            return (sum / this.reviews.length).toFixed(1);
        },
        init() {
            const saved = localStorage.getItem(this.storageKey);
            this.reviews = saved ? JSON.parse(saved) : [];
        },
        submitReview() {
            if (this.rating === 0 || this.reviewText.trim() === '') return;
            this.reviews.unshift({
                nombre: this.userName,
                fecha: new Date().toISOString().split('T')[0],
                estrellas: this.rating,
                texto: this.reviewText.trim()
            });
            localStorage.setItem(this.storageKey, JSON.stringify(this.reviews));
            this.reviewStep = 2;
        },
        closeModal() {
            this.showReviewModal = false;
            setTimeout(() => {
                this.reviewStep = 1;
                this.rating = 0;
                this.hoverRating = 0;
                this.reviewText = '';
            }, 300);
        }
    }">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- HEADER SUPERIOR LIMPIO SINGKI -->
    <header class="bg-white/95 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40 px-6 py-3.5 flex justify-between items-center">
        <div class="flex items-center gap-2 select-none cursor-pointer" onclick="window.location.href='{{ url('/') }}'">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href='{{ url('/') }}'; }" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 hover:bg-[#1F51FF] text-slate-700 hover:text-white font-bold text-sm transition cursor-pointer shadow-xs">
                &larr; Regresar
            </button>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-[#1F51FF] transition px-2">Inicio</a>
            @auth
            <a href="{{ route('profile.edit') }}" class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#1F51FF] to-[#0a194f] text-white flex items-center justify-center font-bold text-xs shadow-sm hover:opacity-90 transition ml-2">
                {{ substr(auth()->user()->name, 0, 1) }}
            </a>
            @endauth
        </div>
    </header>
    
    <!-- BANNER SUPERIOR -->
    @php
        $idSearch = $negocio->id ?? \App\Models\Company::where('name', $negocio->name ?? request('negocio'))->value('id');
        $bannerUrl = null;
        if ($idSearch && $idSearch > 0) {
            $bannerMatches = glob(public_path('images/banners/company_' . $idSearch . '.*')) ?: [];
            if (!empty($bannerMatches)) {
                $bannerUrl = asset('images/banners/' . basename($bannerMatches[0])) . '?v=' . filemtime($bannerMatches[0]);
            }
        }
    @endphp
    <div class="h-64 w-full relative overflow-hidden bg-gradient-to-r from-[#0a194f] via-[#163080] to-[#1F51FF]">
        @if($bannerUrl)
            <img src="{{ $bannerUrl }}" alt="Banner de {{ $negocio->name ?? 'Negocio' }}" class="w-full h-full object-cover object-center" onerror="this.style.display='none'">
        @endif
    </div>

    <!-- TARJETA PRINCIPAL DE INFORMACIÓN -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 mb-8">
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                <!-- Logo -->
                <div class="shrink-0">
                    <div class="w-32 h-32 bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 flex items-center justify-center">
                        @if(!empty($negocio->logo))
                            <img src="{{ asset('storage/' . $negocio->logo) }}" alt="{{ $negocio->name ?? 'Logo' }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-4xl font-extrabold text-white tracking-widest uppercase w-full h-full flex items-center justify-center bg-blue-600">
                                {{ mb_substr($negocio->name ?? 'NN', 0, 2) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Info Central -->
                <div class="flex-grow">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-2xl font-extrabold text-[#0f172a]">{{ $negocio->name ?? 'Negocio sin nombre' }}</h1>
                        <span class="bg-[#dcfce7] text-[#16a34a] px-2 py-0.5 rounded-full text-[10px] font-bold flex items-center gap-1 border border-green-200">
                            ✓ Verificado
                        </span>
                        @if(!empty($negocio->is_premium))
                            <span class="bg-[#f5f3ff] text-[#8b5cf6] px-2 py-0.5 rounded-full text-[10px] font-bold flex items-center gap-1 border border-purple-200 uppercase">
                                <span class="text-yellow-400">★</span> PREMIUM
                            </span>
                        @endif
                    </div>

                    <span class="inline-block bg-[#eff6ff] text-[#3b82f6] text-[12px] font-medium px-3 py-1 rounded-full mb-3">
                        {{ $negocio->category?->name ?? 'Categoría general' }}
                    </span>

                    <p class="text-gray-500 text-[14px] mb-6 font-light max-w-3xl">
                        {{ $negocio->description ?? 'El propietario aún no ha añadido una descripción detallada para este negocio.' }}
                    </p>

                    <!-- Botones de Acción -->
                    <div class="flex flex-wrap gap-3 mb-2">
                        @php
                            $isFav = false;
                            if (auth()->check() && isset($negocio->id)) {
                                $isFav = \App\Models\Favorite::where('user_id', auth()->id())
                                    ->where('name', 'U:' . auth()->id() . '|C:' . $negocio->id)
                                    ->exists();
                            }
                            $negocioId = $negocio->id ?? md5($negocio->name ?? 'default');
                        @endphp
                        <div x-data="{
                            isFav: false,
                            init() {
                                const isStoredFav = localStorage.getItem('fav_company_{{ $negocioId }}') === 'true';
                                @if(auth()->check())
                                    const isDbFav = {{ $isFav ? 'true' : 'false' }};
                                    this.isFav = isDbFav || isStoredFav;
                                @else
                                    this.isFav = isStoredFav;
                                @endif
                            },
                            async toggleFav() {
                                this.isFav = !this.isFav;
                                localStorage.setItem('fav_company_{{ $negocioId }}', this.isFav);
                                
                                let arr = JSON.parse(localStorage.getItem('singki_fav_businesses') || '[]');
                                if(this.isFav) {
                                    if(!arr.some(n => n.id == '{{ $negocioId }}')) {
                                        arr.push({
                                            id: '{{ $negocioId }}',
                                            name: '{{ $negocio->name ?? "" }}',
                                            category: '{{ $negocio->category?->name ?? "" }}',
                                            address: '{{ $negocio->address ?? "" }}',
                                            url: '{{ url()->current() }}'
                                        });
                                    }
                                    if(typeof window.showSingkiToast === 'function') window.showSingkiToast('✓ Negocio guardado en tus favoritos');
                                } else {
                                    arr = arr.filter(n => n.id != '{{ $negocioId }}');
                                    if(typeof window.showSingkiToast === 'function') window.showSingkiToast('Eliminado de tus favoritos');
                                }
                                localStorage.setItem('singki_fav_businesses', JSON.stringify(arr));

                                @if(auth()->check())
                                try {
                                    fetch('{{ route('favorites.toggle') }}', {
                                        method: 'POST',
                                        headers: { 
                                            'Content-Type': 'application/json', 
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({ type: 'company', id: '{{ $negocioId }}' })
                                    });
                                } catch(e) { }
                                @else
                                    window.location.href = '{{ route('login') }}';
                                @endif
                            }
                        }">
                            <button type="button" 
                                    @click.prevent.stop="toggleFav()"
                                    :class="isFav ? 'bg-red-50 border-red-200 text-red-600' : 'text-gray-700 hover:bg-gray-50'"
                                    :style="isFav ? 'background-color: #fef2f2 !important; border-color: #fecaca !important; color: #dc2626 !important;' : ''"
                                    class="px-5 py-2.5 border rounded-full text-sm font-medium flex items-center gap-2 transition-all duration-200 select-none">
                                <svg class="w-4 h-4 transition-transform duration-300" 
                                     :style="isFav ? 'fill: #ef4444 !important; stroke: #ef4444 !important; color: #ef4444 !important;' : 'fill: none; stroke: currentColor;'"
                                     stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span x-text="isFav ? 'En Favoritos' : 'Favorito'"></span>
                            </button>
                        </div>
                        <script>

                            if(typeof window.showSingkiToast === 'undefined') {
                                window.showSingkiToast = function(msg) {
                                    let t = document.getElementById('singki-toast-fixed');
                                    if(!t) {
                                        t = document.createElement('div');
                                        t.id = 'singki-toast-fixed';
                                        t.className = 'fixed top-24 right-6 z-[9999] transform transition-all duration-300 opacity-0 translate-y-[-10px] bg-green-500 text-white px-4 py-2.5 rounded-xl shadow-lg font-bold text-sm';
                                        document.body.appendChild(t);
                                    }
                                    t.textContent = msg;
                                    t.style.opacity = '1';
                                    t.style.transform = 'translateY(0)';
                                    setTimeout(() => {
                                        t.style.opacity = '0';
                                        t.style.transform = 'translateY(-10px)';
                                    }, 3000);
                                };
                            }
                        </script>
                        @if(!empty($negocio->address))
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($negocio->address) }}" target="_blank" class="px-5 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition">
                            📍 Ver ubicación
                        </a>
                        @else
                        <button disabled class="px-5 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-400 cursor-not-allowed opacity-50 flex items-center gap-2 transition">
                            📍 Ver ubicación
                        </button>
                        @endif
                        <a href="{{ url('/chat-negocio?negocio=' . urlencode($negocio->name ?? '')) }}" class="px-6 py-2.5 bg-[#2563eb] text-white rounded-full text-sm font-bold hover:bg-blue-700 flex items-center gap-2 shadow-md transition">
                            💬 Chatear
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer de Tarjeta -->
            <div class="flex flex-wrap items-center justify-between mt-6 pt-5 border-t border-gray-100 text-[13px] text-gray-500">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-1">
                        <span class="text-yellow-400 text-lg leading-none">★</span> 
                        <span class="font-bold text-gray-900" x-text="averageRating">{{ $negocio->rating ?? '5.0' }}</span> 
                        <span>(<span x-text="reviews.length">{{ $negocio->reviews_count ?? '0' }}</span> reseñas)</span>
                    </div>
                    <div class="flex items-center gap-1">📍 {{ $negocio->address ?? 'Ubicación no especificada' }}</div>
                    <div class="flex items-center gap-1">🕒 {{ $negocio->horario ?? 'Horario no disponible' }}</div>
                    <div class="flex items-center gap-1">✉️ {{ $negocio->email ?? 'Correo no proporcionado' }}</div>
                </div>
                <button type="button" onclick="window.abrirModalReporteSingki()" class="text-red-500 hover:text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-xl transition flex items-center gap-1.5 text-xs font-semibold cursor-pointer">
                    🚩 Reportar negocio
                </button>
            </div>
        </div>
    </div>



    <!-- PESTAÑAS DE NAVEGACIÓN -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="flex gap-3">
            <button @click="tab = 'productos'" 
                    :class="tab === 'productos' ? 'bg-[#2563eb] text-white border-[#2563eb] shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-2.5 rounded-full text-[14px] font-bold border transition-colors flex items-center gap-2">
                📦 Productos y Stock
            </button>
            <button @click="tab = 'reseñas'" 
                    :class="tab === 'reseñas' ? 'bg-[#2563eb] text-white border-[#2563eb] shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-2.5 rounded-full text-[14px] font-bold border transition-colors flex items-center gap-2">
                ☆ Reseñas
            </button>
            <button @click="tab = 'informacion'" 
                    :class="tab === 'informacion' ? 'bg-[#2563eb] text-white border-[#2563eb] shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-2.5 rounded-full text-[14px] font-bold border transition-colors flex items-center gap-2">
                ⓘ Información
            </button>
        </div>
    </div>

    <!-- SECCIÓN DE PRODUCTOS Y DISPONIBILIDAD -->
    <div x-show="tab === 'productos'" x-transition.opacity.duration.300ms class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            
            <!-- Cabecera de tabla -->
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-xl font-extrabold text-[#0f172a]">Productos y disponibilidad</h2>
                
                <!-- Conteo dinámico de stock (Opcional si tienes la lógica en el modelo) -->
                <div class="flex gap-3 text-[11px] font-bold">
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1.5 rounded-full">
                        {{ collect($negocio->products ?? [])->where('quantity', '>', 0)->count() ?? 0 }} disponibles
                    </span>
                    <span class="bg-[#fee2e2] text-[#ef4444] px-3 py-1.5 rounded-full">
                        {{ collect($negocio->products ?? [])->where('quantity', '<=', 0)->count() ?? 0 }} agotados
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

    <!-- SECCIÓN DE RESEÑAS -->
    <div x-show="tab === 'reseñas'" style="display: none;" x-transition.opacity.duration.300ms class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-extrabold text-[#0f172a]">Reseñas de clientes</h2>
                <button @click="showReviewModal = true" class="bg-[#2563eb] text-white px-5 py-2 rounded-full text-sm font-bold shadow-sm hover:bg-blue-600 transition">
                    + Escribir reseña
                </button>
            </div>

            <!-- Lista de Reseñas -->
            <div class="space-y-6">
                <template x-if="reviews.length === 0">
                    <div class="text-center py-12 text-gray-500 font-light">
                        Aún no hay reseñas. ¡Sé el primero en calificar este negocio!
                    </div>
                </template>
                <template x-for="(res, index) in reviews" :key="index">
                    <div class="p-5 border border-gray-50 rounded-2xl bg-gray-50/30">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-[#2563eb] text-white flex items-center justify-center font-bold text-lg" x-text="res.nombre.charAt(0)"></div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm" x-text="res.nombre"></h4>
                                <span class="text-xs text-gray-400" x-text="res.fecha"></span>
                            </div>
                        </div>
                        <div class="text-yellow-400 text-sm mb-2" x-text="'★'.repeat(res.estrellas) + '☆'.repeat(5 - res.estrellas)"></div>
                        <p class="text-gray-600 text-sm leading-relaxed" x-text="res.texto"></p>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- SECCIÓN DE INFORMACIÓN -->
    <div x-show="tab === 'informacion'" style="display: none;" x-transition.opacity.duration.300ms class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">
            <h2 class="text-xl font-extrabold text-[#0f172a] mb-4">Acerca del negocio</h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-8">
                {{ $negocio->description ?? 'El propietario aún no ha añadido una descripción detallada para este negocio.' }}
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12 border-t border-gray-100 pt-6">
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Nombre</span>
                    <span class="text-sm font-medium text-gray-900">{{ $negocio->name ?? 'Negocio sin nombre' }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Categoría</span>
                    <span class="text-sm font-medium text-gray-900">{{ $negocio->category?->name ?? 'Categoría general' }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Ubicación</span>
                    <span class="text-sm font-medium text-gray-900">{{ $negocio->address ?? 'Ubicación no especificada' }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Horario</span>
                    <span class="text-sm font-medium text-gray-900">{{ $negocio->horario ?? 'Horario no disponible' }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Teléfono</span>
                    <span class="text-sm font-medium text-gray-900">{{ $negocio->telephone ?? 'Teléfono no proporcionado' }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Correo</span>
                    <span class="text-sm font-medium text-gray-900">{{ $negocio->email ?? 'Correo no proporcionado' }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Sitio Web</span>
                    <span class="text-sm font-medium text-gray-900">{{ $negocio->website ?? 'No especificado' }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Estado</span>
                    <span class="text-sm font-bold text-green-600 flex items-center gap-1">Verificado ✓</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE RESEÑAS -->
    <div x-show="showReviewModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Overlay -->
            <div x-show="showReviewModal" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="closeModal()"></div>

            <!-- Contenido Modal -->
            <div x-show="showReviewModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative inline-block w-full max-w-md p-8 overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-[24px] sm:my-8 sm:align-middle">
                
                <!-- Paso 1: Formulario -->
                <div x-show="reviewStep === 1">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-1">Califica tu experiencia</h3>
                    <p class="text-sm text-gray-500 mb-6">¿Cómo fue tu experiencia con {{ $negocio->name ?? 'este negocio' }}?</p>
                    
                    <!-- Estrellas Interactivas -->
                    <div class="flex justify-center gap-2 mb-6">
                        <template x-for="i in 5">
                            <svg @click="rating = i" @mouseenter="hoverRating = i" @mouseleave="hoverRating = 0"
                                 class="w-10 h-10 cursor-pointer transition-colors duration-150"
                                 :class="(hoverRating >= i || rating >= i) ? 'text-yellow-400 fill-yellow-400' : 'text-gray-200 fill-gray-200'"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                        </template>
                    </div>

                    <!-- Textarea -->
                    <div class="relative mb-6">
                        <textarea x-model="reviewText" maxlength="500" rows="4" 
                                  class="w-full px-4 py-3 text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none placeholder-gray-400"
                                  placeholder="Cuéntanos más sobre tu experiencia (opcional)..."></textarea>
                        <div class="absolute bottom-3 right-4 text-[10px] font-bold text-gray-400">
                            <span x-text="reviewText.length"></span>/500
                        </div>
                    </div>

                    <!-- Botones Modal -->
                    <div class="flex gap-3 mt-8">
                        <button type="button" @click="closeModal()" class="w-full px-4 py-3 text-sm font-bold text-gray-700 bg-white border border-gray-200 rounded-full hover:bg-gray-50 transition">
                            Cancelar
                        </button>
                        <button type="button" @click="submitReview()" 
                                :disabled="rating === 0 || reviewText.trim() === ''"
                                :class="(rating === 0 || reviewText.trim() === '') ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-700'"
                                class="w-full px-4 py-3 text-sm font-bold text-white bg-[#2563eb] rounded-full shadow-md transition">
                            Enviar reseña
                        </button>
                    </div>
                </div>

                <!-- Paso 2: Éxito -->
                <div x-show="reviewStep === 2" style="display: none;" class="text-center py-4">
                    <div class="w-16 h-16 mx-auto bg-green-100 text-green-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-2">¡Gracias por tu reseña!</h3>
                    <p class="text-sm text-gray-500 mb-8">Tu opinión ayuda a otros usuarios a tomar mejores decisiones.</p>
                    <button type="button" @click="closeModal()" class="w-full px-4 py-3 text-sm font-bold text-white bg-[#2563eb] rounded-full shadow-md hover:bg-blue-700 transition">
                        Volver al negocio
                    </button>
                </div>

            </div>
        </div>
    </div>


</div>

    <!-- MODAL REPORTAR NEGOCIO (Vanilla JS) -->
    <div id="modal-reporte-singki" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
        
        <div class="relative transform overflow-hidden rounded-[24px] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">
            
            <!-- PASO 1: Formulario -->
            <div id="reporte-paso-1">
                <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-lg font-bold text-[#0f172a]" id="modal-title">¿Por qué reportas este negocio?</h3>
                    <button type="button" onclick="window.cerrarModalReporteSingki()" class="text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full p-1.5 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                <div class="px-6 py-5">
                    <p class="text-sm text-gray-500 mb-4">Tu reporte es anónimo. Ayúdanos a mantener SINGKI seguro para todos.</p>
                    
                    <div class="space-y-2.5">
                        @php
                            $razones = [
                                'Información falsa o engañosa', 
                                'Posible fraude o cobro indebido', 
                                'Productos o servicios inapropiados', 
                                'Suplantación de identidad de otro comercio', 
                                'Spam o comportamiento abusivo', 
                                'Otro motivo'
                            ];
                        @endphp
                        @foreach($razones as $razon)
                            <button type="button" onclick="window.seleccionarMotivoReporte(this, '{{ $razon }}')" class="w-full text-left flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 text-gray-700 cursor-pointer transition btn-motivo-reporte">
                                <div class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center flex-shrink-0 indicador-radio">
                                    <div class="w-2 h-2 rounded-full bg-[#1F51FF] hidden dot-radio"></div>
                                </div>
                                <span class="text-sm font-semibold">{{ $razon }}</span>
                            </button>
                        @endforeach
                    </div>

                    <!-- Textarea opcional -->
                    <div class="mt-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Información adicional (Opcional)</label>
                        <textarea id="reporte-detalles" rows="3" class="w-full border-gray-200 rounded-xl focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm resize-none p-3 shadow-sm bg-gray-50 hover:bg-white transition" placeholder="Cuéntanos más sobre el problema..."></textarea>
                    </div>
                    
                    <!-- Mensaje de error -->
                    <div id="reporte-error" style="display: none;">
                        <p class="text-red-500 text-xs font-semibold mt-3 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Por favor, selecciona un motivo de la lista.
                        </p>
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="window.cerrarModalReporteSingki()" class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition">
                        Cancelar
                    </button>
                    <button type="button" onclick="window.enviarReporteSingki()" class="px-5 py-2.5 text-sm font-bold text-white bg-red-500 hover:bg-red-600 rounded-xl transition shadow-sm shadow-red-500/30 flex items-center gap-2">
                        Enviar reporte
                    </button>
                </div>
            </div>

            <!-- PASO 2: Éxito -->
            <div id="reporte-paso-2" style="display: none;">
                <div class="px-6 py-12 text-center flex flex-col items-center">
                    <div class="w-20 h-20 bg-green-500 text-white rounded-full flex items-center justify-center mb-5 shadow-lg shadow-green-500/30">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-[#0f172a] mb-2">¡Negocio reportado con éxito!</h3>
                    <p class="text-gray-500 text-sm max-w-sm mx-auto">Gracias por tu reporte. Nuestro equipo de moderación lo revisará a la brevedad para garantizar la calidad de SINGKI.</p>
                    <button type="button" onclick="window.cerrarModalReporteSingki()" class="mt-8 px-8 py-3 text-sm font-bold text-white bg-[#0f172a] hover:bg-[#1e293b] rounded-xl transition w-full sm:w-auto shadow-md">
                        Listo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Vanilla JS para Modal Reporte -->
    <script>
        let reporteMotivoSeleccionado = '';

        window.abrirModalReporteSingki = function() {
            document.getElementById('modal-reporte-singki').style.display = 'flex';
            document.getElementById('reporte-paso-1').style.display = 'block';
            document.getElementById('reporte-paso-2').style.display = 'none';
            document.getElementById('reporte-error').style.display = 'none';
            document.getElementById('reporte-detalles').value = '';
            reporteMotivoSeleccionado = '';
            
            // Reset styles
            document.querySelectorAll('.btn-motivo-reporte').forEach(btn => {
                btn.classList.remove('border-[#1F51FF]', 'bg-blue-50/60', 'text-[#1F51FF]');
                btn.classList.add('border-gray-200', 'text-gray-700');
                btn.querySelector('.indicador-radio').classList.remove('border-[#1F51FF]');
                btn.querySelector('.indicador-radio').classList.add('border-gray-300');
                btn.querySelector('.dot-radio').style.display = 'none';
            });
        };

        window.cerrarModalReporteSingki = function() {
            document.getElementById('modal-reporte-singki').style.display = 'none';
        };

        window.seleccionarMotivoReporte = function(elemento, motivo) {
            reporteMotivoSeleccionado = motivo;
            document.getElementById('reporte-error').style.display = 'none';
            
            document.querySelectorAll('.btn-motivo-reporte').forEach(btn => {
                btn.classList.remove('border-[#1F51FF]', 'bg-blue-50/60', 'text-[#1F51FF]');
                btn.classList.add('border-gray-200', 'text-gray-700');
                btn.querySelector('.indicador-radio').classList.remove('border-[#1F51FF]');
                btn.querySelector('.indicador-radio').classList.add('border-gray-300');
                btn.querySelector('.dot-radio').style.display = 'none';
            });
            
            elemento.classList.remove('border-gray-200', 'text-gray-700');
            elemento.classList.add('border-[#1F51FF]', 'bg-blue-50/60', 'text-[#1F51FF]');
            elemento.querySelector('.indicador-radio').classList.remove('border-gray-300');
            elemento.querySelector('.indicador-radio').classList.add('border-[#1F51FF]');
            elemento.querySelector('.dot-radio').style.display = 'block';
        };

        window.enviarReporteSingki = function() {
            if (!reporteMotivoSeleccionado) {
                document.getElementById('reporte-error').style.display = 'block';
                return;
            }
            document.getElementById('reporte-paso-1').style.display = 'none';
            document.getElementById('reporte-paso-2').style.display = 'block';
        };
    </script>
</div>
</body>
</html>