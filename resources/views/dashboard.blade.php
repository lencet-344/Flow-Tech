<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
            {{ __('Singky') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-8 relative">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-indigo-500 opacity-10 rounded-full blur-3xl"></div>
                <div class="flex items-center gap-6 relative z-10">
                    <div class="flex-shrink-0 w-16 h-16 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center border border-indigo-200 dark:border-indigo-800/50">
                        <span class="text-3xl">👋</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                            ¡Bienvenido al sistema, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Gestiona de manera centralizada el inventario, los pedidos y la comunicación de la sucursal con toda la red de proveedores.
                        </p>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                
                <a href="{{ route('bookings.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-teal-500/50 dark:hover:border-teal-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-teal-600 dark:group-hover:text-teal-400">Reservas</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Agenda entregas y descargas de mercancía.</p>
                            </div>
                            <div class="p-2 bg-teal-50 dark:bg-teal-900/30 rounded-lg text-teal-600 dark:text-teal-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('brands.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-indigo-500/50 dark:hover:border-indigo-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Marcas</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Registro comercial de productos ofrecidos.</p>
                            </div>
                            <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('buy-verifications.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-red-500/50 dark:hover:border-red-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-red-600 dark:group-hover:text-red-400">Verificaciones</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Auditoría y validación de compras a proveedores.</p>
                            </div>
                            <div class="p-2 bg-red-50 dark:bg-red-900/30 rounded-lg text-red-600 dark:text-red-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('categories.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-emerald-500/50 dark:hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Categorías</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Estructuración y familia de productos.</p>
                            </div>
                            <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('companies.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-blue-500/50 dark:hover:border-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400">Empresas</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Gestión de la sucursal y redes empresariales.</p>
                            </div>
                            <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('contact-requests.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-pink-500/50 dark:hover:border-pink-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-pink-600 dark:group-hover:text-pink-400">Contacto</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Buzón de mensajería y requerimientos B2B.</p>
                            </div>
                            <div class="p-2 bg-pink-50 dark:bg-pink-900/30 rounded-lg text-pink-600 dark:text-pink-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('favorites.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-yellow-500/50 dark:hover:border-yellow-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-yellow-500 dark:group-hover:text-yellow-400">Favoritos</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Lista de proveedores o productos recurrentes.</p>
                            </div>
                            <div class="p-2 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg text-yellow-600 dark:text-yellow-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('inventories.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-amber-500/50 dark:hover:border-amber-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-amber-600 dark:group-hover:text-amber-400">Inventarios</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Supervisa las existencias y lotes locales.</p>
                            </div>
                            <div class="p-2 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('offers.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-orange-500/50 dark:hover:border-orange-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-orange-600 dark:group-hover:text-orange-400">Ofertas</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Descuentos y promociones de proveedores.</p>
                            </div>
                            <div class="p-2 bg-orange-50 dark:bg-orange-900/30 rounded-lg text-orange-600 dark:text-orange-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('orders.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-green-500/50 dark:hover:border-green-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-green-600 dark:group-hover:text-green-400">Pedidos</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Órdenes de compra del supermercado.</p>
                            </div>
                            <div class="p-2 bg-green-50 dark:bg-green-900/30 rounded-lg text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- 11. Productos (ProductController) -->
                <a href="{{ route('products.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-sky-500/50 dark:hover:border-sky-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-sky-600 dark:group-hover:text-sky-400">Productos</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Directorio de artículos ofertados.</p>
                            </div>
                            <div class="p-2 bg-sky-50 dark:bg-sky-900/30 rounded-lg text-sky-600 dark:text-sky-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- 12. Perfil (ProfileController) -->
                <a href="{{ route('profile.edit') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-gray-500/50 dark:hover:border-gray-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-gray-600 dark:group-hover:text-gray-400">Mi Perfil</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Ajustes personales y de cuenta.</p>
                            </div>
                            <div class="p-2 bg-gray-100 dark:bg-gray-900/50 rounded-lg text-gray-600 dark:text-gray-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('roles.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-cyan-500/50 dark:hover:border-cyan-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-cyan-600 dark:group-hover:text-cyan-400">Roles y Permisos</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Control de seguridad y accesos a la plataforma.</p>
                            </div>
                            <div class="p-2 bg-cyan-50 dark:bg-cyan-900/30 rounded-lg text-cyan-600 dark:text-cyan-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('suppliers.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-purple-500/50 dark:hover:border-purple-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-purple-600 dark:group-hover:text-purple-400">Proveedores</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Base de datos de distribuidores registrados.</p>
                            </div>
                            <div class="p-2 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600 dark:text-purple-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

                
                <a href="{{ route('trades.index') }}" class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-lime-500/50 dark:hover:border-lime-500/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-lime-600 dark:group-hover:text-lime-400">Transacciones</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Acuerdos o intercambios comerciales B2B.</p>
                            </div>
                            <div class="p-2 bg-lime-50 dark:bg-lime-900/30 rounded-lg text-lime-600 dark:text-lime-400 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>