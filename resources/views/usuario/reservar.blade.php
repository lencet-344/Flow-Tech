<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-slate-50 font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Limpio y Exacto -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-200">
        <div class="flex items-center gap-2 select-none cursor-default">
            <!-- Isotipo limpio sin cajas de fondo -->
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <!-- Texto renderizado en HTML haciendo match con el color y peso -->
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </div>
        
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-1.5 rounded-full hover:bg-blue-50/80 transition cursor-pointer group" title="Mi perfil">
            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm overflow-hidden border border-blue-200">
                @if(Auth::check() && file_exists(public_path('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg')))
                    <img src="{{ asset('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg') . '?v=' . filemtime(public_path('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg')) }}" class="w-full h-full object-cover rounded-full">
                @else
                    {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'C' }}
                @endif
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Usuario' }}
            </span>
        </a>
    </header>

    <!-- Contenedor Principal Centrado (Corregido el ancho) -->
    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <!-- max-w-lg evita que se estire de lado a lado -->
        <div class="bg-white max-w-lg w-full rounded-2xl shadow-sm p-8 border border-gray-200">
            
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}" onclick="if(window.history.length > 1){ event.preventDefault(); window.history.back(); }" class="text-blue-600 text-sm font-medium mb-6 inline-flex items-center hover:underline">
                &larr; Volver
            </a>
            
            <h1 class="text-2xl font-bold text-slate-900 mb-1 tracking-tight">{{ ($producto->quantity ?? 0) <= 0 ? 'Reservar producto agotado' : 'Encargar producto' }}</h1>
            <p class="text-slate-500 text-sm mb-8">Te notificaremos sobre su disponibilidad</p>

            <!-- Resumen del Producto (Caja Gris) -->
            <div class="bg-slate-50 rounded-xl p-4 flex items-center gap-4 mb-8 border border-slate-200">
                <div class="w-16 h-16 bg-white rounded-lg border border-slate-200 flex items-center justify-center p-2 shrink-0">
                    <img src="{{ !empty($producto->image) ? (str_starts_with($producto->image, 'http') ? $producto->image : asset('storage/' . $producto->image)) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&q=80' }}" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&q=80';" class="max-w-full max-h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <h3 class="font-bold text-slate-900 text-sm leading-tight mb-1">{{ $producto->name ?? 'Producto' }}</h3>
                    @php
                        $negociosCatalogo = ['Distribuidora Alimentos Norte', 'Comercial San José', 'Agroindustria del Norte', 'Abastos Central Estelí', 'Mercadito El Sol', 'Importadora Las Segovias', 'Distribuidora La Favorita', 'Suplidora Nicaragüense'];
                        $supName = $inventario->supplier->name ?? $producto->supplier->name ?? '';
                        if (empty($supName) || strtolower($supName) === 'singki' || strtolower($supName) === 'wawastech') {
                            $supName = $negociosCatalogo[($producto->id ?? 1) % count($negociosCatalogo)];
                        }
                    @endphp
                    <p class="text-slate-500 text-xs mb-1">{{ $supName }}</p>
                    <p class="text-amber-600 font-bold text-sm">C$ {{ number_format($producto->cost ?? 0, 0) }}</p>
                </div>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ url('/producto/'.($producto->id ?? 999).'/reservar') }}" x-data="{
                cantidad: 1,
                precio: {{ $producto->cost ?? $producto->price ?? 0 }},
                showMap: false,
                mapSelected: false,
                lat: '',
                lng: ''
            }">
                @csrf
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-2">Cantidad</label>
                        <div class="flex items-center border border-slate-300 rounded-lg overflow-hidden">
                            <button type="button" @click="if(cantidad > 1) cantidad--" class="px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold border-r border-slate-300 transition-colors">-</button>
                            <input type="number" name="cantidad" x-model.number="cantidad" min="1" class="w-full text-center py-2 text-sm font-semibold text-slate-800 focus:outline-none appearance-none m-0 p-0 bg-white" style="-moz-appearance: textfield;">
                            <button type="button" @click="cantidad++" class="px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold border-l border-slate-300 transition-colors">+</button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-2">Presentación</label>
                        <!-- Selector bloqueado dinámico que sí envía el valor -->
                        <select name="unidad" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none transition-all bg-slate-100 font-semibold text-slate-600 pointer-events-none" tabindex="-1">
                            <option value="{{ $producto->presentation ?? 'Unidades' }}" selected>
                                {{ ucfirst($producto->presentation ?? 'Unidades') }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-500 mb-2">Dirección de entrega</label>
                    <input type="text" name="delivery_address" required placeholder="Escribe tu dirección exacta (barrio, calle, referencia)..." class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-blue-500 mb-3">
                    
                    <label class="block text-xs font-semibold text-slate-500 mb-2 mt-4">Ubicación de entrega (Mapa)</label>
                    <div @click="showMap = true; setTimeout(() => initMapPicker(), 300)" 
                         :class="mapSelected ? 'border-2 border-emerald-500 bg-emerald-50 text-emerald-700' : 'border border-slate-300 bg-white text-blue-600 hover:bg-blue-50'"
                         class="w-full rounded-lg px-4 py-3 text-center cursor-pointer transition-colors flex items-center justify-center gap-2">
                        
                        <!-- Ícono Dinámico -->
                        <template x-if="!mapSelected">
                            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"></path></svg>
                        </template>
                        <template x-if="mapSelected">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        </template>
                        
                        <span class="text-sm font-semibold truncate" x-text="mapSelected ? `✓ Ubicación agregada en el mapa (Lat: ${parseFloat(lat).toFixed(4)}, Lng: ${parseFloat(lng).toFixed(4)}) — Cambiar` : 'Fijar ubicación con el mapa'"></span>
                    </div>
                    <input type="hidden" name="latitude" id="latInput" />
                    <input type="hidden" name="longitude" id="lngInput" />
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-500 mb-2">Notas adicionales (opcional)</label>
                    <input type="text" name="notes" placeholder="Especificaciones, color, etc." class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all placeholder:text-slate-400">
                </div>

                <!-- Resumen en vivo -->
                <div class="bg-blue-50/50 rounded-xl p-4 mb-6 border border-blue-100 flex justify-between items-center">
                    <span class="text-slate-600 text-sm font-medium">Total aproximado:</span>
                    <span class="text-blue-700 text-xl font-black" x-text="'C$ ' + (cantidad * precio).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span>
                </div>
                
                <!-- Alerta de Notificación -->
                <div class="bg-slate-50 text-slate-600 text-[11px] p-3 rounded-lg flex gap-2 items-start mb-6 border border-slate-200">
                    <svg class="w-4 h-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="mt-0.5">El total exacto puede variar según el costo de envío que determine el vendedor.</p>
                </div>

                <!-- Botones -->
                <div class="flex gap-4 w-full">
                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}" onclick="if(window.history.length > 1){ event.preventDefault(); window.history.back(); }" class="flex-1 text-center py-3 rounded-xl border border-slate-300 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="flex-1 text-center py-3 rounded-xl bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold text-sm shadow-sm transition-colors">
                        Confirmar pedido
                    </button>
                </div>

                <!-- MODAL DE GOOGLE MAPS -->
                <div x-show="showMap" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60" style="display: none;" x-transition>
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 relative" @click.away="showMap = false">
                        
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-[#040116]">Selecciona tu ubicación</h3>
                            <button type="button" @click="showMap = false" class="text-gray-400 hover:text-gray-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <div id="mapPicker" class="w-full bg-gray-100 rounded-xl mb-4 border border-gray-200" style="height: 400px; display: block;"></div>
                        
                        <button type="button" @click="
                            lat = document.getElementById('latInput').value;
                            lng = document.getElementById('lngInput').value;
                            if(lat && lng) {
                                showMap = false; 
                                mapSelected = true; 
                                if(typeof window.showSingkiToast === 'function') window.showSingkiToast('✓ Ubicación confirmada', 'success');
                            } else {
                                alert('Por favor selecciona una ubicación en el mapa haciendo clic.');
                            }
                        " class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl transition-colors shadow-sm">
                            Confirmar ubicación
                        </button>
                    </div>
                </div>
            </form>

            <script>
                let map, pickerMarker;
                function mapaListo() { }
                function initMapPicker() {
                    const contenedor = document.getElementById('mapPicker');
                    if (!contenedor) return;
                    const esteli = { lat: 13.0918, lng: -86.3543 };
                    
                    if(!map) {
                        map = new google.maps.Map(contenedor, {
                            zoom: 14,
                            center: esteli,
                            mapTypeControl: false,
                            streetViewControl: false,
                        });

                        map.addListener('click', (e) => {
                            if (pickerMarker) pickerMarker.setMap(null);
                            
                            pickerMarker = new google.maps.Marker({
                                position: e.latLng,
                                map: map,
                                animation: google.maps.Animation.DROP
                            });
                            
                            document.getElementById('latInput').value = e.latLng.lat();
                            document.getElementById('lngInput').value = e.latLng.lng();
                        });
                    }

                    if(pickerMarker) pickerMarker.setMap(map);
                }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=mapaListo"></script>
            
        </div>
    </main>

    <!-- RESTAURACIÓN DEL FOOTER CLÁSICO COMPLETO -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @endif
    
</body>
</html>