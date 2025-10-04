<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sections', [SectionsController::class, 'index'])->name('sections.index');
Route::get('/sections/create', [SectionsController::class, 'create'])->name('sections.create');
Route::post('/sections', [SectionsController::class, 'store'])->name('sections.store');
