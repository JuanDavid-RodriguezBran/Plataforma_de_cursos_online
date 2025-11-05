<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Sections Routes
|--------------------------------------------------------------------------
*/
Route::get('/sections', [SectionsController::class, 'index'])->name('sections.index');
Route::get('/sections/create', [SectionsController::class, 'create'])->name('sections.create');
Route::post('/sections', [SectionsController::class, 'store'])->name('sections.store');

Route::get('/sections/{section:name}',[SectionsController::class,'show'])->name('sections.show');

Route::get('/sections/{section}/edit', [SectionsController::class, 'edit'])->name('sections.edit');
Route::put('/sections/{section}', [SectionsController::class, 'update'])->name('sections.update');

Route::delete('/sections/{section}', [SectionsController::class, 'destroy'])->name('sections.destroy');


/*
|--------------------------------------------------------------------------
| Courses Routes
|--------------------------------------------------------------------------
*/
Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CoursesController::class, 'create'])->name('courses.create');
Route::post('/courses', [CoursesController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}', [CoursesController::class, 'show'])->name('courses.show');
Route::get('/courses/{course}/edit', [CoursesController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CoursesController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course}', [CoursesController::class, 'destroy'])->name('courses.destroy');


Route::get('/users/create', function() { return view('users.create'); })->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

