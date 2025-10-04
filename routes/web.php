<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sections', [SectionsController::class, 'index'])->name('sections.index');
Route::get('/sections/create', [SectionsController::class, 'create'])->name('sections.create');
Route::post('/sections', [SectionsController::class, 'store'])->name('sections.store');

Route::get('/sections/{section:name}',[SectionsController::class,'show'])->name('sections.show');

Route::get('/sections/{section}/edit', [SectionsController::class, 'edit'])->name('sections.edit');
Route::put('/sections/{section}', [SectionsController::class, 'update'])->name('sections.update');

Route::delete('/sections/{section}', [SectionsController::class, 'destroy'])->name('sections.destroy');
