<?php

namespace App\Helpers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleHelper
{
    /**
     * Verifica si el usuario autenticado tiene el rol 'Administrador'.
     */
    public static function currentUserIsAdmin(): bool
    {
        $user = Auth::user();
        if (!$user) return false;
        return $user->role && strtolower($user->role->name) === 'administrador';
    }

    /**
     * Verifica si el usuario autenticado tiene el permiso indicado.
     * @param string $permission (formato: module.permissionName)
     */
    public static function isAuthorized(string $permission): bool
    {
        $user = Auth::user();
        if (!$user || !$user->role) return false;

        // Buscar el permiso por módulo y nombre
        [$module, $permissionName] = explode('.', $permission);
        $perm = Permission::where('module', $module)
            ->where('name', $permissionName)
            ->first();
        if (!$perm) return false;

        // Verificar si el rol del usuario tiene el permiso
        return $user->role->permissions()->where('permissions.id', $perm->id)->exists();
    }
}
