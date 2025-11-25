<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentsController;

/*
|--------------------------------------------------------------------------
| ENROLLMENTS (INSCRIPCIONES)
|--------------------------------------------------------------------------
| Todas las rutas relacionadas con inscripciones: CRUD, vistas para
| estudiantes, vistas para profesores/admin, cambio de estado.
|--------------------------------------------------------------------------
*/

Route::prefix('enrollments')->group(function () {

    // ===============================
    // CRUD PRINCIPAL
    // ===============================

    Route::get('/', [EnrollmentsController::class, 'index'])
        ->name('enrollments.index');

    Route::get('/create', [EnrollmentsController::class, 'create'])
        ->name('enrollments.create');

    Route::post('/', [EnrollmentsController::class, 'store'])
        ->name('enrollments.store');

    Route::get('/{id}', [EnrollmentsController::class, 'show'])
        ->name('enrollments.show');

    // Editar estado (vista)
    Route::get('/{id}/edit', [EnrollmentsController::class, 'edit'])
        ->name('enrollments.edit');

    // Actualizar estado (acción)
    Route::patch('/{id}/status', [EnrollmentsController::class, 'updateStatus'])
        ->name('enrollments.updateStatus');

    // Eliminar inscripción
    Route::delete('/{id}', [EnrollmentsController::class, 'destroy'])
        ->name('enrollments.destroy');


    // ===============================
    // Inscripciones del usuario autenticado (Estudiante)
    // ===============================

    Route::get('/my', [EnrollmentsController::class, 'myEnrollments'])
        ->name('enrollments.my');

});


// ===============================
// Inscribirse desde un curso
// ===============================

Route::post('/courses/{course}/enroll', [EnrollmentsController::class, 'store'])
    ->name('courses.enroll');


// ===============================
// Inscripciones de un curso (admin/profesor)
// ===============================

Route::get('/courses/{course_id}/enrollments', [EnrollmentsController::class, 'courseEnrollments'])
    ->name('enrollments.byCourse');


