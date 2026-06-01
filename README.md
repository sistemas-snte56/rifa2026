# 🎟️ Sistema de Registro, Validación y Consulta - Rifa 2026

## 📝 Descripción del Proyecto
Este es un ecosistema web robusto y automatizado desarrollado con el **TALL Stack** para gestionar de punta a punta el ciclo de vida de una rifa institucional masiva. El sistema maneja con seguridad un padrón base de participantes, previene registros duplicados, resuelve conflictos de homónimos, ofrece una interfaz de registro en tiempo real sin recargas de página, y provee un backend administrativo de alta velocidad para la exportación de datos el día del evento.

## 🏗️ Arquitectura y Stack Tecnológico
- **Backend Framework:** Laravel 11 / 12
- **Dynamic Frontend:** Livewire 3 (Arquitectura de componentes reactivos)
- **Interactivity:** Alpine.js
- **UI Styles & Responsiveness:** Tailwind CSS (Optimizado para móviles, tablets y escritorio)
- **Admin & Dashboard Engine:** Filament PHP v4
- **Database:** MySQL / MariaDB (Estructura relacional indexada)

---

## 🚀 Características Principales y Modelado de Datos

### 1. Sistema de Validación y Registro Multi-paso (Livewire)
- **Fase de Búsqueda Activa:** Validación instantánea mediante el ingreso del número de personal contra el padrón cargado.
- **Resolución de Homónimos/Coincidencias:** Lógica avanzada en el backend para identificar y desplegar opciones en caso de que existan registros idénticos entre personal activo y jubilado en la base de datos base, permitiendo al usuario seleccionar su perfil correcto.
- **Integridad de Datos:** Bloqueo automático mediante la relación única del campo `padron_base_id` en la tabla de participantes para imposibilitar el doble registro.

### 2. Panel Administrativo (Filament v4)
- **Estructura Geográfica:** Gestión y segmentación jerárquica por Regiones y Delegaciones.
- **Módulo de Consultas y Estadísticas:** Gráficas y contadores en tiempo real del avance del registro global y regional.
- **Exportación Inteligente:** Integración de acciones nativas de exportación que heredan el estado del *Eloquent Query Builder*. Al aplicar filtros en la tabla (por ejemplo, filtrar por una región específica), la exportación a Excel/CSV genera únicamente el dataset filtrado para agilizar las listas de cotejo el día del sorteo.

### 3. Interfaz de Contingencia y Cierre de Operaciones
- **Congelamiento de Registro:** Vista Blade adaptada con la identidad visual corporativa (Colores institucional naranja y guinda) que inhabilita el formulario de inscripción una vez concluido el tiempo límite.
- **Canal de Información Oficial:** Despliegue de los datos del sorteo directo en la tarjeta contenedora (Transmisión vía Facebook Live el 3 de Junio a las 5:00 PM).
- **Persistencia de Soporte:** Mantenimiento activo del botón de consulta de folios para usuarios rezagados que requieran reimprimir o verificar su registro.

---

## 📦 Requisitos del Sistema e Instalación

### Prerrequisitos
- PHP 8.2 o superior
- Composer
- Node.js & NPM
- Servidor de Base de Datos (MySQL 8.0+ / MariaDB 10.4+)

### Pasos para el Despliegue

1. **Clonación del Repositorio:**
   git clone [https://github.com/tu-usuario/sistema-rifa-snte56.git](https://github.com/tu-usuario/sistema-rifa-snte56.git)
   cd sistema-rifa-snte56

2. **Instalación de Dependencias de Backend:**
    composer install

3. **Instalación y Compilación de Assets de Frontend:**
    npm install
    npm run build

4. **Configuración de Env:**
    cp .env.example .env
    php artisan key:generate

5. **Ejecución de Migraciones:**
    php artisan migrate

6. **Inicialización de Filament:**
    php artisan filament:upgrade
    php artisan make:filament-user

## 📊 Diagrama de Flujo Operativo

[Inicio: Usuario Web] 
       │
       ▼
[Ingresa Número de Personal] ──► [Validación en Padrón Base]
                                           │
                    ┌──────────────────────┴──────────────────────┐
                    ▼                                             ▼
         [Existe Coincidencia Múltiple]               [Existe Registro Único]
          (Caso: Activo vs Jubilado)                              │
                    │                                             │
                    ▼                                             ▼
         [Usuario Selecciona Perfil] ────────────────────► [Habilita Paso 2]
                                                                  │
                                                                  ▼
                                                      [Completa Datos de Contacto]
                                                                  │
                                                                  ▼
                                                      [Generación de Folio Único]

---

##  📅 Protocolo para Futuros Eventos
- **Actualización de Fechas:** Modificar la vista de cierre con los nuevos datos del sorteo.
- **Purga de Padrón:** Vaciar la tabla padron_base e importar el nuevo Excel.
- **Reseteo de Folios:** Truncar la tabla participantes para iniciar el nuevo ciclo.                                                    

---

##  ✒️ Licencia y Créditos
Desarrollado para la gestión transparente y eficiente de eventos institucionales.