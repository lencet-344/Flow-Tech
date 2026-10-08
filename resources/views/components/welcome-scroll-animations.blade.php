<!-- resources/views/components/welcome-scroll-animations.blade.php -->
<style>
    /* ========================================================= */
    /* SINGKI - Scroll Reveal Animations (Bidirectional)         */
    /* ========================================================= */
     
    .singki-scroll-item {
        opacity: 0;
        transform: translateY(34px) scale(0.96);
        transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1), transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .singki-scroll-item.singki-above {
        opacity: 0;
        transform: translateY(-28px) scale(0.97);
    }

    .singki-scroll-item.singki-visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* Fallback de accesibilidad para Scroll */
    html.a11y-no-motion .singki-scroll-item {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
        animation: none !important;
    }

    /* ========================================================= */
    /* SINGKI BACKGROUNDS (Franja Azul Welcome)                  */
    /* ========================================================= */
    
    /* ---- MODO CUBES ---- */
    .singki-cyber-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        overflow: hidden;
        background: linear-gradient(135deg, #04021c 0%, #1d4ed8 100%);
    }

    .singki-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.6;
        animation: glowFloat 15s infinite alternate ease-in-out;
        pointer-events: none;
    }
    .singki-glow-1 {
        top: -20%; left: -10%;
        width: 60%; height: 60%;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.28) 0%, transparent 70%);
        animation-delay: 0s;
    }
    .singki-glow-2 {
        bottom: -20%; right: -10%;
        width: 70%; height: 70%;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.45) 0%, transparent 70%);
        animation-delay: -5s;
    }

    @keyframes glowFloat {
        0% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(5%, 10%) scale(1.1); }
        100% { transform: translate(-5%, -5%) scale(0.9); }
    }

    .singki-cyber-mesh {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.28' viewBox='0 0 40 69.28' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 17.32l-20 11.547L0 17.32V-5.774l20-11.547L40-5.774V17.32zm0 46.188l-20 11.548-20-11.548V40.414L20 28.867l20 11.547v23.094z' fill='none' stroke='rgba(125, 211, 252, 0.16)' stroke-width='1'/%3E%3C/svg%3E");
        background-size: 60px;
        mask-image: linear-gradient(to right, transparent 5%, black 45%, black 100%);
        -webkit-mask-image: linear-gradient(to right, transparent 5%, black 45%, black 100%);
        animation: meshPan 60s linear infinite;
        opacity: 0.7;
        pointer-events: none;
    }

    @keyframes meshPan {
        from { background-position: 0 0; }
        to { background-position: -600px 346.4px; }
    }

    .singki-floating-cube {
        position: absolute;
        border: 2px solid rgba(186, 230, 253, 0.85);
        border-radius: 3px;
        background: rgba(56, 189, 248, 0.08);
        box-shadow: 0 0 12px rgba(56, 189, 248, 0.75), inset 0 0 6px rgba(56, 189, 248, 0.35);
        animation: floatCube linear infinite;
        will-change: transform, opacity;
        pointer-events: none;
    }

    @keyframes floatCube {
        0% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0.2; }
        20% { opacity: 0.9; }
        80% { opacity: 0.9; }
        100% { transform: translateY(-150px) translateX(50px) rotate(360deg); opacity: 0.2; }
    }

    /* ---- MODO WAVE ---- */
    .singki-wave-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        overflow: hidden;
        background: linear-gradient(90deg, #02010c, #000034, #0c2478, #1F51FF, #3565fd, #000034, #02010c);
        background-size: 260% 100%;
        animation: singkiGradientFlow 12s linear infinite;
    }

    @keyframes singkiGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: -260% 50%; }
    }

    .singki-wave-layer {
        position: absolute;
        left: 0;
        top: 0;
        width: 200%;
        height: 100%;
        pointer-events: none;
        will-change: transform;
    }

    /* Ola Profunda Posterior */
    .singki-wave-1 {
        opacity: 0.55;
        animation: singkiWaveMove1 11s linear infinite;
    }
    @keyframes singkiWaveMove1 {
        0% { transform: translate3d(-50%, 0, 0); }
        100% { transform: translate3d(0%, 0, 0); }
    }

    /* Ola Media Eléctrica */
    .singki-wave-2 {
        animation: singkiWaveMove2 8s linear infinite;
    }
    @keyframes singkiWaveMove2 {
        0% { transform: translate3d(-50%, 0, 0) scaleY(1); }
        50% { transform: translate3d(-25%, 3%, 0) scaleY(1.05); }
        100% { transform: translate3d(0%, 0, 0) scaleY(1); }
    }

    /* Ola Frontal Sutil */
    .singki-wave-3 {
        opacity: 0.6;
        animation: singkiWaveMove3 14s linear infinite;
    }
    @keyframes singkiWaveMove3 {
        0% { transform: translate3d(-50%, 0, 0); }
        100% { transform: translate3d(0%, 0, 0); }
    }

    /* ---- MODO NEBULA ---- */
    .singki-nebula-banner {
        overflow: visible !important;
        position: relative;
        z-index: 30;
    }
    .singki-banner-fx {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }
    .singki-nebula-bg {
        position: absolute; inset: 0; z-index: 1; pointer-events: none; overflow: hidden; background: #010112;
    }
    .singki-nebula-orb {
        position: absolute; border-radius: 50%; filter: blur(32px); will-change: transform, opacity; pointer-events: none;
    }
    
    .singki-orb-1 {
        width: 420px; height: 260px; left: 10%; top: 20%;
        background: radial-gradient(ellipse at center, rgba(173, 254, 255, 0.92) 0%, rgba(56, 189, 248, 0.55) 45%, transparent 72%);
        animation: singkiNebulaMove1 7s ease-in-out infinite alternate;
        z-index: 2;
    }
    @keyframes singkiNebulaMove1 { 0% { transform: translate3d(0, 0, 0) scale(0.85); } 100% { transform: translate3d(280px, 80px, 0) scale(1.35); } }
    
    .singki-orb-2 {
        width: 520px; height: 300px; right: 5%; top: -10%;
        background: radial-gradient(ellipse at center, rgba(53, 101, 253, 1) 0%, rgba(31, 81, 255, 0.7) 50%, transparent 75%);
        animation: singkiNebulaMove2 8s ease-in-out infinite alternate;
        z-index: 1;
    }
    @keyframes singkiNebulaMove2 { 0% { transform: translate3d(0, 0, 0) scale(0.9); } 100% { transform: translate3d(-350px, 40px, 0) scale(1.25); } }
    
    .singki-orb-3 {
        width: 460px; height: 280px; left: 30%; top: 10%;
        background: radial-gradient(ellipse at center, rgba(1, 1, 18, 0.96) 25%, rgba(0, 0, 52, 0.85) 55%, transparent 75%);
        animation: singkiNebulaMove3 6.5s ease-in-out infinite alternate;
        z-index: 4;
    }
    @keyframes singkiNebulaMove3 { 0% { transform: translate3d(0, 0, 0) scale(1); } 100% { transform: translate3d(300px, 60px, 0) scale(1.3); } }
    
    .singki-orb-4 {
        width: 380px; height: 240px; right: 20%; bottom: 5%;
        background: radial-gradient(circle, rgba(173, 254, 255, 0.85) 0%, rgba(53, 101, 253, 0.65) 50%, transparent 72%);
        animation: singkiNebulaMove4 7.5s ease-in-out infinite alternate-reverse;
        z-index: 3;
    }
    @keyframes singkiNebulaMove4 { 0% { transform: translate3d(0, 0, 0) scale(0.85); } 100% { transform: translate3d(-220px, -90px, 0) scale(1.35); } }
    
    .singki-orb-5 {
        width: 550px; height: 280px; left: -5%; bottom: -10%;
        background: radial-gradient(ellipse at center, rgba(53, 101, 253, 0.8) 0%, rgba(0, 0, 52, 0.6) 60%, transparent 75%);
        animation: singkiNebulaMove5 9s linear infinite;
        z-index: 1;
    }
    @keyframes singkiNebulaMove5 { 
        0% { transform: translate3d(0, 0, 0) scale(1) rotate(0deg); } 
        50% { transform: translate3d(180px, -50px, 0) scale(1.2) rotate(180deg); }
        100% { transform: translate3d(0, 0, 0) scale(1) rotate(360deg); }
    }

    /* Sexta masa luminosa extra para blending fluido */
    .singki-orb-6 {
        width: 300px; height: 300px; left: 40%; top: 40%;
        background: radial-gradient(circle, rgba(31, 81, 255, 0.6) 0%, transparent 70%);
        animation: singkiNebulaMove6 8.5s ease-in-out infinite alternate;
        z-index: 2;
    }
    @keyframes singkiNebulaMove6 { 0% { transform: translate3d(0, 0, 0) scale(0.9); } 100% { transform: translate3d(-150px, 70px, 0) scale(1.3); } }

    /* Sombra Protectora Sutil de Lectura */
    .singki-text-protect {
        text-shadow: 0 2px 14px rgba(1, 1, 18, 0.75) !important;
    }

    /* Fallback Accesibilidad Backgrounds */
    html.a11y-no-motion .singki-glow,
    html.a11y-no-motion .singki-cyber-mesh,
    html.a11y-no-motion .singki-floating-cube,
    html.a11y-no-motion .singki-wave-bg,
    html.a11y-no-motion .singki-wave-layer,
    html.a11y-no-motion .singki-nebula-orb {
        animation-play-state: paused !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // =========================================================================
    // CONFIGURACIÓN GLOBAL
    // =========================================================================
    const SINGKI_BANNER_MODE = 'nebula'; // Opciones: 'nebula' | 'wave' | 'cubes'

    const isExplorar = window.location.pathname.includes('/explorar');
    const isWelcome = window.location.pathname === '/' || window.location.pathname === '';

    // =========================================================================
    // MODULO: FONDO ANIMADO FRANJA AZUL (Solo para Welcome /)
    // =========================================================================
    @auth
    if (isWelcome) {
        const headers = Array.from(document.querySelectorAll('h1, h2, h3, p')).filter(el => {
            const text = el.textContent.toLowerCase();
            return text.includes('¡hola') || text.includes('¿qué estás buscando hoy') || text.includes('encuentra lo que necesitas');
        });
        
        let heroSection = null;
        if (headers.length > 0) {
            heroSection = headers[0].closest('section') || headers[0].closest('.bg-blue-600') || headers[0].closest('.bg-[#2563eb]');
        }
        
        if (!heroSection) {
            heroSection = document.querySelector('section.bg-blue-600, section.bg-blue-700, section.bg-[#2563eb], header + section');
        }

        if (heroSection && !heroSection.querySelector('.singki-cyber-bg') && !heroSection.querySelector('.singki-wave-bg') && !heroSection.querySelector('.singki-nebula-bg')) {
            // 1. Proteger el contenedor padre y permitir overflow visible
            heroSection.classList.add('singki-nebula-banner');
            heroSection.style.position = 'relative';
            heroSection.style.overflow = 'visible';
            heroSection.classList.remove('bg-blue-600', 'bg-[#2563eb]', 'bg-blue-700', 'bg-blue-900', 'overflow-hidden');
            
            // 2. Proteger hijos inmediatos (texto y buscador)
            Array.from(heroSection.children).forEach(child => {
                const pos = window.getComputedStyle(child).position;
                if (pos === 'static') {
                    child.style.position = 'relative';
                }
                child.style.zIndex = '10';
            });

            if (SINGKI_BANNER_MODE === 'cubes') {
                // ----------------------------------------------------
                // MODO CUBES (Hexágonos y cubos luminosos)
                // ----------------------------------------------------
                const cyberBg = document.createElement('div');
                cyberBg.className = 'singki-cyber-bg singki-banner-fx';
                
                const glow1 = document.createElement('div'); glow1.className = 'singki-glow singki-glow-1';
                const glow2 = document.createElement('div'); glow2.className = 'singki-glow singki-glow-2';
                const mesh = document.createElement('div'); mesh.className = 'singki-cyber-mesh';
                
                cyberBg.appendChild(glow1);
                cyberBg.appendChild(glow2);
                cyberBg.appendChild(mesh);
                
                const numCubes = Math.floor(Math.random() * 4) + 12; // 12 a 15
                for (let i = 0; i < numCubes; i++) {
                    const cube = document.createElement('div');
                    cube.className = 'singki-floating-cube';
                    
                    const size = Math.floor(Math.random() * 21) + 14; 
                    const left = Math.random() * 100; 
                    const top = Math.random() * 100; 
                    const duration = Math.random() * 7 + 6; 
                    const delay = -(Math.random() * 15); 
                    
                    cube.style.width = size + 'px';
                    cube.style.height = size + 'px';
                    cube.style.left = left + '%';
                    cube.style.top = top + '%';
                    cube.style.animationDuration = duration + 's';
                    cube.style.animationDelay = delay + 's';
                    
                    cyberBg.appendChild(cube);
                }
                
                heroSection.insertBefore(cyberBg, heroSection.firstChild);

            } else if (SINGKI_BANNER_MODE === 'wave') {
                // ----------------------------------------------------
                // MODO WAVE (Ola degradada de izquierda a derecha)
                // ----------------------------------------------------
                const waveBg = document.createElement('div');
                waveBg.className = 'singki-wave-bg singki-banner-fx';
                
                waveBg.innerHTML = `
                    <svg style="width:0;height:0;position:absolute;">
                        <defs>
                            <linearGradient id="singkiWaveGrad1" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#1e40af" />
                                <stop offset="100%" stop-color="#000022" />
                            </linearGradient>
                            <linearGradient id="singkiWaveGrad2" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="rgba(53, 101, 253, 0.65)" />
                                <stop offset="100%" stop-color="rgba(5, 8, 45, 0.7)" />
                            </linearGradient>
                            <linearGradient id="singkiWaveGrad3" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="rgba(173, 254, 255, 0.14)" />
                                <stop offset="100%" stop-color="rgba(31, 81, 255, 0.35)" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <!-- Ola Profunda Posterior -->
                    <svg class="singki-wave-layer singki-wave-1" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path fill="url(#singkiWaveGrad1)" d="M0,60 C150,100 350,20 500,60 C650,100 850,20 1000,60 L1000,100 L0,100 Z" />
                    </svg>
                    <!-- Ola Media Eléctrica -->
                    <svg class="singki-wave-layer singki-wave-2" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path fill="url(#singkiWaveGrad2)" d="M0,70 C150,30 350,110 500,70 C650,30 850,110 1000,70 L1000,100 L0,100 Z" />
                    </svg>
                    <!-- Ola Frontal de Brillo Sutil -->
                    <svg class="singki-wave-layer singki-wave-3" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path fill="url(#singkiWaveGrad3)" d="M0,80 C150,110 350,50 500,80 C650,110 850,50 1000,80 L1000,100 L0,100 Z" />
                    </svg>
                `;
                
                heroSection.insertBefore(waveBg, heroSection.firstChild);
            } else if (SINGKI_BANNER_MODE === 'nebula') {
                // ----------------------------------------------------
                // MODO NEBULA (Nebulosa difuminada orgánica)
                // ----------------------------------------------------
                const nebulaBg = document.createElement('div');
                nebulaBg.className = 'singki-nebula-bg singki-banner-fx';
                
                nebulaBg.innerHTML = `
                    <div class="singki-nebula-orb singki-orb-5"></div>
                    <div class="singki-nebula-orb singki-orb-2"></div>
                    <div class="singki-nebula-orb singki-orb-1"></div>
                    <div class="singki-nebula-orb singki-orb-6"></div>
                    <div class="singki-nebula-orb singki-orb-4"></div>
                    <div class="singki-nebula-orb singki-orb-3"></div>
                `;
                
                heroSection.insertBefore(nebulaBg, heroSection.firstChild);

                // Aplicar sombra protectora a los textos principales del hero
                const mainTexts = heroSection.querySelectorAll('h1, h2, h3, p, span');
                mainTexts.forEach(el => {
                    el.classList.add('singki-text-protect');
                    el.style.zIndex = '10';
                    if(window.getComputedStyle(el).position === 'static') {
                        el.style.position = 'relative';
                    }
                });
            }
        }
    }
    @endauth

    // =========================================================================
    // MODULO: ANIMACIONES SCROLL REVEAL BIDIRECCIONALES
    // =========================================================================
    if (isExplorar) {
        const scrollContainer = document.querySelector('main div.overflow-y-auto, div.overflow-y-auto');
        const asideFilter = document.querySelector('aside');
        
        if (scrollContainer && asideFilter) {
            const adjustHeight = () => {
                const asideRect = asideFilter.getBoundingClientRect();
                const newHeight = Math.max(asideRect.height, 740);
                scrollContainer.style.minHeight = newHeight + 'px';
            };
            
            const resizeObserver = new ResizeObserver(() => adjustHeight());
            resizeObserver.observe(asideFilter);
            
            adjustHeight();
            window.addEventListener('resize', adjustHeight);
            
            const businessCards = scrollContainer.querySelectorAll('div[class*="grid"] > a, div[class*="grid"] > div');
            
            let indexMap = new Map();
            businessCards.forEach(item => {
                item.classList.add('singki-scroll-item');
                
                const parent = item.parentElement;
                if (parent) {
                    if (!indexMap.has(parent)) indexMap.set(parent, 0);
                    const currentIndex = indexMap.get(parent);
                    const delay = (currentIndex % 2) * 80;
                    item.style.transitionDelay = delay + 'ms';
                    indexMap.set(parent, currentIndex + 1);
                }
            });
            
            const observerOptions = {
                root: scrollContainer,
                rootMargin: '0px 0px -20px 0px',
                threshold: 0.05
            };
            
            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const el = entry.target;
                    if (entry.isIntersecting) {
                        el.classList.add('singki-visible');
                        el.classList.remove('singki-above');
                    } else {
                        el.classList.remove('singki-visible');
                        const rootTop = entry.rootBounds ? entry.rootBounds.top : 0;
                        if (entry.boundingClientRect.top < rootTop) {
                            el.classList.add('singki-above');
                        } else {
                            el.classList.remove('singki-above');
                        }
                    }
                });
            }, observerOptions);
            
            businessCards.forEach(el => scrollObserver.observe(el));
        }

    } else {
        const excludedSelectors = [
            'header', 'header *',
            'nav', 'nav *',
            'footer', 'footer *',
            '#singki-loader', '#singki-loader *',
            '[id*="modal"]', '[id*="modal"] *',
            '[style*="position: fixed"]', '[style*="position: fixed"] *',
            '.fixed', '.fixed *',
            '[x-data*="active"] > div.flex > div',
            '[x-data*="active"] > div.flex > div *'
        ].join(', ');

        const includeSelectors = [
            'section h1', 'section h2', 'section h3', 'section p',
            'div.bg-white > h2', 'div.bg-white > p',
            'div.text-center > h2', 'div.text-center > p',
            'form',
            'section span.inline-block', 'section div.inline-flex',
            'section img',
            'div[class*="grid"] > *',
            '.space-y-5 > div',
            '.flex.gap-4 > a',
            '.flex.flex-wrap > .bg-white.rounded-full'
        ].join(', ');

        const possibleItems = document.querySelectorAll(includeSelectors);
        let indexMap = new Map();

        possibleItems.forEach(item => {
            if (item.matches(excludedSelectors) || item.closest(excludedSelectors)) return;
            if (window.getComputedStyle(item).display === 'none') return;

            item.classList.add('singki-scroll-item');

            const parent = item.parentElement;
            if (parent) {
                if (!indexMap.has(parent)) indexMap.set(parent, 0);
                const currentIndex = indexMap.get(parent);
                const delay = (currentIndex % 4) * 70;
                item.style.transitionDelay = delay + 'ms';
                indexMap.set(parent, currentIndex + 1);
            }
        });

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.05
        };

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const el = entry.target;
                if (entry.isIntersecting) {
                    el.classList.add('singki-visible');
                    el.classList.remove('singki-above');
                } else {
                    el.classList.remove('singki-visible');
                    if (entry.boundingClientRect.top < 0) {
                        el.classList.add('singki-above');
                    } else {
                        el.classList.remove('singki-above');
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.singki-scroll-item').forEach(el => scrollObserver.observe(el));

        // Re-check after splash screen loader might have finished (fallback to ensure no items get stuck)
        setTimeout(() => {
            document.querySelectorAll('.singki-scroll-item').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    el.classList.add('singki-visible');
                    el.classList.remove('singki-above');
                }
            });
        }, 3600); // 3500ms loader + 100ms
    }
});
</script>
