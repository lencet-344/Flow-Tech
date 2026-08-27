<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Singky</title>
    <!-- Estilos básicos y Tailwind CSS si lo estás usando -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #map {
            height: 550px;
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Ubicación de Proveedores y Puntos de Entrega</h1>
        <p class="text-gray-600 mb-6">Mapa interactivo de la red logística en Estelí.</p>

        <!-- Contenedor donde se cargará el mapa de Google -->
        <div id="map"></div>
    </div>

    <!-- Script de Google Maps API pasando la llave desde config/services.php -->
    <script>
        function initMap() {
            // Coordenadas centrales: Estelí, Nicaragua
            const esteli = { lat: 13.0918, lng: -86.3538 };

            // Inicializar el mapa
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: esteli,
            });

            // Lista de puntos de ejemplo (puedes pasar esto dinámicamente desde Laravel)
            const puntosLogistics = [
                {
                    titulo: "Supermercado",
                    lat: 13.0895,
                    lng: -86.3580,
                    descripcion: "Cliente Principal - Punto de Entrega B2B"
                },
                {
                    titulo: "Bodega de Proveedor Central",
                    lat: 13.0950,
                    lng: -86.3500,
                    descripcion: "Centro de Despacho e Inventario"
                }
            ];

            // Crear marcadores e InfoWindows para cada punto
            puntosLogistics.forEach(punto => {
                const marker = new google.maps.Marker({
                    position: { lat: punto.lat, lng: punto.lng },
                    map: map,
                    title: punto.titulo,
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="padding: 8px;">
                            <h3 style="font-weight: bold; font-size: 14px; margin-bottom: 4px;">${punto.titulo}</h3>
                            <p style="font-size: 12px; color: #555;">${punto.descripcion}</p>
                        </div>
                    `
                });

                marker.addListener("click", () => {
                    infoWindow.open(map, marker);
                });
            });
        }
    </script>

    <!-- Carga diferida del script de Google Maps usando tu API Key configurada -->
    <script 
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap" 
        async 
        defer>
    </script>

</body>
</html>
