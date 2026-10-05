<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F4F7FF] min-h-screen flex flex-col font-sans">
    
    <!-- HEADER -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="flex items-center gap-2 select-none cursor-pointer" onclick="window.location.href='{{ url('/') }}'">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </div>
        <div class="flex items-center gap-4">
            <button onclick="if(window.history.length > 1) { window.history.back(); } else { window.location.href='{{ url('/') }}'; }" class="text-sm font-bold text-gray-500 hover:text-[#1F51FF] transition flex items-center gap-2 px-4 py-2 bg-gray-50 hover:bg-blue-50 rounded-full">
                ← Regresar
            </button>
            <a href="{{ url('/') }}" class="text-sm font-bold text-gray-500 hover:text-[#1F51FF] transition">Inicio</a>
            @auth
            <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#1F51FF] to-[#0a194f] text-white flex items-center justify-center font-bold shadow-md hover:opacity-90 transition">
                {{ substr(auth()->user()->name, 0, 1) }}
            </a>
            @endauth
        </div>
    </header>

    @php
        $slugSearch = \Illuminate\Support\Str::slug($company->name ?? request('negocio', ''));
        $idSearch = $company->id ?? null;
        $bannerMatches = array_merge(
            $idSearch ? (glob(public_path('images/banners/company_' . $idSearch . '.*')) ?: []) : [],
            $slugSearch ? (glob(public_path('images/banners/negocio_' . $slugSearch . '.*')) ?: []) : []
        );
        $bannerUrl = !empty($bannerMatches) ? asset('images/banners/' . basename($bannerMatches[0])) . '?v=' . filemtime($bannerMatches[0]) : null;
        $logoUrl = (!empty($company->logo) && file_exists(public_path('storage/' . $company->logo))) ? asset('storage/' . $company->logo) : null;
    @endphp

    <div class="max-w-6xl mx-auto w-full flex-1 flex flex-col md:flex-row my-6 gap-6 px-4">
        
        <!-- COLUMNA IZQUIERDA: Tarjeta del negocio -->
        <div class="w-full md:w-1/3 bg-white rounded-[24px] overflow-hidden shadow-sm border border-gray-100 h-fit sticky top-24 flex flex-col">
            <!-- Banner -->
            <div class="h-32 w-full relative bg-gradient-to-r from-[#0a194f] via-[#163080] to-[#1F51FF]">
                @if($bannerUrl)
                    <img src="{{ $bannerUrl }}" alt="Banner de {{ $company->name }}" class="w-full h-full object-cover object-center">
                @endif
                <!-- Foto/Logo -->
                <div class="absolute -bottom-8 left-6 w-16 h-16 rounded-2xl bg-white p-1 shadow-md z-10 border border-white">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" class="w-full h-full object-cover rounded-xl" alt="Logo">
                    @else
                        <div class="w-full h-full rounded-xl bg-gradient-to-tr from-[#1F51FF] to-[#0a194f] text-white flex items-center justify-center text-xl font-bold">
                            {{ strtoupper(substr($company->name ?? 'NA', 0, 2)) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-6 pt-10 flex-1 flex flex-col">
                <div class="flex items-center gap-2 mb-1">
                    <h2 class="text-xl font-extrabold text-[#0f172a] truncate">{{ $company->name }}</h2>
                    <span class="flex items-center justify-center w-5 h-5 bg-green-500 rounded-full text-white shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </span>
                </div>
                
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-blue-50 text-[#1F51FF] text-xs font-bold rounded-full uppercase tracking-wider">
                        {{ $company->category->name ?? 'Tecnología' }}
                    </span>
                </div>

                <p class="text-sm text-gray-500 font-medium mb-5 line-clamp-3">
                    {{ $company->description ?? 'Sin descripción disponible.' }}
                </p>
                
                <div class="space-y-3.5 text-sm text-gray-600 font-medium pb-6 border-b border-gray-100">
                    <div class="flex items-start gap-3">
                        <span class="text-[#1F51FF] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>
                        <span class="leading-snug">{{ $company->address ?? 'Ubicación no especificada' }}</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-[#1F51FF] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></span>
                        <span class="leading-snug">{{ $company->telephone ?? 'No disponible' }}</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-[#1F51FF] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                        <span class="leading-snug">{{ $company->email ?? 'Correo no disponible' }}</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-[#1F51FF] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                        <span class="leading-snug">{{ $company->horario ?? 'Horario no especificado' }}</span>
                    </div>
                </div>

                <a href="{{ url('/perfil-publico?negocio=' . urlencode($company->name)) }}" class="mt-5 text-sm font-bold text-gray-500 hover:text-[#1F51FF] transition flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-50 rounded-xl hover:bg-blue-50">
                    ← Volver al perfil público
                </a>
            </div>
        </div>

        <!-- COLUMNA DERECHA: AREA DE CHAT -->
        <div class="w-full md:w-2/3 bg-white rounded-[24px] shadow-sm border border-gray-100 flex flex-col overflow-hidden h-[calc(100vh-140px)]">
            
            <!-- Chat Header -->
            <div class="bg-white border-b border-gray-100 p-4 px-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#1F51FF] to-[#0a194f] flex-shrink-0 flex items-center justify-center text-white shadow-md">
                        <span class="text-sm font-black">{{ strtoupper(substr($company->name ?? 'NA', 0, 2)) }}</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $company->name }}</h3>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-xs font-bold text-green-600 tracking-wide">EN LÍNEA</span>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/perfil-publico?negocio=' . urlencode($company->name)) }}" class="hidden sm:flex text-sm font-bold text-[#1F51FF] hover:text-blue-700 transition items-center gap-1">
                    Ver perfil &rarr;
                </a>
            </div>

            <!-- Messages Area -->
            <div id="chat-messages-box" class="flex-1 overflow-y-auto p-6 bg-[#F8FAFC] space-y-4 no-scrollbar">
                <!-- Se inyectarán los mensajes aquí con JS -->
            </div>

            <!-- Input Area -->
            <div class="p-4 bg-white border-t border-gray-100">
                <form id="singki-chat-form" onsubmit="enviarMensajeChat(event)" class="flex items-end gap-3 relative max-w-4xl mx-auto">
                    <div class="flex-1 bg-gray-50 border border-gray-200 rounded-full px-5 py-2.5 flex items-center focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-100 focus-within:border-[#1F51FF] transition-all shadow-sm">
                        <input type="text" id="singki-chat-input" placeholder="Escribe un mensaje..." class="w-full bg-transparent border-none focus:ring-0 text-sm font-medium text-gray-700 py-1 px-0" autocomplete="off">
                    </div>
                    <button type="submit" class="w-12 h-12 bg-[#1F51FF] text-white rounded-full flex items-center justify-center flex-shrink-0 transition-transform hover:scale-105 shadow-md shadow-blue-500/30">
                        <svg class="w-5 h-5 translate-x-px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- SCRIPT CHAT (Vanilla JS) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companyId = '{{ $company->id ?? request("negocio") }}';
            const companyName = '{{ $company->name ?? request("negocio") }}';
            const chatBox = document.getElementById('chat-messages-box');
            
            const storageKey = 'singki_chat_msgs_' + companyId;
            let messages = JSON.parse(localStorage.getItem(storageKey)) || [];

            function renderMessages() {
                chatBox.innerHTML = '';
                
                // Mensaje Inicial del Sistema
                const sysBubble = document.createElement('div');
                sysBubble.className = 'flex gap-3 max-w-[85%]';
                sysBubble.innerHTML = `
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#1F51FF] to-[#0a194f] flex-shrink-0 flex items-center justify-center text-white shadow-sm">
                        <span class="text-xs font-black">${companyName.substring(0, 1).toUpperCase()}</span>
                    </div>
                    <div class="flex flex-col items-start gap-1">
                        <div class="px-5 py-3.5 bg-white border border-gray-100 text-gray-700 text-sm font-medium rounded-2xl rounded-tl-sm shadow-sm">
                            ¡Hola! Bienvenido al chat de ${companyName}. ¿En qué podemos ayudarte hoy?
                        </div>
                    </div>
                `;
                chatBox.appendChild(sysBubble);

                // Mensajes de usuario
                messages.forEach(msg => {
                    const userBubble = document.createElement('div');
                    userBubble.className = 'flex gap-3 max-w-[85%] ml-auto justify-end';
                    userBubble.innerHTML = `
                        <div class="flex flex-col items-end gap-1">
                            <div class="bg-[#1F51FF] text-white px-5 py-3 rounded-2xl rounded-br-sm text-sm shadow-sm">
                                ${msg.text}
                            </div>
                            <span class="text-[10px] font-bold text-gray-400 px-1">${msg.time}</span>
                        </div>
                    `;
                    chatBox.appendChild(userBubble);
                });

                chatBox.scrollTop = chatBox.scrollHeight;
            }

            renderMessages();

            window.enviarMensajeChat = function(e) {
                e.preventDefault();
                const input = document.getElementById('singki-chat-input');
                const text = input.value.trim();
                
                if (text === '') return;

                const now = new Date();
                const timeStr = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

                messages.push({
                    text: text,
                    time: timeStr
                });

                localStorage.setItem(storageKey, JSON.stringify(messages));
                input.value = '';
                renderMessages();
            };
        });
    </script>
</body>
</html>
