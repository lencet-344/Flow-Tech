<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones - SINGKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-[#f8fafc] font-sans antialiased text-[#040116] min-h-screen flex flex-col">

    <!-- Navegación Superior -->
    <nav class="bg-white border-b border-gray-100 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
                <img src="{{ asset('images/LogoBlanco.png') }}" alt="Logo SINGKI" class="h-8 w-auto object-contain">
                <span class="font-black text-2xl text-[#2563eb] tracking-tighter">SINGKI</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-[#1F51FF] transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al inicio
            </a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full">
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8 sm:p-12">
            
            <div class="text-center mb-10 border-b border-gray-100 pb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#040116] tracking-tight mb-4">Términos y Condiciones de Uso</h1>
                <p class="text-gray-500 text-sm">Última actualización: Septiembre 2026</p>
            </div>

            <div class="space-y-8 text-sm text-gray-600 leading-relaxed">
                <section>
                    <h2 class="text-xl font-bold text-[#040116] mb-3">1. Uso de la plataforma</h2>
                    <p>Bienvenido a SINGKI. Al acceder y utilizar nuestra plataforma, aceptas estar sujeto a estos términos. SINGKI es un mercado B2B y directorio de servicios diseñado para conectar proveedores y clientes de manera eficiente. Nos reservamos el derecho de suspender o eliminar cuentas que incumplan nuestras normativas de convivencia y transparencia.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#040116] mb-3">2. Perfiles de proveedores y emprendedores</h2>
                    <p>Los negocios registrados son responsables de mantener la exactitud de su inventario, precios y descripciones de servicios. SINGKI no se hace responsable por transacciones fallidas debido a información incorrecta provista por los vendedores. Las empresas deben cumplir con la legalidad vigente en su jurisdicción para operar y ofrecer productos o servicios.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#040116] mb-3">3. Reservas y Operaciones</h2>
                    <p>La función de reserva asegura el stock de manera temporal. El cliente y el proveedor deben coordinar el pago final y la entrega. SINGKI actúa únicamente como un canal de intermediación y conexión tecnológica, y no interviene ni retiene fondos de transacciones directas entre las partes en este momento.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#040116] mb-3">4. Privacidad de datos</h2>
                    <p>Protegemos tu información personal utilizando estándares de seguridad modernos. Los datos proporcionados (nombre, correo, ubicación y teléfono) son utilizados exclusivamente para facilitar el contacto entre usuarios y la gestión interna de tu cuenta. No vendemos tus datos a terceros.</p>
                </section>
                
                <div class="bg-blue-50/50 p-6 rounded-xl mt-10 text-center">
                    <p class="text-[#040116] font-medium mb-2">¿Tienes alguna duda sobre nuestras políticas?</p>
                    <a href="{{ route('contact_requests.create') }}" class="text-[#1F51FF] font-bold hover:underline">Contáctanos en nuestro Centro de Ayuda</a>
                </div>
            </div>

        </div>
    </main>

    <x-footer />
</body>
</html>
