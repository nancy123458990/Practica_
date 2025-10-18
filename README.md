## 📝 Proceso de Implementación

El desarrollo de esta API RESTful se llevó a cabo siguiendo una metodología estructurada, aprovechando las herramientas proporcionadas por el framework Laravel:

1.  **Configuración Inicial del Entorno de Desarrollo:**
    * Se estableció un directorio de trabajo (`Proyecto`).
    * Dentro de este directorio, se inicializó un nuevo proyecto Laravel (`Practica_Integracion_BackEnd_Nancy`) mediante el comando `composer create-project laravel/laravel Practica_Integracion_BackEnd_Nancy`.
    * El proyecto fue abierto y gestionado utilizando Visual Studio Code.

2.  **Configuración de Entorno y Base de Datos:**
    * Se adaptó el archivo `.env` a partir de `.env.example`, configurando las credenciales para la conexión a una base de datos **PostgreSQL** denominada `practica_db`, alojada localmente y gestionada a través de pgAdmin 4.
    * Se generó la clave de seguridad de la aplicación (`APP_KEY`) con el comando `php artisan key:generate`.
    * Se preparó el entorno específico para pruebas creando el archivo `.env.testing`, configurándolo para utilizar una base de datos **SQLite** en memoria, asegurando así la isolation y velocidad de las pruebas automatizadas.

3.  **Diseño del Esquema y Ejecución de Migraciones:**
    * Se diseñó el esquema relacional, definiendo las tablas `categories` y `products`.
    * Se generaron los archivos de migración mediante `php artisan make:migration` para cada tabla. Se definieron columnas, tipos de datos, llaves primarias, índices y la relación foránea entre `products` y `categories`, incluyendo la configuración `onDelete('cascade')` para mantener la integridad referencial.
    * Se aplicaron las migraciones a la base de datos `practica_db` utilizando `php artisan migrate`.

4.  **Implementación de Modelos Eloquent:**
    * Se crearon los modelos `Category` y `Product` utilizando `php artisan make:model`. Se definió la propiedad `$fillable` en cada modelo para habilitar la asignación masiva de atributos.
    * Se codificaron las relaciones Eloquent correspondientes: `public function products()` (`hasMany`) en `Category` y `public function category()` (`belongsTo`) en `Product`.

5.  **Configuración de Rutas API:**
    * Se detectó la ausencia inicial del archivo `routes/api.php`. Para habilitar correctamente el enrutamiento de API, se ejecutó el comando `php artisan install:api`. Esto aseguró que las rutas API fueran reconocidas por `php artisan route:list`.
    * Se definieron las rutas para los recursos API `products` y `categories` utilizando `Route::apiResource`, vinculándolas a `ProductController` y `CategoryController` respectivamente.

6.  **Desarrollo de Controladores:**
    * Se generaron los controladores `ProductController` y `CategoryController`.
    * Se implementó la lógica completa para las operaciones **CRUD** (Create, Read, Update, Delete) en ambos controladores, manejando las peticiones `index`, `store`, `show`, `update`, y `destroy`.
    * Se integró la **validación de datos** en `store` y `update` mediante `$request->validate()`, definiendo reglas específicas para cada campo.
    * Se aplicó **Eager Loading** (`with('relation')` o `load('relation')`) para optimizar las consultas de base de datos al recuperar entidades con sus relaciones.
    * Se estandarizaron las **respuestas JSON** utilizando `response()->json()` y las constantes de código de estado HTTP de `Illuminate\Http\Response`.

7.  **Implementación de Pruebas Automatizadas:**
    * Se escribió una **prueba unitaria** (`tests/Unit/CategoryProductRelationshipTest.php`) para verificar la correcta implementación de la relación Eloquent entre `Category` y `Product`.
    * Se desarrolló una **prueba de integración** (`tests/Feature/ProductApiTest.php`) para validar los endpoints de la API de productos, específicamente las operaciones de creación (`POST`) y listado (`GET`), asegurando los códigos de estado y la estructura JSON esperados.
    * Se utilizó el trait `RefreshDatabase` en las clases de prueba para garantizar la migración y el reseteo de la base de datos (SQLite en memoria) antes de cada test.

8.  **Verificación Final y Pruebas Manuales:**
    * Se ejecutó el conjunto completo de pruebas automatizadas mediante `php artisan test`, confirmando su paso exitoso.
    * Se inició el servidor de desarrollo local con `php artisan serve`.
    * Se utilizó **Postman** para realizar pruebas manuales exhaustivas de cada endpoint CRUD para `categories` y `products`, verificando el comportamiento esperado, las respuestas JSON y los códigos de estado HTTP en escenarios de éxito y validación.