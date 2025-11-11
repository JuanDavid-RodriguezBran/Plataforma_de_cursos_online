<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter ?? '';

        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE', 100)
                ? $request->records_per_page
                : env('PAGINATION_MAX_SIZE', 100);
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE', 10);
        }

        $roles = Role::where('name', 'LIKE', "%$filter%")
                     ->paginate($request->records_per_page);

        return view('roles.index', [
            'roles' => $roles,
            'data' => $request
        ]);
    }

    public function create()
    {
        $modules = Permission::all()->groupBy('module');
        return view('roles.create', ['modules' => $modules]);
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if (!$role) {
            Session::flash('message', [
                'content' => "El rol con id: '$id' no existe.",
                'type' => 'error'
            ]);
            return redirect()->back();
        }

        $permissions = Permission::all()->map(function ($item) use ($id) {
            $item->selected = RolePermission::where('permission_id', $item->id)
                                            ->where('role_id', $id)
                                            ->exists();
            return $item;
        });

        $modules = $permissions->groupBy('module');

        return view('roles.edit', [
            'role' => $role,
            'modules' => $modules
        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:64',
            'permissions' => 'required|json',
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no puede ser mayor a :max carácteres.',
            'permissions.required' => 'Debe seleccionar al menos 1 permiso.',
            'permissions.json' => 'El campo permissions tiene el formato incorrecto.',
        ])->validate();

        try {
            DB::transaction(function () use ($request) {
                // Crear el rol
                $role = Role::create(['name' => $request->name]);

                // Asignar permisos
                foreach (json_decode($request->permissions) as $permission) {
                    RolePermission::create([
                        'role_id' => $role->id,
                        'permission_id' => $permission
                    ]);
                }
            });

            Session::flash('message', [
                'content' => 'Rol creado con éxito',
                'type' => 'success'
            ]);
            return redirect()->route('roles.index');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            Session::flash('message', [
                'content' => 'Ha ocurrido un error al crear el rol.',
                'type' => 'error'
            ]);
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|max:64',
            'permissions' => 'required|json',
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no puede ser mayor a :max carácteres.',
            'permissions.required' => 'Debe seleccionar al menos 1 permiso.',
            'permissions.json' => 'El campo permissions tiene el formato incorrecto.',
        ])->validate();

        try {
            DB::transaction(function () use ($request) {
                $role = Role::find($request->role_id);
                $role->update(['name' => $request->name]);

                // Eliminar permisos antiguos
                RolePermission::where('role_id', $role->id)->delete();

                // Insertar nuevos permisos
                foreach (json_decode($request->permissions) as $permission) {
                    RolePermission::create([
                        'role_id' => $role->id,
                        'permission_id' => $permission
                    ]);
                }
            });

            Session::flash('message', [
                'content' => 'Rol actualizado con éxito',
                'type' => 'success'
            ]);
            return redirect()->route('roles.index');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            Session::flash('message', [
                'content' => 'Ha ocurrido un error al actualizar el rol.',
                'type' => 'error'
            ]);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                Session::flash('message', [
                    'content' => "El rol con id: '$id' no existe.",
                    'type' => 'error'
                ]);
                return redirect()->back();
            }

            $role->delete();

            Session::flash('message', [
                'content' => 'Rol eliminado con éxito',
                'type' => 'success'
            ]);
            return redirect()->route('roles.index');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            Session::flash('message', [
                'content' => 'Ha ocurrido un error al eliminar el rol.',
                'type' => 'error'
            ]);
            return redirect()->back();
        }
    }
}
