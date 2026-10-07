@extends('layouts.empty')

@php
$userAvatarKey = auth()->check()
    ? 'avatar_u' . auth()->id() . '_' . md5(strtolower(trim(auth()->user()->email)))
    : null;
$userAvatarRelPath = $userAvatarKey ? 'uploads/avatars/' . $userAvatarKey . '.jpg' : null;
$userAvatarUrl = ($userAvatarRelPath && file_exists(public_path($userAvatarRelPath)))
    ? asset($userAvatarRelPath) . '?v=' . filemtime(public_path($userAvatarRelPath))
    : null;
@endphp

@section('content')
<div class="bg-[#F4F7FF] font-sans min-h-screen pb-12">

    <!-- Header Superior -->
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2 select-none cursor-default">
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="SINGKI" class="h-8 w-auto">
                <span class="font-black text-2xl text-[#1F51FF] tracking-tighter">SINGKI</span>
            </div>
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-[#1F51FF] font-medium transition-colors">
                &larr; Regresar al inicio
            </a>
        </div>
    </header>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

        <!-- Cabecera de Resumen del Usuario -->
        <div class="rounded-3xl bg-white p-8 shadow-sm border border-gray-100 mb-8 flex flex-col md:flex-row items-center gap-6">
            <label for="avatar_upload" class="relative group cursor-pointer w-24 h-24 rounded-full bg-[#1F51FF] text-white flex items-center justify-center text-4xl font-bold shrink-0 overflow-hidden shadow-sm border-2 border-white">
                @if($userAvatarUrl)
                    <img id="avatar-preview-img" src="{{ $userAvatarUrl }}" class="w-full h-full object-cover rounded-full">
                    <span id="avatar-preview-initial" class="hidden">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @else
                    <img id="avatar-preview-img" class="w-full h-full object-cover rounded-full hidden">
                    <span id="avatar-preview-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white text-[10px] font-bold rounded-full">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Cambiar
                </div>
            </label>
            <div class="text-center md:text-left flex-1">
                <h1 class="text-2xl font-bold text-[#040116]">{{ $user->name }}</h1>
                <p class="text-gray-500 mt-1">{{ $user->email }}</p>
                
                <div class="mt-4 flex flex-wrap gap-2 justify-center md:justify-start">
                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider rounded-full">
                        {{ $user->role ?? 'Usuario' }}
                    </span>
                    
                    @if(in_array($user->role, ['usuario', 'cliente']))
                        <a href="{{ route('favorites.index') }}" class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-bold uppercase tracking-wider rounded-full transition-colors">
                            Mis Favoritos
                        </a>
                        <a href="{{ route('bookings.index') }}" class="px-3 py-1 bg-blue-50 text-[#1F51FF] hover:bg-blue-100 text-xs font-bold uppercase tracking-wider rounded-full transition-colors">
                            Mis Reservas
                        </a>
                    @endif
                </div>
                <div class="mt-4">
                    <label for="avatar_upload" class="text-[#1F51FF] hover:underline text-xs font-bold cursor-pointer inline-flex items-center gap-1 bg-blue-50 px-3 py-1.5 rounded-full transition-colors hover:bg-blue-100">
                        📷 Cambiar foto de perfil
                    </label>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 1: Información Personal -->
        <div class="rounded-3xl bg-white p-8 shadow-sm border border-gray-100 mb-8">
            <h2 class="text-lg font-bold text-[#040116] mb-1">Información Personal</h2>
            <p class="text-sm text-gray-500 mb-6">Actualiza el nombre visible de tu cuenta.</p>
            
            @if (session('status') === 'profile-updated' || session('profile_updated_msg'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-semibold flex items-center gap-2.5">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    ¡Información personal actualizada correctamente!
                </div>
            @endif

            <form method="post" action="{{ route('profile.update') }}" class="space-y-5" enctype="multipart/form-data">
                @csrf
                @method('patch')
                
                <input type="file" id="avatar_upload" name="avatar" accept="image/*" class="hidden" onchange="
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('avatar-preview-img').src = e.target.result;
                            document.getElementById('avatar-preview-img').classList.remove('hidden');
                            document.getElementById('avatar-preview-initial').classList.add('hidden');
                        }
                        reader.readAsDataURL(file);

                        const formData = new FormData();
                        formData.append('avatar', file);

                        fetch('{{ url('/profile/avatar') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                document.getElementById('avatar-preview-img').src = data.avatar_url;
                                const msgEl = document.getElementById('avatar-preview-msg');
                                msgEl.innerHTML = '<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'></path></svg> ✓ Foto de perfil guardada correctamente';
                                msgEl.classList.remove('hidden');
                            }
                        });
                    }
                ">
                
                <p id="avatar-preview-msg" class="hidden text-[12px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-3 py-2 mt-2 inline-flex items-center gap-1.5">
                </p>

                <div>
                    <label for="name" class="block text-[13px] font-medium text-[#040116] mb-2">Nombre completo</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm text-[#040116] outline-none transition-colors">
                    @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-[13px] font-medium text-[#040116] mb-2">Correo electrónico</label>
                    <div class="relative">
                        <input type="email" id="email" value="{{ $user->email }}" disabled readonly
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 bg-gray-100 text-gray-500 cursor-not-allowed select-none focus:ring-0 focus:border-gray-200 text-sm outline-none transition-colors">
                        <div class="absolute inset-y-0 right-4 flex items-center px-1 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">El correo electrónico está vinculado a la seguridad de tu cuenta y no puede modificarse.</p>
                    <input type="hidden" name="email" value="{{ $user->email }}">
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm text-sm">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>

        <!-- SECCIÓN 2: Seguridad y Contraseña -->
        <div class="rounded-3xl bg-white p-8 shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-[#040116] mb-1">Seguridad y Contraseña</h2>
            <p class="text-sm text-gray-500 mb-6">Asegúrate de usar una contraseña larga y segura para mantener tu cuenta protegida.</p>

            @if (session('status') === 'password-updated')
                <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-xl text-green-600 text-sm font-medium">
                    Contraseña actualizada correctamente.
                </div>
            @endif

            <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-[13px] font-medium text-[#040116] mb-2">Contraseña actual</label>
                    <div class="relative">
                        <input type="password" id="update_password_current_password" name="current_password" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 bg-white focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm text-[#040116] outline-none transition-colors font-mono tracking-widest" style="padding-right: 48px;">
                        <button type="button" tabindex="-1" class="absolute inset-y-0 right-4 flex items-center px-1 text-gray-400 hover:text-[#1F51FF] focus:outline-none transition-colors" style="right: 16px;" onclick="const input = this.previousElementSibling; const eyeOpen = this.querySelector('.eye-open'); const eyeClosed = this.querySelector('.eye-closed'); if (input.type === 'password') { input.type = 'text'; eyeOpen.classList.add('hidden'); eyeClosed.classList.remove('hidden'); } else { input.type = 'password'; eyeOpen.classList.remove('hidden'); eyeClosed.classList.add('hidden'); }">
                            <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                    @error('current_password', 'updatePassword') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="update_password_password" class="block text-[13px] font-medium text-[#040116] mb-2">Nueva contraseña</label>
                    <div class="relative">
                        <input type="password" id="update_password_password" name="password" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 bg-white focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm text-[#040116] outline-none transition-colors font-mono tracking-widest" style="padding-right: 48px;">
                        <button type="button" tabindex="-1" class="absolute inset-y-0 right-4 flex items-center px-1 text-gray-400 hover:text-[#1F51FF] focus:outline-none transition-colors" style="right: 16px;" onclick="const input = this.previousElementSibling; const eyeOpen = this.querySelector('.eye-open'); const eyeClosed = this.querySelector('.eye-closed'); if (input.type === 'password') { input.type = 'text'; eyeOpen.classList.add('hidden'); eyeClosed.classList.remove('hidden'); } else { input.type = 'password'; eyeOpen.classList.remove('hidden'); eyeClosed.classList.add('hidden'); }">
                            <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                    @error('password', 'updatePassword') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-[13px] font-medium text-[#040116] mb-2">Confirmar nueva contraseña</label>
                    <div class="relative">
                        <input type="password" id="update_password_password_confirmation" name="password_confirmation" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 bg-white focus:ring-[#1F51FF] focus:border-[#1F51FF] text-sm text-[#040116] outline-none transition-colors font-mono tracking-widest" style="padding-right: 48px;">
                        <button type="button" tabindex="-1" class="absolute inset-y-0 right-4 flex items-center px-1 text-gray-400 hover:text-[#1F51FF] focus:outline-none transition-colors" style="right: 16px;" onclick="const input = this.previousElementSibling; const eyeOpen = this.querySelector('.eye-open'); const eyeClosed = this.querySelector('.eye-closed'); if (input.type === 'password') { input.type = 'text'; eyeOpen.classList.add('hidden'); eyeClosed.classList.remove('hidden'); } else { input.type = 'password'; eyeOpen.classList.remove('hidden'); eyeClosed.classList.add('hidden'); }">
                            <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                    @error('password_confirmation', 'updatePassword') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm text-sm">
                        Actualizar contraseña
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
