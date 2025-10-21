# Documentación del Proyecto: Plataforma de Cursos Online

## Tecnologías Utilizadas

Este proyecto es una aplicación web construida con el framework **Laravel 12** y utiliza las siguientes tecnologías:

- **Backend**: Laravel 12 (PHP 8.2+)
- **Base de Datos**: MySQL (configurado a través de migraciones de Laravel)
- **Frontend**: Blade Templates, TailwindCSS 4.0
- **Build Tool**: Vite 7.0.4 con Laravel Vite Plugin
- **JavaScript**: Axios 1.11.0 para peticiones HTTP
- **Testing**: PHPUnit 11.5.3
- **Estilos**: TailwindCSS con configuración personalizada
- **Autenticación**: Laravel Sanctum (basado en el modelo User estándar)

## Arquitectura del Proyecto

### Estructura de Directorios
- `app/`: Código fuente de la aplicación
  - `Http/Controllers/`: Controladores (SectionsController.php)
  - `Models/`: Modelos Eloquent (Section.php, User.php)
- `database/`: Migraciones y seeders
- `resources/views/`: Plantillas Blade
- `routes/`: Definición de rutas (web.php)
- `public/`: Archivos estáticos
- `config/`: Configuraciones de Laravel

### Patrón MVC
El proyecto sigue el patrón Modelo-Vista-Controlador (MVC) de Laravel:
- **Modelos**: Representan las entidades de datos (Section, User)
- **Vistas**: Plantillas Blade para la presentación
- **Controladores**: Lógica de negocio y manejo de peticiones HTTP

## Endpoints Disponibles

### Rutas Principales

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/` | - | Página de bienvenida (welcome.blade.php) |
| GET | `/sections` | `sections.index` | Lista todas las secciones |
| GET | `/sections/create` | `sections.create` | Muestra formulario para crear sección |
| POST | `/sections` | `sections.store` | Guarda nueva sección |
| GET | `/sections/{section:name}` | `sections.show` | Muestra detalles de una sección |
| GET | `/sections/{section}/edit` | `sections.edit` | Muestra formulario de edición |
| PUT | `/sections/{section}` | `sections.update` | Actualiza sección existente |
| DELETE | `/sections/{section}` | `sections.destroy` | Elimina una sección |

## Funcionalidad de los Endpoints

### 1. GET `/sections` (sections.index)
**Funcionalidad**: Lista todas las secciones disponibles.
**Lógica de Negocio**: 
- Ubicación: `SectionsController@index()`
- Obtiene todas las secciones usando `Section::all()`
- Pasa los datos a la vista `sections.index`
**Almacenamiento en BD**: 
- Consulta la tabla `sections` (id, name, description, timestamps)
**Vista**: `resources/views/Sections/index.blade.php` - Tabla con acciones de editar/eliminar

### 2. GET `/sections/create` (sections.create)
**Funcionalidad**: Muestra formulario para crear nueva sección.
**Lógica de Negocio**: 
- Ubicación: `SectionsController@create()`
- Simplemente retorna la vista del formulario
**Almacenamiento en BD**: No aplica (solo muestra formulario)
**Vista**: `resources/views/Sections/create.blade.php`

### 3. POST `/sections` (sections.store)
**Funcionalidad**: Crea y guarda una nueva sección.
**Lógica de Negocio**: 
- Ubicación: `SectionsController@store(Request $request)`
- Valida datos de entrada (name, description)
- Crea nueva instancia de Section
- Asigna valores y guarda en BD
- Redirige a la lista con mensaje de éxito
**Almacenamiento en BD**: 
- Inserta en tabla `sections` (name, description)
- Campos: id (auto), name (64 chars), description (128 chars nullable), timestamps
**Validación**: name requerido, description opcional

### 4. GET `/sections/{section:name}` (sections.show)
**Funcionalidad**: Muestra detalles de una sección específica.
**Lógica de Negocio**: 
- Ubicación: `SectionsController@show(Section $section)`
- Usa route model binding para obtener la sección por nombre
- Pasa la sección a la vista
**Almacenamiento en BD**: 
- Consulta tabla `sections` por campo `name`
**Vista**: `resources/views/Sections/show.blade.php`

### 5. GET `/sections/{section}/edit` (sections.edit)
**Funcionalidad**: Muestra formulario de edición para una sección.
**Lógica de Negocio**: 
- Ubicación: `SectionsController@edit(Section $section)`
- Usa route model binding para obtener la sección por ID
- Pasa la sección a la vista de edición
**Almacenamiento en BD**: 
- Consulta tabla `sections` por ID
**Vista**: `resources/views/Sections/edit.blade.php`

### 6. PUT `/sections/{section}` (sections.update)
**Funcionalidad**: Actualiza una sección existente.
**Lógica de Negocio**: 
- Ubicación: `SectionsController@update(Request $request, Section $section)`
- Valida datos: name requerido, description opcional
- Actualiza los campos de la sección
- Guarda cambios en BD
- Redirige con mensaje de éxito/error
**Almacenamiento en BD**: 
- Actualiza tabla `sections` (name, description)
**Validación**: name requerido, description opcional

### 7. DELETE `/sections/{section}` (sections.destroy)
**Funcionalidad**: Elimina una sección.
**Lógica de Negocio**: 
- Ubicación: `SectionsController@destroy(Section $section)`
- Elimina la sección de la BD
- Redirige con mensaje de éxito/error
**Almacenamiento en BD**: 
- Elimina registro de tabla `sections`
**Validación**: Confirmación de eliminación vía JavaScript

## Esquema de Base de Datos

### Tabla `sections`
```sql
CREATE TABLE sections (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    description VARCHAR(128) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Tabla `users` (estándar Laravel)
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Tabla `roles`
```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## Flujo Completo para CRUD de una Nueva Tabla

Para implementar un CRUD completo para una nueva entidad (ejemplo: "Courses"), sigue estos pasos:

### 1. Crear la Migración
```bash
php artisan make:migration create_courses_table
```

En `database/migrations/XXXX_XX_XX_XXXXXX_create_courses_table.php`:
```php
public function up(): void
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('title', 100);
        $table->text('description')->nullable();
        $table->foreignId('section_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
```

### 2. Crear el Modelo
```bash
php artisan make:model Course
```

En `app/Models/Course.php`:
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'section_id'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
```

### 3. Crear el Controlador
```bash
php artisan make:controller CoursesController --resource
```

En `app/Http/Controllers/CoursesController.php`:
```php
<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::with('section')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('courses.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'section_id' => 'required|exists:sections,id'
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $sections = Section::all();
        return view('courses.edit', compact('course', 'sections'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'section_id' => 'required|exists:sections,id'
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}
```

### 4. Definir las Rutas
En `routes/web.php`:
```php
use App\Http\Controllers\CoursesController;

Route::resource('courses', CoursesController::class);
```

### 5. Crear las Vistas
Crear directorio `resources/views/courses/` y los archivos:
- `index.blade.php`: Lista de cursos
- `create.blade.php`: Formulario de creación
- `show.blade.php`: Detalles del curso
- `edit.blade.php`: Formulario de edición

### 6. Ejecutar Migraciones
```bash
php artisan migrate
```

### 7. Probar la Funcionalidad
- Visitar `/courses` para ver la lista
- Crear, editar y eliminar cursos
- Verificar que las relaciones con sections funcionen correctamente

## Consideraciones de Seguridad

- Los controladores usan validación de datos de entrada
- Protección CSRF en formularios
- Route model binding para prevenir acceso no autorizado
- Confirmación de eliminación vía JavaScript

## Próximos Pasos

- Implementar autenticación de usuarios
- Agregar roles y permisos
- Crear API RESTful
- Implementar paginación en listas
- Agregar validaciones más complejas
- Implementar logging avanzado
- Crear tests unitarios y de integración