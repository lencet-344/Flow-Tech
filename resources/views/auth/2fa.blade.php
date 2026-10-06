<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINGKI</title>
    <!-- Cargamos Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-indigo-500 to-purple-600 font-sans antialiased p-4">

    <!-- Tarjeta Principal (Blanca) -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10 text-center">

        <!-- Ícono Morado (Huella) -->
        <div class="mx-auto bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-inner">
            <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
            </svg>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">Verificación de Seguridad</h2>
        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
            Hemos enviado un código de 6 dígitos a tu correo electrónico. Por favor, ingrésalo para continuar.
        </p>

        <!-- Formulario de Verificación -->
        <form id="singki-2fa-form" method="POST" action="{{ route('2fa.verify') }}">
            @csrf
            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Ingresa tu código</label>
                
                <style>
                    .singki-otp-cube {
                        width: 46px; height: 54px; 
                        border-radius: 12px; border: 2px solid #cbd5e1; 
                        background: #f8fafc; font-size: 22px; font-weight: 800; 
                        color: #0f172a; text-align: center; outline: none; 
                        transition: all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
                        position: relative; z-index: 1; margin: 0; padding: 0;
                    }
                    .singki-otp-cube:focus, .singki-otp-cube.has-value {
                        border-color: #4f46e5 !important; background: #ffffff !important; 
                        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15), 0 0 14px rgba(59, 130, 246, 0.35) !important; 
                        transform: scale(1.04); z-index: 2;
                    }
                    .singki-otp-cube.error {
                        border-color: #ef4444 !important; background: #fef2f2 !important;
                    }
                    @keyframes singkiSpin {
                        100% { transform: rotate(360deg); }
                    }
                    .singki-check-visible { stroke-dashoffset: 0 !important; opacity: 1 !important; }
                    @keyframes singkiShake {
                        0%, 100% { transform: translateX(0); }
                        20%, 60% { transform: translateX(-4px); }
                        40%, 80% { transform: translateX(4px); }
                    }
                    .singki-shake { animation: singkiShake 0.4s cubic-bezier(.36,.07,.19,.97) both !important; }
                    .singki-particle { position: absolute; width: 6px; height: 6px; background: #10b981; border-radius: 50%; opacity: 0; pointer-events: none; z-index: 5; }
                </style>

                <input type="hidden" name="code" id="singki-2fa-hidden-input" value="">
                
                <div id="singki-otp-container" style="height: 76px; position: relative; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <input type="text" inputmode="numeric" maxlength="1" class="singki-otp-cube" autofocus autocomplete="one-time-code">
                    <input type="text" inputmode="numeric" maxlength="1" class="singki-otp-cube">
                    <input type="text" inputmode="numeric" maxlength="1" class="singki-otp-cube">
                    <input type="text" inputmode="numeric" maxlength="1" class="singki-otp-cube">
                    <input type="text" inputmode="numeric" maxlength="1" class="singki-otp-cube">
                    <input type="text" inputmode="numeric" maxlength="1" class="singki-otp-cube">
                    
                    <!-- Cubo fusionado central oculto -->
                    <div id="singki-merged-cube" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%) scale(0); width: 56px; height: 62px; border-radius: 14px; background: #ffffff; border: 2px solid #4f46e5; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15), 0 0 14px rgba(59, 130, 246, 0.35); opacity: 0; pointer-events: none; z-index: 20; display: flex; align-items: center; justify-content: center; transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);">
                        <div id="singki-merged-loading" style="position: absolute; inset: -4px; border-radius: 16px; border: 2px solid transparent; border-top-color: #4f46e5; border-bottom-color: #4f46e5; animation: singkiSpin 1s linear infinite; display: none;"></div>
                        <svg id="singki-success-check" style="position: absolute; width: 28px; height: 28px; stroke: white; stroke-width: 3; fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-dasharray: 40; stroke-dashoffset: 40; opacity: 0; transition: stroke-dashoffset 0.4s ease, opacity 0.2s;" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                </div>

                <p id="singki-2fa-error" class="text-red-500 text-sm mt-3 font-semibold" style="display: none;"></p>
                @if($errors->any())
                    <p id="singki-server-error" class="text-red-500 text-sm mt-3 font-semibold">{{ $errors->first() }}</p>
                @endif

            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-indigo-300 transform hover:-translate-y-1">
                Verificar y Acceder
            </button>
        </form>

        <!-- Botón de regreso -->
        <div class="mt-8 pt-6 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-medium text-gray-400 hover:text-indigo-600 transition-colors">
                    &larr; Volver al inicio de sesión
                </button>
            </form>
        </div>

    </div>

    <script>
    (function() {
        const form = document.getElementById('singki-2fa-form');
        const container = document.getElementById('singki-otp-container');
        const cubes = Array.from(container.querySelectorAll('.singki-otp-cube'));
        const hiddenInput = document.getElementById('singki-2fa-hidden-input');
        const submitBtn = form.querySelector('button[type="submit"]');
        const errorText = document.getElementById('singki-2fa-error');
        const serverError = document.getElementById('singki-server-error');
        const mergedCube = document.getElementById('singki-merged-cube');
        const mergedLoading = document.getElementById('singki-merged-loading');
        const checkSvg = document.getElementById('singki-success-check');
        let isSubmitting = false;

        const updateHidden = () => {
            let val = '';
            cubes.forEach(c => {
                val += c.value;
                if(c.value) c.classList.add('has-value');
                else c.classList.remove('has-value');
                c.classList.remove('error');
            });
            hiddenInput.value = val;
            errorText.style.display = 'none';
            if(serverError) serverError.style.display = 'none';
            return val.length === 6;
        };

        cubes.forEach((cube, index) => {
            cube.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    if (!cube.value && index > 0) {
                        cubes[index - 1].value = '';
                        cubes[index - 1].focus();
                        updateHidden();
                    }
                } else if (e.key === 'ArrowLeft' && index > 0) {
                    cubes[index - 1].focus();
                } else if (e.key === 'ArrowRight' && index < 5) {
                    cubes[index + 1].focus();
                }
            });

            cube.addEventListener('input', (e) => {
                let val = cube.value.replace(/\D/g, '');
                cube.value = val.slice(-1); 
                
                if (cube.value && index < 5) {
                    cubes[index + 1].focus();
                    cubes[index + 1].select();
                }
                if(updateHidden() && !isSubmitting) {
                    setTimeout(startValidation, 150);
                }
            });
        });

        const handlePaste = (e) => {
            const clipboard = (e.clipboardData || window.clipboardData).getData('text');
            const pasted = clipboard.replace(/\D/g, '').slice(0, 6);
            if (!pasted) return;
            
            e.preventDefault();
            
            for (let j = 0; j < pasted.length; j++) {
                cubes[j].value = pasted[j];
            }
            
            const nextIndex = Math.min(pasted.length, 5);
            cubes[nextIndex].focus();
            
            if(updateHidden() && !isSubmitting && pasted.length === 6) {
                setTimeout(startValidation, 150);
            }
        };

        cubes.forEach(c => c.addEventListener('paste', handlePaste));
        document.addEventListener('paste', (e) => {
            if(document.activeElement.classList.contains('singki-otp-cube')) return;
            handlePaste(e);
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if(!isSubmitting && hiddenInput.value.length === 6) startValidation();
            else if (hiddenInput.value.length < 6) {
                errorText.innerText = "El campo código de verificación es obligatorio.";
                errorText.style.display = 'block';
            }
        });

        async function startValidation() {
            if(isSubmitting) return;
            isSubmitting = true;
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';

            // Guardar rects antes del absolute
            const rects = cubes.map(c => ({ left: c.offsetLeft, top: c.offsetTop }));
            
            cubes.forEach((c, i) => {
                c.style.position = 'absolute';
                c.style.left = rects[i].left + 'px';
                c.style.top = rects[i].top + 'px';
                c.style.transformOrigin = 'bottom center';
                c.style.zIndex = '10';
            });

            void container.offsetWidth; // Forzar reflow

            // FASE 1: Abanico (420ms)
            const angles = [-12, -7, -2, 2, 7, 12];
            const centerX = container.offsetWidth / 2;
            
            cubes.forEach((c, i) => {
                const myCenterX = rects[i].left + 23;
                const distanceToCenter = centerX - myCenterX;
                const moveX = distanceToCenter * 0.4;
                c.style.transform = `translateX(${moveX}px) rotate(${angles[i]}deg) scale(1.05)`;
            });

            await new Promise(r => setTimeout(r, 420));

            // FASE 2: Colapso en Cubo Central + Luz de Escaneo (550ms)
            cubes.forEach((c) => {
                const myCenterX = c.offsetLeft + 23;
                const distanceToCenter = centerX - myCenterX;
                c.style.transform = `translateX(${distanceToCenter}px) rotate(0deg) scale(0.4)`;
                c.style.opacity = '0';
            });

            mergedCube.style.transform = 'translate(-50%, -50%) scale(1)';
            mergedCube.style.opacity = '1';
            mergedLoading.style.display = 'block';

            // Delay visual para ver el escaneo
            await new Promise(r => setTimeout(r, 550));

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin',
                    redirect: 'follow',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });

                const finalUrl = new URL(response.url);
                const currentUrl = new URL(window.location.href);
                const isSuccess = response.ok && response.redirected && !response.url.includes('verificacion-2fa') && finalUrl.pathname !== currentUrl.pathname;

                if (isSuccess) {
                    // FASE 3: Éxito
                    mergedLoading.style.display = 'none';
                    mergedCube.style.background = '#10b981';
                    mergedCube.style.borderColor = '#10b981';
                    mergedCube.style.boxShadow = '0 0 24px rgba(16, 185, 129, 0.55)';
                    
                    checkSvg.style.strokeDashoffset = '0';
                    checkSvg.style.opacity = '1';
                    
                    for(let i=0; i<8; i++) {
                        const p = document.createElement('div');
                        p.className = 'singki-particle';
                        p.style.left = 'calc(50% - 3px)'; p.style.top = 'calc(50% - 3px)';
                        container.appendChild(p);
                        
                        const angle = (i / 8) * Math.PI * 2;
                        const tx = Math.cos(angle) * 45; const ty = Math.sin(angle) * 45;
                        const anim = p.animate([{ transform: 'translate(0,0) scale(1)', opacity: 1 }, { transform: `translate(${tx}px, ${ty}px) scale(0)`, opacity: 0 }], { duration: 600, easing: 'cubic-bezier(0, .9, .57, 1)' });
                        anim.onfinish = () => p.remove();
                    }

                    setTimeout(() => { window.location.href = response.url; }, 1100);
                } else {
                    handleError();
                }
            } catch (err) {
                handleError();
            }
        }

        function handleError() {
            // FASE 3: Error
            mergedCube.style.transform = 'translate(-50%, -50%) scale(0)';
            mergedCube.style.opacity = '0';
            mergedLoading.style.display = 'none';
            
            cubes.forEach((c) => {
                c.style.position = 'relative';
                c.style.left = 'auto'; c.style.top = 'auto';
                c.style.transform = 'none';
                c.style.opacity = '1';
                c.value = '';
                c.classList.remove('has-value');
                c.classList.add('error');
                
                // Vibración
                void c.offsetWidth;
                c.classList.add('singki-shake');
            });
            
            setTimeout(() => cubes.forEach(c => c.classList.remove('singki-shake')), 400);
            
            errorText.innerText = "El código ingresado es incorrecto. Inténtalo nuevamente.";
            errorText.style.display = 'block';
            hiddenInput.value = ''; 
            cubes[0].focus();
            isSubmitting = false; 
            submitBtn.disabled = false; 
            submitBtn.style.opacity = '1';
        }
    })();
    </script>
</body>
</html>