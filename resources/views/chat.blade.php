<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Asistente IA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-6 flex flex-col h-[600px]">
        <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Asistente IA del Sistema</h2>

        <!-- Area de Mensajes -->
        <div id="chat-box" class="flex-1 overflow-y-auto space-y-4 pr-2 mb-4">
            <div class="bg-gray-100 p-3 rounded-lg text-gray-700 max-w-[80%]">
                Hola, ¿en qué puedo ayudarte hoy con la gestión logística?
            </div>
        </div>

        <!-- Formulario de Entrada -->
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

    <script>
        const form = document.getElementById('chat-form');
        const chatBox = document.getElementById('chat-box');
        const input = document.getElementById('prompt');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = input.value.trim();
            if(!text) return;

            // Mostrar mensaje del usuario
            chatBox.innerHTML += `<div class="bg-blue-600 text-white p-3 rounded-lg max-w-[80%] ml-auto">${text}</div>`;
            input.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            // Indicador de carga
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
                    chatBox.innerHTML += `<div class="bg-gray-100 p-3 rounded-lg text-gray-800 max-w-[80%]">${data.reply}</div>`;
                } else {
                    chatBox.innerHTML += `<div class="bg-red-100 text-red-600 p-3 rounded-lg max-w-[80%]">Error al obtener respuesta.</div>`;
                }
            } catch (err) {
                document.getElementById(loadingId).remove();
                chatBox.innerHTML += `<div class="bg-red-100 text-red-600 p-3 rounded-lg max-w-[80%]">Error de conexión.</div>`;
            }
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    </script>
</body>
</html>