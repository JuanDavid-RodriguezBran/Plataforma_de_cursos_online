<?php

namespace App\Traits;

trait HasPermissions
{
    /**
     * Verifica si el usuario autenticado tiene un permiso específico
     */
    public function hasPermission($permissionName)
    {
        return auth()->check() && auth()->user()->role->permissions()->where('name', $permissionName)->exists();
    }

    /**
     * Verifica si el usuario autenticado tiene alguno de los permisos especificados
     */
    public function hasAnyPermission($permissionNames)
    {
        return auth()->check() && auth()->user()->role->permissions()
            ->whereIn('name', (array) $permissionNames)
            ->exists();
    }

    /**
     * Verifica si el usuario autenticado tiene todos los permisos especificados
     */
    public function hasAllPermissions($permissionNames)
    {
        $userPermissions = auth()->user()->role->permissions()->pluck('name')->toArray();
        return count(array_intersect((array) $permissionNames, $userPermissions)) === count((array) $permissionNames);
    }
}
