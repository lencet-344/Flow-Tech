<?php
$filepath = 'resources/views/public/profile.blade.php';
$content = file_get_contents($filepath);

$old_button = <<<'EOT'
                        <!-- Botón Chatear (WhatsApp API) -->
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $perfil['telefono']) }}?text={{ urlencode('Hola, visité su perfil en SINGKI y me gustaría obtener más información.') }}" target="_blank" 
                           class="flex items-center gap-2 bg-[#2563eb] text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-[#1d4ed8] transition-all shadow-md active:scale-95 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg> 
                            Chatear
                        </a>
EOT;

$new_button = <<<'EOT'
                        <!-- Botón Chatear (Interno SINGKI) -->
                        <a href="{{ url('/chat-negocio?empresa=' . urlencode($perfil['nombre'])) }}" 
                           class="flex items-center gap-2 bg-[#2563eb] text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-[#1d4ed8] transition-all shadow-md active:scale-95 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg> 
                            Chatear
                        </a>
EOT;

$content = str_replace($old_button, $new_button, $content);

file_put_contents($filepath, $content);
echo "REPLACED BUTTON\n";
?>
