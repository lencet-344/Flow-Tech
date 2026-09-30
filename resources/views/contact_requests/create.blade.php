<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#f8fafc] font-sans antialiased text-[#040116] min-h-screen flex flex-col">

    <!-- Navegación Superior -->
    <nav class="bg-white border-b border-gray-100 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                <span class="font-black text-2xl text-[#2563eb] tracking-tighter">SINGKI</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-[#1F51FF] transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al inicio
            </a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="w-full max-w-2xl bg-white rounded-[24px] shadow-sm border border-gray-100 p-8 sm:p-10">
            
            <div class="text-center mb-10">
                <h1 class="text-3xl font-extrabold text-[#040116] tracking-tight mb-2">Estamos aquí para ayudarte</h1>
                <p class="text-gray-500 text-sm">Déjanos tus datos y el motivo de tu consulta. Te responderemos a la brevedad.</p>
            </div>

            <form action="{{ route('contact_requests.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-[13px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nombre completo *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors bg-gray-50/50" placeholder="Ej. Juan Pérez">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-[13px] font-bold text-gray-500 uppercase tracking-wider mb-2">Correo Electrónico *</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors bg-gray-50/50" placeholder="ejemplo@correo.com">
                        @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="telephone" class="block text-[13px] font-bold text-gray-500 uppercase tracking-wider mb-2">Teléfono *</label>
                        <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors bg-gray-50/50" placeholder="8888-0000">
                        @error('telephone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="location" class="block text-[13px] font-bold text-gray-500 uppercase tracking-wider mb-2">Ubicación</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors bg-gray-50/50" placeholder="Ciudad, País (Opcional)">
                        @error('location') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <label for="company_id" class="block text-[13px] font-bold text-gray-500 uppercase tracking-wider mb-2">Empresa / Negocio relacionado (Opcional)</label>
                    <select name="company_id" id="company_id" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm outline-none transition-colors bg-gray-50/50">
                        <option value="">Selecciona un negocio si tu consulta es sobre uno en particular...</option>
                        @foreach($companies as $item)
                            <option value="{{ $item->id }}" {{ old('company_id') == $item->id ? 'selected' : '' }}>{{ $item->name ?? $item->title ?? $item->id }}</option>
                        @endforeach
                    </select>
                    @error('company_id') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-[#1F51FF] hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl transition-colors shadow-md flex justify-center items-center gap-2">
                    Enviar solicitud
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>
    </main>

    <x-footer />

    <!-- SweetAlert2 Alertas -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            @if(session('success'))
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            @endif

            @if($errors->any())
                Toast.fire({
                    icon: "warning",
                    title: "Por favor revisa los campos en rojo."
                });
            @endif
        });
    </script>
</body>
</html>