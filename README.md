# Práctica de Integración Back-End: Laravel y PostgreSQL

Este proyecto es una implementación de una API REST simple para gestionar categorías y productos, desarrollada con Laravel como parte de la práctica de integración.

## 📋 Requisitos

* PHP >= 8.2
* Composer
* Node.js & npm (o yarn)
* Un servidor de base de datos PostgreSQL (para desarrollo/producción) o SQLite (para testing)

## 🚀 Instalación y Configuración

1.  **Clonar el repositorio (si aplica):**
    ```bash
    git clone <tu-url-del-repositorio>
    cd nombre-del-proyecto
    ```

2.  **Instalar dependencias:**
    ```bash
    composer install
    npm install
    npm run build
    ```

3.  **Configurar el entorno:**
    * Copia el archivo de ejemplo `.env.example` a `.env`:
        ```bash
        cp .env.example .env
        ```
    * Genera la clave de aplicación:
        ```bash
        php artisan key:generate
        ```
    * **Importante:** Edita el archivo `.env` y configura los detalles de tu conexión a la base de datos **PostgreSQL** (si no lo hiciste antes). Busca las variables `DB_*` y ajústalas:
        ```env
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1  # O la IP/host de tu servidor PostgreSQL
        DB_PORT=5432      # Puerto por defecto de PostgreSQL
        DB_DATABASE=nombre_tu_base_de_datos
        DB_USERNAME=tu_usuario_postgres
        DB_PASSWORD=tu_contraseña_postgres
        ```
        *Asegúrate de que la base de datos `nombre_tu_base_de_datos` exista en tu servidor PostgreSQL.*

    * Copia `.env.testing.example` a `.env.testing` (si no existe ya `.env.testing`). Este archivo ya está configurado para usar SQLite en memoria para las pruebas.
        ```bash
        cp .env.testing.example .env.testing # Solo si no tienes .env.testing
        ```

4.  **Ejecutar las migraciones:**
    Esto creará las tablas `categories` y `products` (y otras tablas de Laravel) en tu base de datos PostgreSQL configurada en `.env`.
    ```bash
    php artisan migrate
    ```

## ▶️ Ejecutar la aplicación

Puedes usar el servidor de desarrollo integrado de Laravel:

```bash
php artisan serve