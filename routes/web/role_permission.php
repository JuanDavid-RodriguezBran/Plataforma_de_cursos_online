<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolePermissionController;

Route::get('/role-permissions', [RolePermissionController::class, 'index'])->name('role_permissions.index');
Route::get('/role-permissions/create', [RolePermissionController::class, 'create'])->name('role_permissions.create');
Route::post('/role-permissions', [RolePermissionController::class, 'store'])->name('role_permissions.store');
Route::get('/role-permissions/{role_id}/{permission_id}', [RolePermissionController::class, 'show'])->name('role_permissions.show');
Route::get('/role-permissions/{role_id}/{permission_id}/edit', [RolePermissionController::class, 'edit'])->name('role_permissions.edit');
Route::put('/role-permissions/{role_id}/{permission_id}', [RolePermissionController::class, 'update'])->name('role_permissions.update');
Route::delete('/role-permissions/{role_id}/{permission_id}', [RolePermissionController::class, 'destroy'])->name('role_permissions.destroy');

