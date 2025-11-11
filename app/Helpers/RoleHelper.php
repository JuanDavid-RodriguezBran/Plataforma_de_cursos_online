<?php
namespace App\Helpers;

use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleHelper
{
    public static function currentUserIsAdmin(): bool
    {
        try {
            $role = Auth::user()->role->name ?? null;
            return $role === 'Administrador';
        } catch (Exception $ex) {
            Log::error("Error en RoleHelper::currentUserIsAdmin - " . $ex->getMessage());
            return false;
        }
    }

    
    public static function isAuthorized(string $permission): bool
    {
        try {
            if (!Auth::check()) return false;

            if (self::currentUserIsAdmin()) return true;

            $userId = Auth::id();
            [$module, $permissionName] = explode('.', $permission);

            $permissionId = Permission::select('permissions.id')
                ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->join('roles', 'role_permissions.role_id', '=', 'roles.id')
                ->join('users', 'roles.id', '=', 'users.role_id')
                ->where('permissions.module', $module)
                ->where('permissions.name', $permissionName)
                ->where('users.id', $userId)
                ->first();

            return $permissionId !== null;
        } catch (Exception $ex) {
            Log::error("Error en RoleHelper::isAuthorized - " . $ex->getMessage());
            return false;
        }
    }
}
