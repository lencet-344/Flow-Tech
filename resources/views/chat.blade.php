<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asistente IA - Singky ') }}
        </h2>
    </x-slot>

    
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <style>
        .markdown-content p { margin-bottom: 0.5rem; }
        .markdown-content p:last-child { margin-bottom: 0; }
        .markdown-content ul { list-style-type: disc; padding-left: 1.25rem; margin-bottom: 0.5rem; }
        .markdown-content ol { list-style-type: decimal; padding-left: 1.25rem; margin-bottom: 0.5rem; }
        .markdown-content strong { font-weight: 700; }
    </style>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-6 flex flex-col h-[600px]">
                
                <div class="flex justify-between items-center mb-4 pb-2 border-b">
                    <h3 class="text-lg font-bold text-gray-800">Asistente IA "Ki" de Singky </h3>
                    <span class="text-xs bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full font-medium">Gemini IA</span>
                </div>

                
                <div id="chat-box" class="flex-1 overflow-y-auto space-y-4 pr-2 mb-4">
                    <div class="bg-gray-100 p-3 rounded-lg text-gray-700 max-w-[80%]">
                        Hola, ¿en qué puedo ayudarte hoy con la gestión logística?
                    </div>
                </div>

                
                <form id="chat-form" class="flex gap-2 border-t pt-4">
                    <input 
                        type="text" 
                        id="prompt" 
                        class="flex-1 border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Escribe tu mensaje..." 
                        required
                    >
                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white px-5 py-2 rounded-xl font-semibold hover:bg-blue-700 transition"
                    >
                        Enviar
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('chat-form');
        const chatBox = document.getElementById('chat-box');
        const input = document.getElementById('prompt');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = input.value.trim();
            if(!text) return;

            
            chatBox.innerHTML += `<div class="bg-blue-600 text-white p-3 rounded-lg max-w-[80%] ml-auto">${text}</div>`;
            input.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            
            const loadingId = 'loading-' + Date.now();
            chatBox.innerHTML += `<div id="${loadingId}" class="bg-gray-200 text-gray-600 p-3 rounded-lg max-w-[80%]">Pensando...</div>`;
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
                    chatBox.innerHTML += `<div class="bg-gray-100 p-3 rounded-lg text-gray-800 max-w-[80%] markdown-content">${formattedReply}</div>`;
                } else {
                    const errorDetail = typeof data.error === 'object' ? JSON.stringify(data.error) : data.error;
                    chatBox.innerHTML += `<div class="bg-red-100 text-red-700 p-3 rounded-lg max-w-[80%] border border-red-300"><b>Error:</b> ${errorDetail || 'Sin respuesta'}</div>`;
                }
            } catch (err) {
                document.getElementById(loadingId).remove();
                chatBox.innerHTML += `<div class="bg-red-100 text-red-600 p-3 rounded-lg max-w-[80%]">Error de conexión con el servidor.</div>`;
            }
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    </script>
</x-app-layout>