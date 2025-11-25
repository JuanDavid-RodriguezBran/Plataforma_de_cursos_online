<?php

namespace App\Helpers;

use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleHelper
{
    /**
     * Detecta si el usuario actual es Administrador
     */
    public static function currentUserIsAdmin(): bool
    {
        try {
            $roleName = Auth::user()->role->name ?? null;
            return $roleName === 'Administrador';
        } catch (Exception $ex) {
            Log::error("Error en RoleHelper::currentUserIsAdmin - " . $ex->getMessage());
            return false;
        }
    }

    /**
     * Verifica si el usuario tiene un permiso exacto.
     * Formato requerido: Module.permissionName
     * Ejemplo: Users.createUsers
     */
    public static function isAuthorized(string $permission): bool
    {
    try {
        if (!Auth::check()) return false;

        // Admin siempre tiene permiso
        if (self::currentUserIsAdmin()) return true;

        if (!str_contains($permission, '.')) return false;

        [$module, $permissionName] = explode('.', $permission);

        return Permission::join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->join('roles', 'role_permissions.role_id', '=', 'roles.id')
            ->where('roles.id', Auth::user()->role_id)
            ->where('permissions.module', $module)
            ->where('permissions.name', $permissionName)
            ->exists();

    } catch (Exception $ex) {
        Log::error("Error en RoleHelper::isAuthorized - " . $ex->getMessage());
        return false;
    }
}


}

