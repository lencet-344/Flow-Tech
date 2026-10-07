<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f8fafc] font-sans antialiased text-[#040116] min-h-screen flex flex-col">

    <!-- Navegación Superior -->
    <nav class="bg-white border-b border-gray-100 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2 select-none cursor-default">
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                <span class="font-black text-2xl text-[#2563eb] tracking-tighter">SINGKI</span>
            </div>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-[#1F51FF] transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al inicio
            </a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#040116] tracking-tight mb-4">¿Cómo podemos ayudarte hoy?</h1>
            <p class="text-gray-500 text-base">Encuentra respuestas rápidas o contáctanos si necesitas atención personalizada.</p>
        </div>

        <!-- FAQ Acordeón Alpine.js -->
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8 mb-12" x-data="{ activeAccordion: null }">
            <h2 class="text-xl font-bold text-[#040116] mb-6">Preguntas Frecuentes</h2>
            
            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="border border-gray-100 rounded-xl overflow-hidden">
                    <button @click="activeAccordion = activeAccordion === 1 ? null : 1" class="w-full flex justify-between items-center p-5 bg-gray-50/50 hover:bg-gray-50 transition-colors text-left focus:outline-none">
                        <span class="font-semibold text-[#040116] text-sm">¿Cómo explorar negocios en SINGKI?</span>
                        <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="activeAccordion === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="activeAccordion === 1" x-collapse style="display: none;">
                        <div class="p-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 bg-white">
                            Puedes dirigirte a nuestra sección de <a href="{{ url('/explorar') }}" class="text-[#1F51FF] font-semibold hover:underline">Explorar</a>. Allí encontrarás un mapa interactivo y una lista de negocios clasificados por categorías. Usa el buscador o los filtros para encontrar exactamente lo que necesitas.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-gray-100 rounded-xl overflow-hidden">
                    <button @click="activeAccordion = activeAccordion === 2 ? null : 2" class="w-full flex justify-between items-center p-5 bg-gray-50/50 hover:bg-gray-50 transition-colors text-left focus:outline-none">
                        <span class="font-semibold text-[#040116] text-sm">¿Cómo reservar productos o stock?</span>
                        <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="activeAccordion === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="activeAccordion === 2" x-collapse style="display: none;">
                        <div class="p-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 bg-white">
                            Al entrar al perfil de un negocio, ve a la pestaña "Productos y Stock". Si el producto está disponible, podrás dar clic en el botón de reservar, agregar indicaciones especiales y nosotros le notificaremos al negocio de inmediato.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-gray-100 rounded-xl overflow-hidden">
                    <button @click="activeAccordion = activeAccordion === 3 ? null : 3" class="w-full flex justify-between items-center p-5 bg-gray-50/50 hover:bg-gray-50 transition-colors text-left focus:outline-none">
                        <span class="font-semibold text-[#040116] text-sm">¿Cómo registrar mi empresa o negocio?</span>
                        <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="activeAccordion === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="activeAccordion === 3" x-collapse style="display: none;">
                        <div class="p-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 bg-white">
                            Si eres proveedor o emprendedor, puedes <a href="{{ route('register') }}" class="text-[#1F51FF] font-semibold hover:underline">crear una cuenta nueva</a> seleccionando el rol "Soy Proveedor" o "Ofrezco Servicios". Te pediremos datos de tu negocio y podrás empezar a publicar tu inventario.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjetas de Acción -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Acción Contacto -->
            <a href="{{ route('contact_requests.create') }}" class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8 flex flex-col items-center text-center hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-blue-50 text-[#1F51FF] rounded-full flex items-center justify-center mb-4 group-hover:bg-[#1F51FF] group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bold text-[#040116] text-lg mb-2">Contáctanos</h3>
                <p class="text-gray-500 text-sm">Envíanos un mensaje directo. Te responderemos en menos de 24 horas.</p>
            </a>

            <!-- Acción IA -->
            <button type="button" onclick="toggleChat(); setTimeout(() => document.getElementById('ki-input').focus(), 350);" class="w-full bg-white rounded-[24px] shadow-sm border border-gray-100 p-8 flex flex-col items-center text-center hover:shadow-md transition-shadow group focus:outline-none">
                <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <h3 class="font-bold text-[#040116] text-lg mb-2">Asistente Ki</h3>
                <p class="text-gray-500 text-sm">Chatea con nuestra Inteligencia Artificial para recibir ayuda inmediata.</p>
            </button>
        </div>
    </main>

    <!-- ========================================== -->
    <!-- CHATBOT FLOTANTE Y MODAL DE AYUDA          -->
    <!-- ========================================== -->
    <div class="fixed top-32 right-6 lg:right-12 z-50 flex flex-col items-end">
        <button id="btn-chat-toggle" class="bg-[#2563eb] w-14 h-14 rounded-full shadow-xl shadow-blue-500/30 flex items-center justify-center hover:scale-105 transition-all duration-300 focus:outline-none z-50 relative">
            <img id="chat-icon-robot" src="{{ asset('images/Robot.png') }}" alt="Robot KI" class="w-8 h-8 object-contain transition-opacity duration-300">
            <svg id="chat-icon-x" class="w-6 h-6 text-white absolute inset-0 m-auto opacity-0 scale-50 transition-all duration-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div id="chat-modal" class="hidden w-[340px] bg-white rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden mt-4 transition-all duration-300 transform origin-top-right opacity-0 scale-95">
            <div class="bg-[#2563eb] text-white px-5 py-3.5 flex justify-between items-center">
                <span class="font-semibold text-[14px] tracking-wide">Centro de Ayuda SINGKI</span>
                <button id="close-chat-modal" class="text-white hover:text-gray-200 transition-colors focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="p-5 bg-white overflow-y-auto max-h-96">
                <div class="flex gap-4 items-start mb-6">
                    <div class="w-12 h-12 bg-[#2563eb] rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                        <img src="{{ asset('images/Robot.png') }}" alt="Ki" class="w-7 h-7 object-contain scale-110">
                    </div>
                    <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl rounded-tl-sm w-full">
                        <h4 class="text-[#2563eb] font-bold text-[14px] mb-1">Hola, soy Ki</h4>
                        <p class="text-gray-700 text-[13px] leading-relaxed font-light">Enviaré tu pregunta al administrador de SINGKI. Pronto recibirás una respuesta para ayudarte con tu consulta.</p>
                    </div>
                </div>
                
                <div>
                    <div class="flex flex-wrap gap-1.5 mb-3">
                        <button type="button" onclick="sendQuickPrompt('¿Qué productos hay disponibles?')" class="text-[11px] bg-blue-50 text-blue-700 hover:bg-blue-100 px-2.5 py-1 rounded-full font-medium transition border border-blue-200">📦 Productos</button>
                        <button type="button" onclick="sendQuickPrompt('¿Qué categorias manejan?')" class="text-[11px] bg-blue-50 text-blue-700 hover:bg-blue-100 px-2.5 py-1 rounded-full font-medium transition border border-blue-200">📂 Categorías</button>
                        <button type="button" onclick="sendQuickPrompt('¿Cómo puedo registrar mi negocio como proveedor?')" class="text-[11px] bg-blue-50 text-blue-700 hover:bg-blue-100 px-2.5 py-1 rounded-full font-medium transition border border-blue-200">🏪 Proveedor</button>
                    </div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-2">Escribe tu consulta</label>
                    <textarea id="ki-input" class="w-full text-[13px] border border-gray-700 rounded-xl p-3 focus:ring-[#2563eb] focus:border-[#2563eb] outline-none resize-none placeholder-gray-700 font-light" rows="3" placeholder="¿En qué podemos ayudarte? Escribe tu pregunta aquí..."></textarea>
                    
                    <button id="ki-send-btn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-xl transition-colors w-full shadow-sm mt-3">Enviar consulta</button>
                </div>
            </div>
            
            <div class="bg-white px-4 py-3 border-t border-gray-50 text-center">
                <span class="text-[11px] text-gray-800 font-light">SINGKI · Conectamos negocios con oportunidades</span>
            </div>
        </div>
    </div>
    <!-- ========================================== -->

    <x-footer />
    
    <script>
        function toggleChat() {
            const chatModal = document.getElementById('chat-modal');
            const iconRobot = document.getElementById('chat-icon-robot');
            const iconX = document.getElementById('chat-icon-x');

            if (chatModal.classList.contains('hidden')) {
                chatModal.classList.remove('hidden');
                setTimeout(() => {
                    chatModal.classList.remove('opacity-0', 'scale-95');
                    chatModal.classList.add('opacity-100', 'scale-100');
                }, 10);
            } else {
                chatModal.classList.remove('opacity-100', 'scale-100');
                chatModal.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    chatModal.classList.add('hidden');
                }, 300);
            }
            
            if (iconRobot.classList.contains('opacity-0')) {
                iconRobot.classList.remove('opacity-0', 'scale-50');
                iconRobot.classList.add('opacity-100', 'scale-100');
                iconX.classList.remove('opacity-100', 'scale-100');
                iconX.classList.add('opacity-0', 'scale-50');
            } else {
                iconRobot.classList.remove('opacity-100', 'scale-100');
                iconRobot.classList.add('opacity-0', 'scale-50');
                iconX.classList.remove('opacity-0', 'scale-50');
                iconX.classList.add('opacity-100', 'scale-100');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btn-chat-toggle').addEventListener('click', toggleChat);
            document.getElementById('close-chat-modal').addEventListener('click', toggleChat);
        });

        function parsearMarkdown(texto) {
            if (!texto) return '';
            let html = texto.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-gray-900">$1</strong>');
            html = html.replace(/\n/g, '<br>');
            return html;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const btnSend = document.getElementById('ki-send-btn');
            const inputField = document.getElementById('ki-input');

            if(btnSend && inputField) {
                btnSend.addEventListener('click', async (e) => {
                    e.preventDefault();
                    
                    const text = inputField.value.trim();
                    if(!text) return;

                    const originalText = btnSend.innerText;
                    btnSend.innerText = 'Enviando...';
                    btnSend.disabled = true;
                    btnSend.classList.add('opacity-50', 'cursor-not-allowed');

                    const userMsgHtml = `
                        <div class="flex gap-4 items-start mb-6 flex-row-reverse">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="bg-blue-50 border border-blue-100 p-3 rounded-2xl rounded-tr-sm w-full max-w-[85%]">
                                <p class="text-gray-700 text-[13px] leading-relaxed font-light">${text}</p>
                            </div>
                        </div>
                    `;
                    const formContainer = inputField.parentElement;
                    formContainer.insertAdjacentHTML('beforebegin', userMsgHtml);
                    
                    inputField.value = '';
                    const chatModalBody = document.querySelector('#chat-modal .bg-white.p-5');
                    if(chatModalBody) chatModalBody.scrollTop = chatModalBody.scrollHeight;

                    try {
                        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                        const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

                        const response = await fetch("{{ route('chat.ask') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ prompt: text })
                        });

                        const data = await response.json();
                        
                        const replyText = data.reply ? data.reply : (data.error || 'Error desconocido');
                        const kiMsgHtml = `
                            <div class="flex gap-4 items-start mb-6">
                                <div class="w-12 h-12 bg-[#2563eb] rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <img src="{{ asset('images/Robot.png') }}" alt="Ki" class="w-7 h-7 object-contain scale-110">
                                </div>
                                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl rounded-tl-sm w-full">
                                    <h4 class="text-[#2563eb] font-bold text-[14px] mb-1">Ki</h4>
                                    <div class="text-gray-500 text-[13px] leading-relaxed font-light prose prose-sm max-w-none">${parsearMarkdown(replyText)}</div>
                                </div>
                            </div>
                        `;
                        formContainer.insertAdjacentHTML('beforebegin', kiMsgHtml);
                        
                    } catch (error) {
                        console.error('Error enviando consulta a Ki:', error);
                        alert('Hubo un error al contactar al asistente. Por favor, intenta de nuevo.');
                    } finally {
                        btnSend.innerText = originalText;
                        btnSend.disabled = false;
                        btnSend.classList.remove('opacity-50', 'cursor-not-allowed');
                        if(chatModalBody) chatModalBody.scrollTop = chatModalBody.scrollHeight;
                    }
                });
            }
        });

        function sendQuickPrompt(text) {
            const input = document.getElementById('ki-input');
            const sendBtn = document.getElementById('ki-send-btn');
            if (input && sendBtn) {
                input.value = text;
                sendBtn.click();
            }
        }
    </script>
@include('components.accessibility-widget')
</body>
</html>
