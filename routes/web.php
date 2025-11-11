<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home.index');

// Dashboard - Accesible solo para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

include('web/section.php');
include('web/course.php');
include('web/user.php');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'authorized:Secciones.showSections'])->group(function () {
    Route::get('/sections', [SectionsController::class, 'index'])->name('sections.index');
});

Route::middleware(['auth', 'authorized:Roles.showRoles'])->group(function () {
    Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
});

Route::middleware(['auth', 'authorized:Cursos.showCourses'])->group(function () {
    Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
});

require __DIR__.'/auth.php';
