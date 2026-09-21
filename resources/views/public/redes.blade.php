<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redes Sociales - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#3565fd] min-h-screen flex flex-col items-center justify-center font-sans relative px-4 selection:bg-[#000034] selection:text-[#adfeff]">
    
    <!-- Contenedor Maestro -->
    <div class="w-full max-w-[340px] mx-auto mt-8 relative">
        
        <!-- Tarjeta Blanca (Termina exactamente antes de los botones) -->
        <div class="bg-white rounded-[36px] pt-[70px] pb-10 px-8 text-center relative shadow-lg">
            
            <!-- Logo Flotante (Mitad exacta adentro, mitad afuera) con fondo Azul Oficial -->
            <div class="absolute -top-[55px] left-1/2 transform -translate-x-1/2 w-[110px] h-[110px] rounded-full overflow-hidden shadow-lg bg-[#3565fd]">
                <img src="{{ asset('images/logo-degradado.jpg') }}" alt="Logo SINGKI" class="w-full h-full object-cover">
            </div>

            <!-- Textos Centrales -->
            <h1 class="text-[32px] font-bold text-[#000034] mb-0 tracking-tight">Singki</h1>
            <h2 class="text-[16px] font-medium text-slate-800 mb-3">Plataforma Web</h2>
            
            <!-- Línea separadora Azul Oscuro Oficial -->
            <div class="w-8 h-[2px] bg-[#000034] mx-auto mb-5"></div>
            
            <p class="text-slate-600 text-[14px] font-normal leading-relaxed">
                Descubre SINGKI y sé parte de una red de oportunidades.
            </p>
        </div>

        <!-- Botones (Fondo Azul Oscuro y Letras Turquesas) -->
        <div class="space-y-4 relative z-10 -mt-7 px-4">
            <!-- Instagram -->
            <a href="https://www.instagram.com/singki_nicaragua" target="_blank" rel="noopener noreferrer" class="block w-full bg-[#000034] hover:bg-[#000034]/90 text-[#adfeff] font-bold tracking-[0.2em] text-[12px] py-4 rounded-full text-center transition-all shadow-md">
                INSTAGRAM
            </a>
            
            <!-- TikTok -->
            <a href="https://www.tiktok.com/@singki_nic" target="_blank" rel="noopener noreferrer" class="block w-full bg-[#000034] hover:bg-[#000034]/90 text-[#adfeff] font-bold tracking-[0.2em] text-[12px] py-4 rounded-full text-center transition-all shadow-md">
                TIKTOK
            </a>
            
            <!-- Facebook -->
            <a href="https://www.facebook.com/people/Singki/61594748900357/?rdid=kK3pfaqvFubnGsNB&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1Dc2EWeyVH%2F" target="_blank" rel="noopener noreferrer" class="block w-full bg-[#000034] hover:bg-[#000034]/90 text-[#adfeff] font-bold tracking-[0.2em] text-[12px] py-4 rounded-full text-center transition-all shadow-md">
                FACEBOOK
            </a>
        </div>
    </div>

    <!-- Texto de pie de página (@singki_nic) -->
    <div class="mt-12 text-white font-medium text-[15px] tracking-wide text-center">
        @singki_nic
    </div>

</body>
</html>