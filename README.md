# Flow-Tech

Un sistema integral de gestión empresarial y logística desarrollado con una arquitectura robusta, diseñado para optimizar el control de inventarios, proveedores, órdenes y ofertas mediante una interfaz dinámica y un backend seguro.

## Tecnologías Utilizadas

Este proyecto fue construido utilizando herramientas modernas para garantizar escalabilidad, seguridad y una experiencia de usuario fluida:

* **Framework Backend:** Laravel 13 (PHP)
* **Framework Frontend:** Tailwind CSS
* **Motor de Plantillas:** Blade Components (`<x-app-layout>`)
* **Alertas Dinámicas:** SweetAlert2
* **Base de Datos:** MySQL (Relacional)
* **Control de Versiones:** Git & GitHub (Flujo de trabajo con Pull Requests y commits atómicos)
* **Gemini AI:**(https://img.shields.io/badge/Google_Gemini-8E75B2?style=for-the-badge&logo=googlegemini&logoColor=white)
* **Security:**(https://img.shields.io/badge/Security-2FA_%26_HTTPS-green?style=for-the-badge&logo=shieldsdotio)

Stack Tecnológico

* **Base de Datos:** MySQL 8.0 (con Eloquent ORM, Migraciones y Seeders)
* **Frontend:** Blade Templates, Tailwind CSS, JavaScript
* **Servicios e Integraciones:**
  * **Inteligencia Artificial:** Google Gemini API Integration
  * **Seguridad:** Autenticación por Roles, Doble Factor de Autenticación (2FA) y Encriptación HTTPS mediante Let's Encrypt
* **Hosting & DevOps:** DomCloud 

## Arquitectura del Sistema

SINGKI sigue la arquitectura **MVC (Modelo-Vista-Controlador)** provista por el framework Laravel, acoplada a una base de datos relacional MySQL y motores de renderizado reactivo/estático con Blade y Tailwind CSS.

La base de datos y la interfaz de usuario están divididas estratégicamente para mantener la integridad referencial de los datos.

## 🧩 Módulos Principales

1. **Módulo de Autenticación y Control de Roles:**
   - Registro, inicio de sesión seguro y verificación 2FA (`2fa_verified`).
   - Redirección dinámica basada en el rol del usuario mediante `AuthenticatedSessionController`.

2. **Módulo de Gestión de Reseñas y Calificaciones (`ReviewController`):**
   - Sistema de feedback donde los usuarios pueden calificar con un rango del 1 al 5 y dejar comentarios.
   - Guardado relacional seguro (`user_id` vinculado automáticamente).

3. **Módulo de Asistencia con Inteligencia Artificial:**
   - Asistente integrado mediante la API de Gemini para soporte en toma de decisiones de compras y gestión de suministros.

4. **Módulo Logístico y Catálogo:**
   - Panel de control para la administración de inventario, proveedores y solicitudes B2B.

---

## 🔒 Seguridad y Buenas Prácticas

* **Cifrado y HTTPS:** Forzado de esquema HTTPS (`URL::forceScheme('https')`) en entorno de producción.
* **Protección CSRF:** Verificación de token `@csrf` en la totalidad de los formularios POST.
* **Middlewares de Acceso:**
  * `auth`: Restringe la navegación a usuarios autenticados.
  * `2fa_verified`: Exige la validación del segundo factor para acciones sensibles.
  * `role:{rol}` / `CheckSuperAdmin`: Garantiza la segregación de funciones entre Administradores, Proveedores y Clientes.
* **Validación Estricta:** Reglas de validación aplicadas directamente desde las clases `Request` en los controladores para prevenir inyecciones y datos anómalos.

---

## 📡 Endpoints y Rutas Principales

| Método | Ruta | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/` | `web` | Página de bienvenida / Landing page de SINKI |
| `POST` | `/login` | `guest` | Inicio de sesión de usuarios |
| `POST` | `/logout` | `auth` | Cierre de sesión de la plataforma |
| `GET` | `/admin/dashboard` | `auth, role:admin` | Dashboard administrativo de proveedores |
| `GET` | `/superadmin/dashboard`| `auth, CheckSuperAdmin`| Panel principal de superadministración |
| `POST` | `/dejar-resena` | `auth` | Registro de calificación y comentario de usuario |

### Entidades Principales (Core)
Gestión independiente sin dependencias externas directas:
* Categories (Categorías)
* Companies (Empresas)
* Products (Productos)
* Suppliers (Proveedores)

### Entidades Transaccionales y Relacionales
Implementación de llaves foráneas dinámicas y selección en cascada:
* Users & Roles
* Orders & OrderDetails
* Inventories
* Offers & Trades
* Bookings & Favorites
* BuyVerifications & ContactRequests

## Características Destacadas

* **Sincronización Estricta de Modelos:** Los Form Requests y los Modelos de Eloquent están rigurosamente acoplados a las migraciones físicas de la base de datos.
* **Validación de Datos en Tiempo Real:** Implementación de reglas `old()` para retener información en formularios y validaciones `exists:tabla,id` para prevenir inyecciones de datos fantasma.
* **UI/UX Premium:** Interfaz limpia construida con Tailwind CSS, soportando paletas de colores modernas e interacciones seguras (confirmación de eliminación vía SweetAlert2).
* **Desarrollo Colaborativo Estructurado:** Separación clara de responsabilidades entre el desarrollo del backend (migraciones y controladores) y la integración del frontend (vistas Blade e inyección de datos).

## Equipo de Desarrollo
## Equipo de Marketing
## Equipo de Diseño
## Equipo de Comunicacion

* **Isaac Meneses:** Frontend Architecture, UI/UX Design & Git Workflow.
* **Edmundo:** Backend Architecture, Database Migrations & Controllers.


