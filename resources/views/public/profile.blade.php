<!-- ========================================== -->
<!-- VISTA: PERFIL PÚBLICO DEL NEGOCIO          -->
<!-- ========================================== -->
<div class="relative bg-gray-50 min-h-screen pb-12" x-data="{
        tab: 'productos',
        showReviewModal: false,
        reviewStep: 1,
        rating: 0,
        hoverRating: 0,
        reviewText: '',
        storageKey: 'reviews_company_{{ $negocio->id ?? md5($negocio->name ?? 'default') }}',
        userName: '{{ auth()->check() ? explode(' ', auth()->user()->name)[0] : 'Usuario' }}',
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
    
    <!-- BANNER SUPERIOR -->
    @php
        $slugSearch = \Illuminate\Support\Str::slug($negocio->name ?? request('negocio', ''));
        $idSearch = $negocio->id ?? \App\Models\Company::where('name', $negocio->name ?? request('negocio'))->value('id');
        $bannerMatches = array_merge(
            $idSearch ? (glob(public_path('images/banners/company_' . $idSearch . '.*')) ?: []) : [],
            $slugSearch ? (glob(public_path('images/banners/negocio_' . $slugSearch . '.*')) ?: []) : []
        );
        $bannerUrl = !empty($bannerMatches) ? asset('images/banners/' . basename($bannerMatches[0])) . '?v=' . filemtime($bannerMatches[0]) : null;
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
                        @endphp
                        <div x-data="{ 
                            isFav: {{ $isFav ? 'true' : 'false' }},
                            animating: false,
                            async toggleFav() {
                                @if(!auth()->check())
                                    window.location.href = '{{ route('login') }}';
                                    return;
                                @endif

                                this.animating = true;
                                setTimeout(() => this.animating = false, 300);

                                // Actualización optimista
                                this.isFav = !this.isFav;

                                try {
                                    const response = await fetch('{{ route('favorites.toggle') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            type: 'company',
                                            id: {{ $negocio->id ?? 0 }}
                                        })
                                    });
                                    if (!response.ok) throw new Error('Error en red');
                                    const data = await response.json();
                                    this.isFav = data.favorited;
                                } catch (error) {
                                    this.isFav = !this.isFav; // Revertir
                                    console.error('Error:', error);
                                }
                            }
                        }">
                            <button type="button" 
                                    @click="toggleFav()" 
                                    :class="isFav ? 'bg-red-50 border-red-200 text-red-600' : 'bg-white border-gray-200 text-gray-700 hover:bg-gray-50'"
                                    class="px-5 py-2.5 border rounded-full text-sm font-medium flex items-center gap-2 transition-all duration-200 select-none">
                                <svg class="w-4 h-4 transition-transform duration-300" 
                                     :class="[isFav ? 'text-red-500 fill-red-500' : 'text-gray-600 fill-none', animating ? 'scale-150' : 'scale-100']" 
                                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span>Favorito</span>
                            </button>
                        </div>
                        @if(!empty($negocio->address))
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($negocio->address) }}" target="_blank" class="px-5 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition">
                            📍 Ver ubicación
                        </a>
                        @else
                        <button disabled class="px-5 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-400 cursor-not-allowed opacity-50 flex items-center gap-2 transition">
                            📍 Ver ubicación
                        </button>
                        @endif
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $negocio->telephone ?? '') }}" target="_blank" class="px-6 py-2.5 bg-[#2563eb] text-white rounded-full text-sm font-bold hover:bg-blue-700 flex items-center gap-2 shadow-md transition">
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
                <button class="flex items-center gap-1 text-gray-400 hover:text-red-500 transition">
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