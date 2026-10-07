<!-- resources/views/components/accessibility-widget.blade.php -->
@if(!request()->is('admin*'))
<style>
    /* Clases de Accesibilidad */
    html.a11y-contrast { filter: contrast(130%) saturate(115%); }
    html.a11y-grayscale { filter: grayscale(100%); }
    html.a11y-dyslexia { 
        letter-spacing: 0.04em !important; 
        word-spacing: 0.1em !important; 
        line-height: 1.65 !important; 
    }
    html.a11y-links a, 
    html.a11y-links button, 
    html.a11y-links [role="button"] { 
        outline: 2px solid #eab308 !important; 
        outline-offset: 2px !important; 
    }
    html.a11y-no-motion *, 
    html.a11y-no-motion *::before, 
    html.a11y-no-motion *::after { 
        transition: none !important; 
        animation: none !important; 
        scroll-behavior: auto !important;
    }
    
    .a11y-btn-active {
        background-color: #eff6ff !important;
        border-color: #1F51FF !important;
        color: #1F51FF !important;
    }
    .a11y-btn-inactive {
        background-color: #ffffff;
        border-color: #e5e7eb;
        color: #4b5563;
    }
    
    .a11y-reading-highlight {
        outline: 3px solid #1F51FF !important;
        outline-offset: 2px !important;
        border-radius: 4px !important;
    }

    /* Transiciones Panel */
    .singki-a11y-panel {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateY(18px) scale(0.92);
        transform-origin: bottom left;
        transition: opacity 0.28s cubic-bezier(0.22, 1, 0.36, 1), transform 0.32s cubic-bezier(0.34, 1.56, 0.64, 1), visibility 0.28s;
    }
    .singki-a11y-panel.singki-a11y-open {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateY(0) scale(1);
    }

    /* Animación Botón Flotante */
    #a11y-toggle-btn {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease, background-color 0.25s ease !important;
    }
    #a11y-toggle-btn:hover {
        transform: translateY(-2px) scale(1.06) !important;
    }
    #a11y-toggle-btn.singki-a11y-btn-active {
        box-shadow: 0 0 0 5px rgba(31, 81, 255, 0.22), 0 10px 25px rgba(31, 81, 255, 0.45) !important;
    }
    #a11y-toggle-btn.singki-a11y-btn-active svg {
        transform: rotate(12deg) scale(1.08);
        transition: transform 0.32s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
</style>

<!-- Botón Flotante Activador -->
<button id="a11y-toggle-btn" title="Menú de Accesibilidad" aria-label="Abrir menú de accesibilidad" style="position: fixed; bottom: 24px; left: 24px; width: 54px; height: 54px; border-radius: 9999px; background-color: #1F51FF; color: #ffffff; z-index: 99998; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(31, 81, 255, 0.4); border: 2px solid #ffffff; cursor: pointer;">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <path d="M12 6a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"></path>
        <path d="M7 11h10"></path>
        <path d="M12 11v6"></path>
        <path d="M9 20l3-3 3 3"></path>
    </svg>
</button>

<!-- Panel Desplegable -->
<div id="a11y-panel" class="singki-a11y-panel" style="position: fixed; bottom: 90px; left: 24px; width: 320px; background: #ffffff; border-radius: 16px; z-index: 99999; box-shadow: 0 20px 40px rgba(0,0,0,0.18); border: 1px solid #e5e7eb; display: block; overflow: hidden;">
    <!-- Cabecera -->
    <div style="background-color: #040116; color: #ffffff; padding: 14px 20px; display: flex; align-items: center; justify-content: space-between;">
        <h2 style="font-weight: bold; font-size: 15px; margin: 0; display: flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 6a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"></path>
                <path d="M7 11h10"></path>
                <path d="M12 11v6"></path>
                <path d="M9 20l3-3 3 3"></path>
            </svg>
            Accesibilidad SINGKI
        </h2>
        <button id="a11y-close-btn" style="background: none; border: none; color: #ffffff; font-size: 20px; cursor: pointer; line-height: 1;">&times;</button>
    </div>
    
    <!-- Contenido -->
    <div style="padding: 20px; max-height: 70vh; overflow-y: auto;">
        
        <!-- Tamaño de texto -->
        <div style="margin-bottom: 20px;">
            <h3 style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px; margin-top: 0;">Tamaño de Texto</h3>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px;">
                <button data-a11y-action="text-size" data-value="95" class="a11y-text-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 0; font-size: 14px; font-weight: 500; cursor: pointer;">A-</button>
                <button data-a11y-action="text-size" data-value="100" class="a11y-text-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 0; font-size: 14px; font-weight: 500; cursor: pointer;">A</button>
                <button data-a11y-action="text-size" data-value="110" class="a11y-text-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 0; font-size: 14px; font-weight: 500; cursor: pointer;">A+</button>
                <button data-a11y-action="text-size" data-value="120" class="a11y-text-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 0; font-size: 14px; font-weight: 500; cursor: pointer;">A++</button>
            </div>
        </div>

        <!-- Ajustes Visuales -->
        <div style="margin-bottom: 20px;">
            <h3 style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px; margin-top: 0;">Ajustes Visuales</h3>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                <button data-a11y-action="toggle" data-class="a11y-contrast" class="a11y-toggle-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1F51FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 2a10 10 0 0 0 0 20z"></path>
                    </svg>
                    Alto Contraste
                </button>
                <button data-a11y-action="toggle" data-class="a11y-grayscale" class="a11y-toggle-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1F51FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"></path>
                    </svg>
                    Escala de Grises
                </button>
                <button data-a11y-action="toggle" data-class="a11y-dyslexia" class="a11y-toggle-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1F51FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    Lectura Fácil
                </button>
                <button data-a11y-action="toggle" data-class="a11y-links" class="a11y-toggle-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1F51FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                    Resaltar Enlaces
                </button>
                <button data-a11y-action="toggle" data-class="a11y-no-motion" class="a11y-toggle-btn a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1F51FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="10" y1="15" x2="10" y2="9"></line>
                        <line x1="14" y1="15" x2="14" y2="9"></line>
                    </svg>
                    Pausar Animaciones
                </button>
                <button id="a11y-voice-btn" class="a11y-btn-inactive" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1F51FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                    </svg>
                    Lector de Voz
                </button>
            </div>
        </div>

        <!-- Restablecer -->
        <button id="a11y-reset-btn" style="width: 100%; margin-top: 8px; padding: 12px; border-radius: 12px; background-color: #f3f4f6; color: #374151; border: none; font-weight: 500; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                <path d="M3 3v5h5"></path>
            </svg>
            Restablecer valores
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('a11y-toggle-btn');
    const panel = document.getElementById('a11y-panel');
    const closeBtn = document.getElementById('a11y-close-btn');
    const resetBtn = document.getElementById('a11y-reset-btn');
    const textBtns = document.querySelectorAll('.a11y-text-btn');
    const toggleBtns = document.querySelectorAll('.a11y-toggle-btn');
    const voiceBtn = document.getElementById('a11y-voice-btn');

    // Estado local
    let state = JSON.parse(localStorage.getItem('singki-a11y')) || {
        textSize: 100,
        classes: [],
        voice: false
    };

    // Aplicar estado inicial
    applyState();

    // Mostrar / Ocultar panel
    const togglePanel = () => {
        panel.classList.toggle('singki-a11y-open');
        toggleBtn.classList.toggle('singki-a11y-btn-active');
    };

    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        togglePanel();
    });
    
    closeBtn.addEventListener('click', () => {
        panel.classList.remove('singki-a11y-open');
        toggleBtn.classList.remove('singki-a11y-btn-active');
    });

    // Cierre suave al hacer clic fuera
    document.addEventListener('click', (e) => {
        if (panel.classList.contains('singki-a11y-open')) {
            if (!panel.contains(e.target) && !toggleBtn.contains(e.target)) {
                panel.classList.remove('singki-a11y-open');
                toggleBtn.classList.remove('singki-a11y-btn-active');
            }
        }
    });

    // Cierre suave con Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && panel.classList.contains('singki-a11y-open')) {
            panel.classList.remove('singki-a11y-open');
            toggleBtn.classList.remove('singki-a11y-btn-active');
        }
    });

    // Tamaño de texto
    textBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            state.textSize = parseInt(this.getAttribute('data-value'));
            saveAndApply();
        });
    });

    // Clases toggles
    toggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const cls = this.getAttribute('data-class');
            if(state.classes.includes(cls)) {
                state.classes = state.classes.filter(c => c !== cls);
            } else {
                state.classes.push(cls);
            }
            saveAndApply();
        });
    });

    // Lector de voz (Activación manual)
    voiceBtn.addEventListener('click', function() {
        state.voice = !state.voice;
        
        window.speechSynthesis.cancel();
        
        if (state.voice) {
            const utterance = new SpeechSynthesisUtterance("Lector de voz activado. Pasa el cursor sobre cualquier texto o botón para escucharlo.");
            utterance.lang = 'es-ES';
            window.speechSynthesis.speak(utterance);
        } else {
            const utterance = new SpeechSynthesisUtterance("Lector de voz desactivado.");
            utterance.lang = 'es-ES';
            window.speechSynthesis.speak(utterance);
            
            if(lastElement) {
                lastElement.classList.remove('a11y-reading-highlight');
                lastElement = null;
            }
        }
        
        saveAndApply();
    });

    // Restablecer
    resetBtn.addEventListener('click', function() {
        if (state.voice) {
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance("Lector de voz desactivado.");
            utterance.lang = 'es-ES';
            window.speechSynthesis.speak(utterance);
        } else {
            window.speechSynthesis.cancel();
        }
        
        if(lastElement) {
            lastElement.classList.remove('a11y-reading-highlight');
            lastElement = null;
        }
        
        state = { textSize: 100, classes: [], voice: false };
        saveAndApply();
    });

    // Funciones Helper
    function saveAndApply() {
        localStorage.setItem('singki-a11y', JSON.stringify(state));
        applyState();
    }

    function applyState() {
        // Texto
        document.documentElement.style.fontSize = state.textSize + '%';
        textBtns.forEach(btn => {
            if(parseInt(btn.getAttribute('data-value')) === state.textSize) {
                btn.classList.add('a11y-btn-active');
                btn.classList.remove('a11y-btn-inactive');
            } else {
                btn.classList.remove('a11y-btn-active');
                btn.classList.add('a11y-btn-inactive');
            }
        });

        // Clases HTML
        ['a11y-contrast', 'a11y-grayscale', 'a11y-dyslexia', 'a11y-links', 'a11y-no-motion'].forEach(cls => {
            document.documentElement.classList.remove(cls);
        });
        state.classes.forEach(cls => {
            document.documentElement.classList.add(cls);
        });

        toggleBtns.forEach(btn => {
            const cls = btn.getAttribute('data-class');
            if(state.classes.includes(cls)) {
                btn.classList.add('a11y-btn-active');
                btn.classList.remove('a11y-btn-inactive');
            } else {
                btn.classList.remove('a11y-btn-active');
                btn.classList.add('a11y-btn-inactive');
            }
        });

        // Voz
        if(state.voice) {
            voiceBtn.classList.add('a11y-btn-active');
            voiceBtn.classList.remove('a11y-btn-inactive');
        } else {
            voiceBtn.classList.remove('a11y-btn-active');
            voiceBtn.classList.add('a11y-btn-inactive');
        }
    }

    // Lector de voz en hover/focus
    let lastSpokenText = null;
    let lastElement = null;
    let voiceTimeout = null;

    document.addEventListener('mouseover', handleVoiceEvent);
    document.addEventListener('focusin', handleVoiceEvent);

    function handleVoiceEvent(e) {
        if(!state.voice) return;
        
        // Elementos interactivos o bloques de texto legibles
        const target = e.target.closest('h1, h2, h3, h4, h5, h6, p, a, button, [role="button"], label, span, input, textarea');
        if(!target) return;
        
        if(target === lastElement) return;

        clearTimeout(voiceTimeout);

        voiceTimeout = setTimeout(() => {
            let text = target.getAttribute('aria-label') || target.placeholder || target.innerText || target.textContent;
            
            if(text && text.trim() !== '') {
                text = text.trim();
                
                if(text !== lastSpokenText || target !== lastElement) {
                    window.speechSynthesis.cancel();
                    
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = 'es-ES';
                    
                    utterance.onstart = () => {
                        if(lastElement) {
                            lastElement.classList.remove('a11y-reading-highlight');
                        }
                        lastElement = target;
                        lastElement.classList.add('a11y-reading-highlight');
                    };
                    
                    utterance.onend = () => {
                        if(lastElement === target) {
                            lastElement.classList.remove('a11y-reading-highlight');
                        }
                    };

                    window.speechSynthesis.speak(utterance);
                    lastSpokenText = text;
                }
            }
        }, 250);
    }
});
</script>
@endif
