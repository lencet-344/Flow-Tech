<?php
$file = 'resources/views/welcome.blade.php';
$content = file_get_contents($file);

$searchRegex = '/<!-- Contenedor del Carrusel Falso \(Visual\) -->.*?<!-- Divisor sutil -->/is';

$replace = <<<'HTML'
<!-- Contenedor del Carrusel (Interactivo con Alpine.js) -->
        <div x-data="{ active: 1 }" class="relative w-full max-w-[1200px] mx-auto mb-16">
            <div class="flex flex-col md:flex-row justify-center items-center gap-6 lg:gap-10 relative">
                
                <!-- Tarjeta 0 (Izquierda - María) -->
                <div @click="active = 0" 
                     class="transition-all duration-500 ease-in-out transform cursor-pointer w-full md:w-[300px] lg:w-[320px] shrink-0 rounded-[32px] overflow-hidden"
                     :class="active === 0 ? 'scale-100 md:scale-110 z-20 bg-[#2563eb] shadow-[0_20px_50px_rgba(37,99,235,0.3)]' : 'scale-90 z-10 bg-blue-300 opacity-60 md:opacity-50 md:blur-[1px] hover:opacity-80 hover:blur-none hidden md:block'">
                    <div class="h-48 md:h-56 relative">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&q=80" 
                             class="w-full h-full object-cover transition-all duration-500"
                             :class="active === 0 ? 'grayscale-0' : 'grayscale'">
                        <div x-show="active === 0" x-transition.opacity class="absolute bottom-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider border border-white/10">Cliente</div>
                    </div>
                    <div class="p-6 md:p-8 text-left transition-all duration-500" :class="active === 0 ? 'text-white' : 'text-blue-50/80'">
                        <div class="text-yellow-400 text-sm md:text-lg mb-3 tracking-widest">★★★★★</div>
                        <p class="mb-4 font-light leading-relaxed text-[12px] md:text-[14px]" :class="active === 0 ? 'line-clamp-none' : 'line-clamp-3'">"Encontré exactamente lo que necesitaba en minutos. SINGKI me conectó con un proveedor confiable y el proceso fue súper sencillo."</p>
                        <div>
                            <p class="font-bold text-[13px] md:text-[15px]">María González</p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 1 (Centro - Carlos) -->
                <div @click="active = 1" 
                     class="transition-all duration-500 ease-in-out transform cursor-pointer w-full md:w-[300px] lg:w-[320px] shrink-0 rounded-[32px] overflow-hidden"
                     :class="active === 1 ? 'scale-100 md:scale-110 z-20 bg-[#2563eb] shadow-[0_20px_50px_rgba(37,99,235,0.3)]' : 'scale-90 z-10 bg-blue-300 opacity-60 md:opacity-50 md:blur-[1px] hover:opacity-80 hover:blur-none hidden md:block'">
                    <div class="h-48 md:h-56 relative">
                        <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?w=500&q=80" 
                             class="w-full h-full object-cover transition-all duration-500"
                             :class="active === 1 ? 'grayscale-0' : 'grayscale'">
                        <div x-show="active === 1" x-transition.opacity class="absolute bottom-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider border border-white/10">Emprendedor</div>
                    </div>
                    <div class="p-6 md:p-8 text-left transition-all duration-500" :class="active === 1 ? 'text-white' : 'text-blue-50/80'">
                        <div class="text-yellow-400 text-sm md:text-lg mb-3 tracking-widest">★★★★★</div>
                        <p class="mb-4 font-light leading-relaxed text-[12px] md:text-[14px]" :class="active === 1 ? 'line-clamp-none' : 'line-clamp-3'">"Registré mi negocio en SINGKI y en la primera semana ya tenía consultas reales. La plataforma le da visibilidad a mi emprendimiento."</p>
                        <div>
                            <p class="font-bold text-[13px] md:text-[15px]">Carlos Pérez</p>
                            <p class="text-[11px] md:text-[12px] text-blue-200 font-light mt-0.5">Estelí, Nicaragua</p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 2 (Derecha - Ana) -->
                <div @click="active = 2" 
                     class="transition-all duration-500 ease-in-out transform cursor-pointer w-full md:w-[300px] lg:w-[320px] shrink-0 rounded-[32px] overflow-hidden"
                     :class="active === 2 ? 'scale-100 md:scale-110 z-20 bg-[#2563eb] shadow-[0_20px_50px_rgba(37,99,235,0.3)]' : 'scale-90 z-10 bg-blue-300 opacity-60 md:opacity-50 md:blur-[1px] hover:opacity-80 hover:blur-none hidden md:block'">
                    <div class="h-48 md:h-56 relative">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80" 
                             class="w-full h-full object-cover transition-all duration-500"
                             :class="active === 2 ? 'grayscale-0' : 'grayscale'">
                        <div x-show="active === 2" x-transition.opacity class="absolute bottom-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider border border-white/10">Proveedora</div>
                    </div>
                    <div class="p-6 md:p-8 text-left transition-all duration-500" :class="active === 2 ? 'text-white' : 'text-blue-50/80'">
                        <div class="text-yellow-400 text-sm md:text-lg mb-3 tracking-widest">★★★★★</div>
                        <p class="mb-4 font-light leading-relaxed text-[12px] md:text-[14px]" :class="active === 2 ? 'line-clamp-none' : 'line-clamp-3'">"El panel de administración es muy completo. Puedo gestionar mi inventario, ver reservas y chatear con los clientes fácilmente."</p>
                        <div>
                            <p class="font-bold text-[13px] md:text-[15px]">Ana Rodríguez</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles del Carrusel (Flechas y Puntos) -->
            <div class="flex items-center justify-center gap-6 mt-16 md:mt-12">
                <!-- Flecha Izquierda -->
                <button @click="active = active === 0 ? 2 : active - 1" class="w-10 h-10 rounded-full border-2 border-[#3b82f6] flex items-center justify-center text-[#3b82f6] hover:bg-[#3b82f6] hover:text-white transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <!-- Puntos de navegación -->
                <div class="flex items-center gap-2.5">
                    <button @click="active = 0" :class="active === 0 ? 'w-6 bg-[#2563eb]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
                    <button @click="active = 1" :class="active === 1 ? 'w-6 bg-[#2563eb]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
                    <button @click="active = 2" :class="active === 2 ? 'w-6 bg-[#2563eb]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
                </div>
                
                <!-- Flecha Derecha -->
                <button @click="active = active === 2 ? 0 : active + 1" class="w-10 h-10 rounded-full border-2 border-[#3b82f6] flex items-center justify-center text-[#3b82f6] hover:bg-[#3b82f6] hover:text-white transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <!-- Divisor sutil -->
HTML;

$content = preg_replace($searchRegex, $replace, $content);
file_put_contents($file, $content);
echo "Carousel injected.\n";
?>
