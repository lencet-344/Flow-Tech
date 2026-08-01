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

## Arquitectura del Sistema

La base de datos y la interfaz de usuario están divididas estratégicamente para mantener la integridad referencial de los datos.

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


