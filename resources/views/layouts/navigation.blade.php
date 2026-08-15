<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                        {{ __('Proveedores') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.*')">
                        {{ __('Empresas') }}
                    </x-nav-link>

                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        {{ __('Productos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        {{ __('Categorías') }}
                    </x-nav-link>

                    <x-nav-link :href="route('buy_verifications.index')" :active="request()->routeIs('buy_verifications.*')">
                        {{ __('Verificaciones de Compra') }}
                    </x-nav-link>

                    <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                        {{ __('Pedidos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('trades.index')" :active="request()->routeIs('trades.*')">
                        {{ __('Trades') }}
                    </x-nav-link>

                    <x-nav-link :href="route('brands.index')" :active="request()->routeIs('brands.*')">
                        {{ __('Marcas') }}
                    </x-nav-link>

                    <x-nav-link :href="route('favorites.index')" :active="request()->routeIs('favorites.*')">
                        {{ __('Favoritos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                        {{ __('Reservas') }}
                    </x-nav-link>

                    <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
                        {{ __('Roles') }}
                    </x-nav-link>

                    <x-nav-link :href="route('inventories.index')" :active="request()->routeIs('inventories.*')">
                        {{ __('Inventario') }}
                    </x-nav-link>

                    <x-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.*')">
                        {{ __('Ofertas') }}
                    </x-nav-link>

                    <x-nav-link :href="route('contact_requests.index')" :active="request()->routeIs('contact_requests.*')">
                        {{ __('Solicitudes de Contacto') }}
                    </x-nav-link>


                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            
                            <img class="h-9 w-9 rounded-full object-cover mr-3 border border-gray-200 dark:border-gray-700" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=4f46e5&background=e0e7ff" alt="Avatar" />
                            
                            <div class="flex flex-col items-start mr-1">
                                <span class="font-bold text-gray-800 dark:text-gray-200 leading-tight">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 leading-tight">{{ Auth::user()->email }}</span>
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ __('Perfil') }}
                            </div>
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}" id="form-logout-desktop">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); confirmarCierreSesion('form-logout-desktop');">
                                <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ __('Cerrar Sesión') }}
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                {{ __('Proveedores') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.*')">
                {{ __('Empresas') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                {{ __('Productos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                {{ __('Categorías') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('buy_verifications.index')" :active="request()->routeIs('buy_verifications.*')">
                {{ __('Verificaciones de Compra') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                {{ __('Órdenes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('trades.index')" :active="request()->routeIs('trades.*')">
                {{ __('Comercios') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('brands.index')" :active="request()->routeIs('brands.*')">
                {{ __('Marcas') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('favorites.index')" :active="request()->routeIs('favorites.*')">
                {{ __('Favoritos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                {{ __('Reservas') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
                {{ __('Roles') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('inventories.index')" :active="request()->routeIs('inventories.*')">
                {{ __('Inventario') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.*')">
                {{ __('Ofertas') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('contact_requests.index')" :active="request()->routeIs('contact_requests.*')">
                {{ __('Solicitudes de Contacto') }}
            </x-responsive-nav-link>

        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex items-center mb-3">
                <img class="h-10 w-10 rounded-full object-cover mr-3 border border-gray-200 dark:border-gray-700" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=4f46e5&background=e0e7ff" alt="Avatar" />
                <div>
                    <div class="font-bold text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ __('Perfil') }}
                    </div>
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}" id="form-logout-mobile">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); confirmarCierreSesion('form-logout-mobile');">
                        <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            {{ __('Cerrar Sesión') }}
                        </div>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function confirmarCierreSesion(formId) {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: "¿Está seguro que desea salir del sistema?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar',
            background: '#1e293b',
            color: '#ffffff',
            customClass: {
                popup: 'rounded-2xl border border-gray-700'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        })
    }
</script>