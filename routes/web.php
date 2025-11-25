<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect()->route('login');
});

// ============================================
//  Dashboard dinámico por rol
// ============================================
Route::get('/home', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('home.index');

include('web/section.php');
include('web/course.php');
include('web/user.php');
include('web/role.php');
include('web/enrollment.php');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
