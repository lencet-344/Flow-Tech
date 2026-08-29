<footer class="bg-[#00003d] pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                    
                    <!-- Columna de Logo -->
                    <div class="md:col-span-4">
                        <div class="mb-6">
                            <!-- Tu logo intacto, ahora sí se camuflará perfectamente con el fondo -->
                            <img src="{{ asset('images/LogoAzul.png') }}" alt="SINGKI" class="h-10 w-auto">
                        </div>
                        
                        <!-- Botón Cerrar Sesión (Solo visible si hay sesión) -->
                        @auth
                            <div class="mt-8">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="bg-[#A6F4EB] hover:bg-[#7ce2d6] text-[#020617] font-semibold px-6 py-2 rounded-full text-sm transition-colors shadow-sm">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>

                    <!-- Columnas de Enlaces -->
                    <div class="md:col-span-2">
                        <h4 class="text-[#7dd3fc] font-bold mb-6 text-[15px] tracking-wide">Plataforma</h4>
                        <ul class="space-y-4 text-[14px] text-[#cbd5e1] font-light">
                            <li><a href="#" class="hover:text-white transition">Categorías</a></li>
                            <li><a href="#" class="hover:text-white transition">Explorar negocios</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white transition">Iniciar sesión</a></li>
                        </ul>
                    </div>
                    
                    <div class="md:col-span-3">
                        <h4 class="text-[#7dd3fc] font-bold mb-6 text-[15px] tracking-wide">Para negocios</h4>
                        <ul class="space-y-4 text-[14px] text-[#cbd5e1] font-light">
                            <li><a href="{{ route('register') }}" class="hover:text-white transition">Registrar mi negocio</a></li>
                            <li><a href="#" class="hover:text-white transition">Administración</a></li>
                        </ul>
                    </div>
                    
                    <div class="md:col-span-3">
                        <h4 class="text-[#7dd3fc] font-bold mb-6 text-[15px] tracking-wide">Ayuda</h4>
                        <ul class="space-y-4 text-[14px] text-[#cbd5e1] font-light">
                            <li><a href="#" class="hover:text-white transition">Centro de ayuda</a></li>
                            <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                            <li><a href="#" class="hover:text-white transition">Términos de uso</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Barra Inferior de Copyright y Redes -->
                <div class="border-t border-[#7dd3fc]/20 pt-8 flex flex-col md:flex-row justify-between items-center text-[13px] text-[#cbd5e1] font-light">
                    <p class="mb-6 md:mb-0">© 2026 SINGKI. Todos los derechos reservados.</p>
                    
                    <div class="flex items-center gap-6">
                        <span class="hidden sm:inline-block mr-2">Encuéntranos en</span>
                        
                        <!-- Youtube (Ajustado al azul celeste #7dd3fc) -->
                        <a href="#" class="text-[#7dd3fc] hover:text-white transition flex items-center gap-2 group">
                            <svg class="w-5 h-5 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 29 29 0 00-.46-5.33z"></path><polygon stroke-width="1.5" stroke-linejoin="round" points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                            Youtube
                        </a>
                        
                        <!-- Instagram (Ajustado al azul celeste #7dd3fc) -->
                        <a href="#" class="text-[#7dd3fc] hover:text-white transition flex items-center gap-2 group">
                            <svg class="w-5 h-5 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            Instagram
                        </a>

                        <!-- TikTok (Ajustado al azul celeste #7dd3fc) -->
                        <a href="#" class="text-[#7dd3fc] hover:text-white transition flex items-center gap-2 group">
                            <svg class="w-5 h-5 transition" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M15 2a3 3 0 0 1 3 3 3 3 0 0 0 3 3v2a5 5 0 0 1-5-5V2h-3v14a4 4 0 1 1-4-4 4.04 4.04 0 0 1 1 .13V8.42A6 6 0 0 0 8 8a6 6 0 1 0 6 6V2Z"></path>
                            </svg>
                            TikTok
                        </a>
                    </div>
                </div>
            </div>
        </footer>
