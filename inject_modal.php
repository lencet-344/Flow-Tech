<?php
$file = 'resources/views/public/profile.blade.php';
$content = file_get_contents($file);

$searchRegex = '/<button class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-800 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"><\/path><\/svg>Reportar negocio<\/button>/is';

$replace = <<<'HTML'
<div x-data="{ reportModal: false, reportStep: 1 }" class="inline-block">
                    <button @click="reportModal = true; reportStep = 1" class="flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 transition-colors duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                        Reportar negocio
                    </button>

                    <!-- Modal Overlay -->
                    <div x-show="reportModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-50" x-transition.opacity style="display: none;">
                        
                        <!-- Modal Card -->
                        <div @click.away="reportModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative mx-4">
                            
                            <!-- Botón de Cerrar (X) -->
                            <button @click="reportModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <!-- Paso 1: Formulario de Reporte -->
                            <div x-show="reportStep === 1" x-transition.opacity>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Reportar este negocio</h3>
                                <p class="text-sm text-gray-500 mb-5">Ayúdanos a mantener una comunidad segura. ¿Qué sucede con este negocio?</p>
                                
                                <textarea rows="4" placeholder="¿Por qué estás reportando este negocio?" class="w-full border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm p-3 outline-none bg-gray-50 mb-2 transition-shadow resize-none"></textarea>
                                
                                <div class="flex gap-3 justify-end mt-4">
                                    <button @click="reportModal = false" class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Cancelar</button>
                                    <button @click="reportStep = 2" class="px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors shadow-sm">Enviar reporte</button>
                                </div>
                            </div>

                            <!-- Paso 2: Mensaje de Éxito -->
                            <div x-show="reportStep === 2" class="text-center py-4" style="display: none;" x-transition.opacity>
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-green-600 mb-2">¡Reporte enviado con éxito!</h3>
                                <p class="text-gray-500 text-sm mb-8">Hemos recibido tu reporte y nuestro equipo de moderación lo revisará a la brevedad.</p>
                                <button @click="reportModal = false" class="w-full px-5 py-3 text-sm font-semibold text-white bg-gray-900 hover:bg-black rounded-xl transition-colors shadow-sm">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>
HTML;

$content = preg_replace($searchRegex, $replace, $content);
file_put_contents($file, $content);

echo "Modal injected successfully.\n";
?>
