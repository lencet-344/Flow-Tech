<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat TechSolutions GT - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <a href="#" class="hover:text-[#1F51FF] transition">Explorar</a>
        </nav>

        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'S' }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Usuario' }}
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
                        <div class="w-10 h-10 bg-gray-100 rounded-full overflow-hidden shrink-0 border border-gray-200 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=100&q=80" alt="TechSolutions GT" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h2 class="font-bold text-[#0f172a] text-[15px] leading-tight mb-0.5">TechSolutions GT</h2>
                            <span class="text-[#10b981] text-[11px] font-medium flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#10b981]"></span> En línea
                            </span>
                        </div>
                    </div>
                </div>
                <a href="#" class="text-[#1F51FF] text-[13px] font-medium hover:underline hidden sm:block">Ver perfil</a>
            </div>

            <!-- Área de Mensajes (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-6 bg-[#F4F7FF] flex flex-col gap-6" id="chat-messages">
                
                <!-- Mensaje Recibido (Proveedor) -->
                <div class="flex items-end gap-3 max-w-[85%] sm:max-w-[70%]">
                    <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 shadow-sm border border-gray-200">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=100&q=80" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="bg-white border border-gray-100 text-[#0f172a] p-4 rounded-2xl rounded-tl-sm text-[13.5px] shadow-sm leading-relaxed">
                            ¡Hola! ¿En qué podemos ayudarte hoy?
                        </div>
                        <span class="text-gray-400 text-[11px] mt-1.5 ml-1 block">10:02</span>
                    </div>
                </div>

                <!-- Mensaje Enviado (Usuario) -->
                <div class="flex justify-end">
                    <div class="max-w-[85%] sm:max-w-[70%] flex flex-col items-end">
                        <div class="bg-[#1F51FF] text-white p-4 rounded-2xl rounded-tr-sm text-[13.5px] shadow-md leading-relaxed">
                            Buenas tardes. Quiero saber si tienen disponibles laptops HP i7.
                        </div>
                        <span class="text-gray-400 text-[11px] mt-1.5 mr-1 block text-right">10:05</span>
                    </div>
                </div>

                <!-- Mensaje Recibido (Proveedor) -->
                <div class="flex items-end gap-3 max-w-[85%] sm:max-w-[70%]">
                    <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 shadow-sm border border-gray-200">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=100&q=80" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="bg-white border border-gray-100 text-[#0f172a] p-4 rounded-2xl rounded-tl-sm text-[13.5px] shadow-sm leading-relaxed">
                            Sí, tenemos el modelo HP EliteBook 840 G9 en stock. ¿Te envío la ficha técnica completa?
                        </div>
                        <span class="text-gray-400 text-[11px] mt-1.5 ml-1 block">10:06</span>
                    </div>
                </div>

                <!-- Mensaje Enviado (Usuario) -->
                <div class="flex justify-end">
                    <div class="max-w-[85%] sm:max-w-[70%] flex flex-col items-end">
                        <div class="bg-[#1F51FF] text-white p-4 rounded-2xl rounded-tr-sm text-[13.5px] shadow-md leading-relaxed">
                            Por favor, y también los precios por volumen si compro 10 unidades.
                        </div>
                        <span class="text-gray-400 text-[11px] mt-1.5 mr-1 block text-right">10:08</span>
                    </div>
                </div>

                <!-- Mensaje Recibido (Proveedor) -->
                <div class="flex items-end gap-3 max-w-[85%] sm:max-w-[70%]">
                    <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 shadow-sm border border-gray-200">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=100&q=80" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="bg-white border border-gray-100 text-[#0f172a] p-4 rounded-2xl rounded-tl-sm text-[13.5px] shadow-sm leading-relaxed">
                            Claro, preparamos la cotización ahora mismo. ¿Cuál es el correo para enviártela?
                        </div>
                        <span class="text-gray-400 text-[11px] mt-1.5 ml-1 block">10:09</span>
                    </div>
                </div>

            </div>

            <!-- Input de Texto (Formulario) -->
            <div class="p-4 bg-white border-t border-gray-100 z-10">
                <form id="chat-form" class="flex items-center gap-3">
                    <input type="text" id="chat-input" class="flex-1 border border-gray-200 rounded-xl px-5 py-3.5 text-[14px] focus:ring-2 focus:ring-[#1F51FF] focus:border-[#1F51FF] outline-none transition-all placeholder-gray-400 shadow-sm" placeholder="Escribe un mensaje..." required autocomplete="off">
                    <button type="submit" class="bg-[#1F51FF] hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-xl transition-colors text-[14px] shadow-md flex shrink-0">Enviar</button>
                </form>
            </div>
            
        </div>
    </main>

    <!-- Footer -->
    @if(View::exists('components.footer'))
        @include('components.footer')
    @endif

    <!-- Lógica de Simulación de Chat -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const chatMessages = document.getElementById('chat-messages');

            // Scroll hacia abajo al iniciar
            chatMessages.scrollTop = chatMessages.scrollHeight;

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const messageText = chatInput.value.trim();
                if (!messageText) return;

                // Obtener hora actual
                const now = new Date();
                const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                // Crear el bloque HTML del mensaje enviado (Burbuja Azul)
                const messageHTML = `
                    <div class="flex justify-end opacity-0 transform translate-y-4 transition-all duration-300" id="new-msg-${now.getTime()}">
                        <div class="max-w-[85%] sm:max-w-[70%] flex flex-col items-end">
                            <div class="bg-[#1F51FF] text-white p-4 rounded-2xl rounded-tr-sm text-[13.5px] shadow-md leading-relaxed">
                                ${escapeHTML(messageText)}
                            </div>
                            <span class="text-gray-400 text-[11px] mt-1.5 mr-1 block text-right">${timeString}</span>
                        </div>
                    </div>
                `;

                // Inyectar en el DOM
                chatMessages.insertAdjacentHTML('beforeend', messageHTML);
                
                // Limpiar input
                chatInput.value = '';

                // Activar animación y hacer scroll
                setTimeout(() => {
                    const newMsg = document.getElementById(`new-msg-${now.getTime()}`);
                    newMsg.classList.remove('opacity-0', 'translate-y-4');
                    chatMessages.scrollTo({ top: chatMessages.scrollHeight, behavior: 'smooth' });
                }, 10);
            });

            // Función de seguridad básica para prevenir inyección de HTML
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
