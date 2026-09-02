<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat - TechSolutions GT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F7FF] font-sans antialiased min-h-screen flex flex-col">

    <!-- HEADER INTACTO CON LOGO BLANCO -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow-sm border-b border-gray-100 z-50 relative">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/LogoBlanco.png') }}" alt="Icono SINGKI" class="h-8 w-auto object-contain">
            <span class="font-black text-[24px] text-[#2563eb] tracking-tighter">SINGKI</span>
        </a>
        
        <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
            <a href="{{ url('/') }}" class="hover:text-[#2563eb] transition">Inicio</a>
            <a href="{{ url('/#categorias') }}" class="hover:text-[#2563eb] transition">Categorías</a>
            <a href="{{ url('/explorar') }}" class="hover:text-[#2563eb] transition">Explorar</a>
        </nav>
        
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'M' }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline-block">
                {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'María' }}
            </span>
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </header>

        <!-- INTERFAZ DEL CHAT (REACTIVA CON ALPINE.JS) -->
    <main x-data="{
        newMessage: '',
        messages: [
            { type: 'bot', text: '¡Hola! ¿En qué podemos ayudarte hoy?', time: '10:02' },
            { type: 'user', text: 'Buenas tardes. Quiero saber si tienen disponibles laptops HP i7.', time: '10:05' },
            { type: 'bot', text: 'Sí, tenemos el modelo HP EliteBook 840 G9 en stock. ¿Te envío la ficha técnica completa?', time: '10:06' },
            { type: 'user', text: 'Por favor, y también los precios por volumen si compro 10 unidades.', time: '10:08' },
            { type: 'bot', text: 'Claro, preparamos la cotización ahora mismo. ¿Cuál es el correo para enviártela?', time: '10:09' }
        ],
        sendMessage() {
            if (this.newMessage.trim() === '') return;
            
            // Atrapamos la hora exacta (Ej: 10:14)
            const now = new Date();
            const timeString = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
            
            // Inyectamos el nuevo mensaje en el arreglo
            this.messages.push({
                type: 'user',
                text: this.newMessage,
                time: timeString
            });
            
            // Limpiamos la caja de texto
            this.newMessage = '';
            
            // Hacemos scroll automático hasta abajo para ver el nuevo mensaje
            setTimeout(() => {
                const chatContainer = document.getElementById('chat-scroll-area');
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 50);
        }
    }" class="flex-grow w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col">
        
        <!-- Contenedor Principal -->
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 flex flex-col h-[75vh] overflow-hidden">
            
            <!-- Cabecera del Chat -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white z-10">
                <div class="flex items-center gap-4">
                    <button onclick="history.back()" class="text-[#3b82f6] hover:bg-blue-50 p-2 rounded-full transition-colors cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </button>
                    <!-- Avatar Empresa -->
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=100&q=80" class="w-10 h-10 rounded-full object-cover shadow-sm">
                    <div>
                        <h2 class="font-bold text-[#0f172a] text-[15px] leading-tight mb-0.5">TechSolutions GT</h2>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-[#22c55e]"></span>
                            <span class="text-[12px] text-[#22c55e] font-medium tracking-wide">En línea</span>
                        </div>
                    </div>
                </div>
                <!-- Link Ver Perfil -->
                <button onclick="history.back()" class="text-[#3b82f6] text-[13px] font-bold hover:underline">Ver perfil</button>
            </div>

            <!-- Área de Mensajes -->
            <div id="chat-scroll-area" class="flex-1 overflow-y-auto p-6 bg-white space-y-6 scroll-smooth">
                
                <!-- Bucle Mágico de Alpine -->
                <template x-for="(msg, index) in messages" :key="index">
                    <div class="w-full">
                        
                        <!-- Si el mensaje es del BOT -->
                        <template x-if="msg.type === 'bot'">
                            <div class="flex items-end gap-3 max-w-[80%]">
                                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=100&q=80" class="w-8 h-8 rounded-full object-cover shrink-0 mb-5 shadow-sm">
                                <div>
                                    <div class="bg-[#eff6ff] text-[#0f172a] px-5 py-3.5 rounded-2xl rounded-bl-sm text-[14px] shadow-sm leading-relaxed" x-text="msg.text"></div>
                                    <span class="text-[11px] text-[#3b82f6] mt-1.5 ml-1 block font-medium" x-text="msg.time"></span>
                                </div>
                            </div>
                        </template>

                        <!-- Si el mensaje es tuyo (USUARIO) -->
                        <template x-if="msg.type === 'user'">
                            <div class="flex items-end justify-end gap-3 max-w-[80%] ml-auto">
                                <div class="text-right">
                                    <div class="bg-[#2563eb] text-white px-5 py-3.5 rounded-2xl rounded-br-sm text-[14px] text-left shadow-sm leading-relaxed" x-text="msg.text"></div>
                                    <span class="text-[11px] text-[#3b82f6] mt-1.5 mr-1 block font-medium" x-text="msg.time"></span>
                                </div>
                            </div>
                        </template>
                        
                    </div>
                </template>
            </div>

            <!-- Caja de Texto (Footer del Chat) -->
            <div class="p-4 border-t border-gray-100 bg-white z-10">
                <!-- Usamos @submit.prevent para que funcione con Enter en el teclado sin recargar la página -->
                <form @submit.prevent="sendMessage" class="flex gap-3">
                    <input type="text" x-model="newMessage" placeholder="Escribe un mensaje..." class="flex-1 border border-gray-200 rounded-xl px-5 py-3.5 text-[14px] text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2563eb] focus:border-transparent transition-shadow">
                    
                    <button type="submit" 
                            :disabled="newMessage.trim() === ''" 
                            :class="newMessage.trim() === '' ? 'opacity-50 cursor-not-allowed' : ''" 
                            class="bg-[#2563eb] hover:bg-[#1d4ed8] text-white px-8 py-3.5 rounded-xl text-[14px] font-bold transition-colors shadow-sm">
                        Enviar
                    </button>
                </form>
            </div>
            
        </div>
    </main>

</body>
</html>
