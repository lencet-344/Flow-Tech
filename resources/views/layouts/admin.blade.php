<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body>
    <div class="flex h-screen overflow-hidden bg-[#F4F7FF] font-sans">
        
        <!-- Sidebar -->
        <aside class="w-[280px] bg-[#00003d] text-white flex flex-col shrink-0 h-full">
            
            <div class="flex-1 overflow-y-auto flex flex-col">
                <!-- Logo -->
                <div class="px-6 py-5 border-b border-gray-800">
                    <img src="{{ asset('images/LogoAzul.png') }}" alt="Logo Singki" class="h-10">
                    <p class="text-[#1F51FF] text-sm mt-2">Panel de Administración</p>
                </div>

                <!-- Perfil Dinámico -->
                <div class="px-6 py-5 border-b border-gray-800 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#1F51FF] flex items-center justify-center text-white font-bold uppercase overflow-hidden border border-blue-500">
                        @if(Auth::check() && file_exists(public_path('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg')))
                            <img src="{{ asset('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg') . '?v=' . filemtime(public_path('uploads/avatars/avatar_u' . Auth::id() . '_' . md5(strtolower(trim(Auth::user()->email))) . '.jpg')) }}" class="w-full h-full object-cover rounded-full">
                        @else
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-sm capitalize">{{ Auth::user()->name ?? 'Usuario' }}</p>
                        <p class="text-[#1F51FF] text-xs">
                            @if(Auth::user()->role === 'servicios')
                                Servicios
                            @elseif(in_array(Auth::user()->role, ['emprendedor', 'proveedor']))
                                Emprendedor
                            @else
                                Administrador
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Botón Ir al Inicio -->
                <div class="px-6 py-5">
                    <a href="{{ url('/') }}" class="block text-center w-full bg-[#A6F4EB] text-black py-2 rounded-xl font-medium text-sm">Ir al inicio</a>
                </div>

                <!-- Navegación MI NEGOCIO -->
                <div class="px-6 pb-2">
                    <p class="text-[#1F51FF] text-xs font-bold mb-3 uppercase">Mi Negocio</p>
                    <nav class="flex flex-col gap-1 text-sm">
                        <!-- Nota cómo el botón "Promocionar negocio" ahora verifica si estás en la ruta para pintarse de azul -->
                        <a href="{{ url('/admin/dashboard') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/dashboard') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Dashboard</a>
                        <a href="{{ url('/admin/perfil') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/perfil') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Perfil del negocio</a>
                        <a href="{{ route('inventories.index') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('inventories.*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Inventario</a>
                        <a href="{{ route('bookings.index') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('bookings.*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Reservas</a>
                        <a href="{{ route('offers.index') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('offers.*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Ofertas</a>
@if(in_array(auth()->user()->role, ['proveedor', 'servicios']))
    <a href="{{ url('/admin/comunidad') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/comunidad') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Comunidad Premium</a>
    <a href="{{ url('/admin/estadisticas') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/estadisticas') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Estadísticas</a>
@endif
                        <a href="{{ url('/admin/promocionar') }}" class="py-2 px-3 rounded-lg transition-colors {{ request()->is('admin/promocionar*') ? 'bg-[#2563eb] text-white font-medium shadow-sm' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">Promocionar negocio</a>
                    </nav>
                </div>

                <!-- Navegación INFORMACIÓN PÚBLICA -->
                <div class="px-6 py-4">
                    <p class="text-[#1F51FF] text-xs font-bold mb-3 uppercase">Información Pública</p>
                    <nav class="flex flex-col gap-1 text-sm text-gray-300">
                        <a href="{{ url('/admin/perfil') }}" class="py-2 px-3 hover:text-white rounded-lg transition-colors">Foto del negocio</a>
                        <a href="{{ route('inventories.index') }}" class="py-2 px-3 hover:text-white rounded-lg transition-colors">Disponibilidad/Stock</a>
                        <!-- Agregamos target="_blank" opcionalmente para que la vista pública abra en otra pestaña sin sacarlo del panel -->
                        <a href="{{ url('/perfil-publico') }}" target="_blank" class="py-2 px-3 hover:text-white rounded-lg transition-colors">Info pública</a>
                    </nav>
                </div>
            </div>

            <!-- Botón Atrás -->
            <div class="px-6 py-4 border-t border-gray-800 bg-[#00003d]">
                <a href="javascript:history.back()" class="flex items-center text-[#1F51FF] hover:text-blue-400 text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Atrás
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    
    @if(session('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Toast.fire({
                icon: 'warning',
                title: "{{ $errors->first() }}"
            });
        </script>
    @endif
@include('components.accessibility-widget')
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pendingReview = localStorage.getItem('singki_pending_review');
            if (pendingReview) {
                try {
                    const reviewData = JSON.parse(pendingReview);
                    
                    if (!reviewData.explicitlySubmitted || 
                        reviewData.rating < 1 || 
                        reviewData.rating > 5 || 
                        (Date.now() - reviewData.timestamp > 900000)) {
                        localStorage.removeItem('singki_pending_review');
                        return;
                    }

                    localStorage.removeItem('singki_pending_review');
                    
                    fetch("{{ route('resenas.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            rating: reviewData.rating,
                            comment: reviewData.comment
                        })
                    }).then(response => {
                        if(response.ok) {
                            document.body.insertAdjacentHTML('beforeend', `
                                <div class="fixed inset-0 z-[100] flex items-center justify-center bg-[#0f172a]/50 backdrop-blur-sm p-4 transition-opacity duration-300" id="singki-review-success-modal">
                                    <div class="bg-white max-w-md w-full rounded-[28px] shadow-2xl p-8 border border-gray-100 text-center transform transition-all duration-300">
                                        <div class="w-20 h-20 bg-[#a7f3d0]/60 rounded-full flex items-center justify-center mx-auto mb-5 shadow-sm">
                                            <div class="w-14 h-14 bg-[#10b981] rounded-full flex items-center justify-center text-white shadow-md">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <h3 class="text-2xl font-extrabold text-[#0f172a] mb-2">¡Reseña publicada con éxito!</h3>
                                        <p class="text-gray-500 text-sm mb-7 leading-relaxed">¡Gracias por compartir tu experiencia! Tu calificación ha sido guardada correctamente en SINGKI.</p>
                                        <button type="button" onclick="document.getElementById('singki-review-success-modal')?.remove()" class="w-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-3.5 px-6 rounded-xl shadow-md hover:shadow-lg transition text-sm cursor-pointer">
                                            ¡Entendido!
                                        </button>
                                    </div>
                                </div>
                            `);
                        }
                    }).catch(err => console.error('Error auto-guardando reseña:', err));
                } catch(e) {
                    localStorage.removeItem('singki_pending_review');
                }
            }
        });
    </script>
    @endauth
</body>
</html>