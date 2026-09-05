<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Asistente Ki - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- Librería Marked.js para interpretar formato Markdown (Negritas, viñetas, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.js"></script>
</head>
<body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Reciclado -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#1F51FF] tracking-tighter">SINGKI</span>
        </a>
        
        <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
            <a href="{{ url('/') }}" class="hover:text-[#1F51FF] transition">Inicio</a>
            <a href="{{ url('/#categorias') }}" class="hover:text-[#1F51FF] transition">Categorías</a>
            <a href="{{ route('explorar.index') }}" class="hover:text-[#1F51FF] transition">Explorar</a>
        </nav>

        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'S' }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Invitado' }}
            </span>
        </div>
    </header>

    <!-- Contenedor Principal del Chat -->
    <main class="flex-grow max-w-4xl mx-auto px-4 py-8 w-full flex flex-col h-[calc(100vh-140px)] min-h-[600px]">
        
        <!-- Tarjeta del Chat -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col h-full overflow-hidden">
            
            <!-- Cabecera del Chat -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white z-10">
                <div class="flex items-center gap-4">
                    <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700 transition font-bold text-lg">&larr;</a>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-full overflow-hidden shrink-0 border border-blue-100 flex items-center justify-center">
                            <span class="text-[#1F51FF] font-bold text-lg">Ki</span>
                        </div>
                        <div>
                            <h2 class="font-bold text-[#0f172a] text-[15px] leading-tight mb-0.5">Ki (Asistente IA)</h2>
                            <span class="text-[#10b981] text-[11px] font-medium flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#10b981] animate-pulse"></span> En línea
                            </span>
                        </div>
                    </div>
                </div>
                <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full border border-gray-100 hidden sm:block">SINKI Intelligence</span>
            </div>

            <!-- Área de Mensajes (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-6 bg-[#F4F7FF] flex flex-col gap-6" id="chat-messages">
                
                <!-- Mensaje Inicial de Bienvenida de Ki -->
                <div class="flex items-end gap-3 max-w-[85%] sm:max-w-[70%]">
                    <div class="w-8 h-8 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#1F51FF] font-bold text-xs shrink-0 shadow-sm">
                        Ki
                    </div>
                    <div>
                        <div class="bg-white border border-gray-100 text-[#0f172a] p-4 rounded-2xl rounded-tl-sm text-[13.5px] shadow-sm leading-relaxed">
                            ¡Hola! Soy <strong>Ki</strong>, el asistente virtual de SINKI. ¿En qué puedo ayudarte hoy con catálogos, inventarios o proveedores en Estelí?
                        </div>
                        <span class="text-gray-400 text-[11px] mt-1.5 ml-1 block">Ahora</span>
                    </div>
                </div>

            </div>

            <!-- Sugerencias Rápidas (Chips - Opción 4) -->
            <div class="px-4 py-2.5 bg-white border-t border-gray-100 flex flex-wrap gap-2 items-center">
                <span class="text-xs font-semibold text-gray-400 ml-1">Sugerencias:</span>
                <button type="button" onclick="sendQuickReply('¿Qué productos hay nuevos?')" class="text-xs bg-blue-50 text-[#1F51FF] hover:bg-blue-100 px-3 py-1.5 rounded-full transition font-medium border border-blue-100">📦 Productos nuevos</button>
                <button type="button" onclick="sendQuickReply('¿Cuáles son las categorías disponibles?')" class="text-xs bg-blue-50 text-[#1F51FF] hover:bg-blue-100 px-3 py-1.5 rounded-full transition font-medium border border-blue-100">📂 Categorías</button>
                <button type="button" onclick="sendQuickReply('¿Cómo puedo registrar mi negocio o proveedor?')" class="text-xs bg-blue-50 text-[#1F51FF] hover:bg-blue-100 px-3 py-1.5 rounded-full transition font-medium border border-blue-100">🏪 Registrar negocio</button>
            </div>

            <!-- Input de Texto (Formulario) -->
            <div class="p-4 bg-white border-t border-gray-100 z-10">
                <form id="chat-form" class="flex items-center gap-3">
                    @csrf
                    <input type="text" id="chat-input" class="flex-1 border border-gray-200 rounded-xl px-5 py-3.5 text-[14px] focus:ring-2 focus:ring-[#1F51FF] focus:border-[#1F51FF] outline-none transition-all placeholder-gray-400 shadow-sm" placeholder="Escribe tu mensaje para Ki..." required autocomplete="off">
                    <button type="submit" id="send-btn" class="bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-xl transition-colors text-[14px] shadow-md flex shrink-0 items-center justify-center">Enviar</button>
                </form>
            </div>
            
        </div>
    </main>

    <!-- Footer -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @endif

    <!-- Lógica JavaScript del Chat con RAG, Markdown y Conexión Backend -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const chatMessages = document.getElementById('chat-messages');
            const sendBtn = document.getElementById('send-btn');

            // Scroll hacia abajo al iniciar
            chatMessages.scrollTop = chatMessages.scrollHeight;

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const messageText = chatInput.value.trim();
                if (!messageText) return;
                processMessage(messageText);
            });

            // Función global para los chips de sugerencia rápida
            window.sendQuickReply = function(text) {
                chatInput.value = text;
                processMessage(text);
            }

            function processMessage(messageText) {
                const now = new Date();
                const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                // 1. Renderizar mensaje del usuario
                const userMsgId = 'msg-' + Date.now();
                const userMessageHTML = `
                    <div class="flex justify-end opacity-0 transform translate-y-4 transition-all duration-300" id="${userMsgId}">
                        <div class="max-w-[85%] sm:max-w-[70%] flex flex-col items-end">
                            <div class="bg-[#1F51FF] text-white p-4 rounded-2xl rounded-tr-sm text-[13.5px] shadow-md leading-relaxed">
                                ${escapeHTML(messageText)}
                            </div>
                            <span class="text-gray-400 text-[11px] mt-1.5 mr-1 block text-right">${timeString}</span>
                        </div>
                    </div>
                `;

                chatMessages.insertAdjacentHTML('beforeend', userMessageHTML);
                chatInput.value = '';

                setTimeout(() => {
                    const newMsg = document.getElementById(userMsgId);
                    if (newMsg) newMsg.classList.remove('opacity-0', 'translate-y-4');
                    chatMessages.scrollTo({ top: chatMessages.scrollHeight, behavior: 'smooth' });
                }, 10);

                // Deshabilitar input temporalmente
                chatInput.disabled = true;
                sendBtn.disabled = true;

                // 2. Mostrar indicador de "Ki está escribiendo..."
                const loadingId = 'loading-' + Date.now();
                const loadingHTML = `
                    <div class="flex items-end gap-3 max-w-[85%] sm:max-w-[70%] opacity-0 transform translate-y-4 transition-all duration-300" id="${loadingId}">
                        <div class="w-8 h-8 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#1F51FF] font-bold text-xs shrink-0 shadow-sm">
                            Ki
                        </div>
                        <div>
                            <div class="bg-white border border-gray-100 text-gray-400 p-4 rounded-2xl rounded-tl-sm text-[13.5px] shadow-sm leading-relaxed italic animate-pulse">
                                Ki está pensando...
                            </div>
                        </div>
                    </div>
                `;
                chatMessages.insertAdjacentHTML('beforeend', loadingHTML);
                const loadingEl = document.getElementById(loadingId);
                setTimeout(() => loadingEl.classList.remove('opacity-0', 'translate-y-4'), 10);
                chatMessages.scrollTo({ top: chatMessages.scrollHeight, behavior: 'smooth' });

                // 3. Petición AJAX al controlador GeminiController (/chat/ask)
                fetch('/chat/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ prompt: messageText })
                })
                .then(response => response.json())
                .then(data => {
                    loadingEl.remove();
                    chatInput.disabled = false;
                    sendBtn.disabled = false;
                    chatInput.focus();

                    const replyTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    const botReplyText = data.reply || data.error || 'Lo siento, ocurrió un error procesando tu respuesta.';
                    
                    // Parsear Markdown (Opción 5)
                    const parsedHTML = typeof marked !== 'undefined' ? marked.parse(botReplyText) : escapeHTML(botReplyText);

                    const botMsgId = 'bot-msg-' + Date.now();
                    const botMessageHTML = `
                        <div class="flex items-end gap-3 max-w-[85%] sm:max-w-[70%] opacity-0 transform translate-y-4 transition-all duration-300" id="${botMsgId}">
                            <div class="w-8 h-8 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#1F51FF] font-bold text-xs shrink-0 shadow-sm">
                                Ki
                            </div>
                            <div>
                                <div class="bg-white border border-gray-100 text-[#0f172a] p-4 rounded-2xl rounded-tl-sm text-[13.5px] shadow-sm leading-relaxed prose prose-sm max-w-none">
                                    ${parsedHTML}
                                </div>
                                <span class="text-gray-400 text-[11px] mt-1.5 ml-1 block">${replyTime}</span>
                            </div>
                        </div>
                    `;

                    chatMessages.insertAdjacentHTML('beforeend', botMessageHTML);
                    setTimeout(() => {
                        const newBotMsg = document.getElementById(botMsgId);
                        if (newBotMsg) newBotMsg.classList.remove('opacity-0', 'translate-y-4');
                        chatMessages.scrollTo({ top: chatMessages.scrollHeight, behavior: 'smooth' });
                    }, 10);
                })
                .catch(error => {
                    loadingEl.remove();
                    chatInput.disabled = false;
                    sendBtn.disabled = false;
                    console.error('Error:', error);
                    alert('Hubo un error de conexión con el asistente.');
                });
            }

            function escapeHTML(str) {
                return str.replace(/[&<>'"]/g, function(tag) {
                    const charsToReplace = { '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' };
                    return charsToReplace[tag] || tag;
                });
            }
        });
    </script>
</body>
</html>