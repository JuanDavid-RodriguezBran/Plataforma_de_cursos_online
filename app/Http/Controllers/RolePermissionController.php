<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;

class RolePermissionController extends Controller
{
    public function index()
    {
        $rolePermissions = RolePermission::with(['role', 'permission'])->get();
        return view('role_permissions.index', ['rolePermissions' => $rolePermissions]);
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role_permissions.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,permission_id',
        ]);

        try {
            // Verificar si la relación ya existe
            $exists = RolePermission::where('role_id', $validatedData['role_id'])
                ->where('permission_id', $validatedData['permission_id'])
                ->exists();

            if ($exists) {
                return redirect()->route('role_permissions.index')
                    ->with('error', 'This role-permission relationship already exists.');
            }

            $rolePermission = new RolePermission();
            $rolePermission->role_id = $validatedData['role_id'];
            $rolePermission->permission_id = $validatedData['permission_id'];
            $rolePermission->save();

            return redirect()->route('role_permissions.index')
                ->with('success', 'Role permission created successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('role_permissions.index')
            ->with('error', 'Error creating the role permission.');
    }

    public function show($role_id, $permission_id)
    {
        $rolePermission = RolePermission::where('role_id', $role_id)
            ->where('permission_id', $permission_id)
            ->with(['role', 'permission'])
            ->firstOrFail();
        
        return view('role_permissions.show', ['rolePermission' => $rolePermission]);
    }

    public function edit($role_id, $permission_id)
    {
        $rolePermission = RolePermission::where('role_id', $role_id)
            ->where('permission_id', $permission_id)
            ->with(['role', 'permission'])
            ->firstOrFail();
        
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role_permissions.edit', compact('rolePermission', 'roles', 'permissions'));
    }

    public function update(Request $request, $role_id, $permission_id)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,permission_id',
        ]);

        try {
            $rolePermission = RolePermission::where('role_id', $role_id)
                ->where('permission_id', $permission_id)
                ->firstOrFail();

            // Verificar si la nueva relación ya existe (excluyendo la actual)
            $exists = RolePermission::where('role_id', $validatedData['role_id'])
                ->where('permission_id', $validatedData['permission_id'])
                ->where(function($query) use ($role_id, $permission_id) {
                    $query->where('role_id', '!=', $role_id)
                          ->orWhere('permission_id', '!=', $permission_id);
                })
                ->exists();
            
            // Si no cambió nada, no hay problema
            if ($role_id == $validatedData['role_id'] && $permission_id == $validatedData['permission_id']) {
                $exists = false;
            }

            if ($exists) {
                return redirect()->route('role_permissions.index')
                    ->with('error', 'This role-permission relationship already exists.');
            }

            // Para tablas pivot con clave compuesta, necesitamos eliminar y crear
            $rolePermission->delete();

            $newRolePermission = new RolePermission();
            $newRolePermission->role_id = $validatedData['role_id'];
            $newRolePermission->permission_id = $validatedData['permission_id'];
            $newRolePermission->save();

            return redirect()->route('role_permissions.index')
                ->with('success', 'Role permission updated successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('role_permissions.index')
            ->with('error', 'Error updating the role permission.');
    }

    public function destroy($role_id, $permission_id)
    {
        try {
            $rolePermission = RolePermission::where('role_id', $role_id)
                ->where('permission_id', $permission_id)
                ->firstOrFail();
            
            $rolePermission->delete();
            return redirect()->route('role_permissions.index')
                ->with('success', 'Role permission deleted successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('role_permissions.index')
            ->with('error', 'Error deleting the role permission.');
    }
}

