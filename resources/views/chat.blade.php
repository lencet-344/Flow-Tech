<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistente Ki - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <style>
        .markdown-content p { margin-bottom: 0.5rem; }
        .markdown-content p:last-child { margin-bottom: 0; }
        .markdown-content ul { list-style-type: disc; padding-left: 1.25rem; margin-bottom: 0.5rem; }
        .markdown-content ol { list-style-type: decimal; padding-left: 1.25rem; margin-bottom: 0.5rem; }
        .markdown-content strong { font-weight: 700; }
    </style>
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
    <main class="flex-grow py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 flex flex-col h-[600px] md:h-[700px]">
                
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#2563eb] rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                            <img src="{{ asset('images/Robot.png') }}" alt="Ki" class="w-6 h-6 object-contain scale-110">
                        </div>
                        <h3 class="text-lg font-bold text-[#040116]">Asistente IA "Ki"</h3>
                    </div>
                    <span class="text-xs bg-purple-50 text-purple-600 px-3 py-1 rounded-full font-bold tracking-wide">Gemini IA</span>
                </div>

                <!-- Caja del Chat -->
                <div id="chat-box" class="flex-1 overflow-y-auto space-y-4 pr-2 mb-4">
                    <div class="flex gap-4 items-start">
                        <div class="w-8 h-8 bg-[#2563eb] rounded-lg flex items-center justify-center shrink-0 shadow-sm mt-1">
                            <img src="{{ asset('images/Robot.png') }}" alt="Ki" class="w-5 h-5 object-contain scale-110">
                        </div>
                        <div class="bg-slate-50 border border-slate-100 p-3.5 rounded-2xl rounded-tl-sm max-w-[80%]">
                            <p class="text-gray-700 text-[14px] leading-relaxed font-light">Hola, ¿en qué puedo ayudarte hoy con la gestión logística y comercial?</p>
                        </div>
                    </div>
                </div>

                <!-- Botones de Sugerencias Rápidas -->
                <div class="flex flex-wrap gap-2 mb-4 pt-4 border-t border-gray-100">
                    <span class="text-xs font-bold text-gray-400 self-center mr-1 uppercase tracking-wider">Sugerencias:</span>
                    <button type="button" onclick="sendQuickPrompt('¿Qué productos hay disponibles?')" class="text-[13px] bg-blue-50 text-[#2563eb] hover:bg-blue-100 px-3.5 py-1.5 rounded-full font-medium transition border border-blue-100">📦 Productos disponibles</button>
                    <button type="button" onclick="sendQuickPrompt('¿Qué categorias manejan?')" class="text-[13px] bg-blue-50 text-[#2563eb] hover:bg-blue-100 px-3.5 py-1.5 rounded-full font-medium transition border border-blue-100">📂 Categorías</button>
                    <button type="button" onclick="sendQuickPrompt('¿Cómo puedo registrar mi negocio como proveedor?')" class="text-[13px] bg-blue-50 text-[#2563eb] hover:bg-blue-100 px-3.5 py-1.5 rounded-full font-medium transition border border-blue-100">🏪 Registrar negocio</button>
                </div>

                <!-- Formulario de Envío -->
                <form id="chat-form" class="flex items-center gap-3 pt-2">
                    <input type="text" 
                           id="prompt" 
                           name="prompt"
                           placeholder="Escribe tu mensaje..." 
                           required
                           autocomplete="off"
                           class="flex-1 h-12 px-5 rounded-2xl border border-gray-200 bg-gray-50/50 text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#2563eb] focus:border-transparent transition-all">
                    
                    <button type="submit" 
                            class="h-12 px-6 bg-[#2563eb] hover:bg-blue-700 active:scale-95 text-white font-semibold text-sm rounded-2xl shadow-md shadow-blue-500/20 flex items-center justify-center gap-2 transition-all shrink-0 cursor-pointer">
                        <span>Enviar</span>
                        <svg class="w-4 h-4 transform rotate-45 -mt-0.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>

            </div>
        </div>
    </main>
    
    <script>
        const form = document.getElementById('chat-form');
        const chatBox = document.getElementById('chat-box');
        const input = document.getElementById('prompt');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function sendQuickPrompt(text) {
            input.value = text;
            form.dispatchEvent(new Event('submit'));
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = input.value.trim();
            if(!text) return;
            
            chatBox.innerHTML += `
                <div class="flex gap-4 items-start mb-6 flex-row-reverse">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center shrink-0 mt-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div class="bg-[#2563eb] text-white p-3.5 rounded-2xl rounded-tr-sm max-w-[80%]">
                        <p class="text-[14px] leading-relaxed font-light">${text}</p>
                    </div>
                </div>`;
            input.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;
            
            const loadingId = 'loading-' + Date.now();
            chatBox.innerHTML += `
                <div id="${loadingId}" class="flex gap-4 items-start mb-6">
                    <div class="w-8 h-8 bg-[#2563eb] rounded-lg flex items-center justify-center shrink-0 shadow-sm mt-1">
                        <img src="{{ asset('images/Robot.png') }}" alt="Ki" class="w-5 h-5 object-contain scale-110">
                    </div>
                    <div class="bg-slate-50 border border-slate-100 p-3.5 rounded-2xl rounded-tl-sm max-w-[80%] flex items-center gap-1 h-12">
                        <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-bounce"></div>
                        <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>`;
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                const res = await fetch('/chat/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ prompt: text })
                });

                const data = await res.json();
                document.getElementById(loadingId).remove();

                if (data.reply) {
                    const formattedReply = marked.parse(data.reply);
                    chatBox.innerHTML += `
                    <div class="flex gap-4 items-start mb-6">
                        <div class="w-8 h-8 bg-[#2563eb] rounded-lg flex items-center justify-center shrink-0 shadow-sm mt-1">
                            <img src="{{ asset('images/Robot.png') }}" alt="Ki" class="w-5 h-5 object-contain scale-110">
                        </div>
                        <div class="bg-slate-50 border border-slate-100 p-3.5 rounded-2xl rounded-tl-sm max-w-[80%]">
                            <div class="text-gray-700 text-[14px] leading-relaxed font-light markdown-content">${formattedReply}</div>
                        </div>
                    </div>`;
                } else {
                    const errorDetail = typeof data.error === 'object' ? JSON.stringify(data.error) : data.error;
                    chatBox.innerHTML += `
                    <div class="flex gap-4 items-start mb-6">
                        <div class="bg-red-100 text-red-700 p-3.5 rounded-2xl border border-red-300 max-w-[80%]">
                            <b>Error:</b> ${errorDetail || 'Sin respuesta'}
                        </div>
                    </div>`;
                }
            } catch (err) {
                document.getElementById(loadingId).remove();
                chatBox.innerHTML += `
                <div class="flex gap-4 items-start mb-6">
                    <div class="bg-red-100 text-red-600 p-3.5 rounded-2xl border border-red-200 max-w-[80%]">
                        Error de conexión con el servidor.
                    </div>
                </div>`;
            }
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    </script>
</body>
</html>