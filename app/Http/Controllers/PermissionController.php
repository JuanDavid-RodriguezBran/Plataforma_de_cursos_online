<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'descripcion' => 'nullable',
        ]);

        try {
            $permission = new Permission();
            $permission->name = $validatedData['name'];
            $permission->descripcion = $validatedData['descripcion'] ?? null;

            $permission->save();

            return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('permissions.index')->with('error', 'Error creating the permission.');
    }

    public function show(Permission $permission)
    {
        return view('permissions.show', ['permission' => $permission]);
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'descripcion' => 'nullable',
        ]);

        try {
            $permission->name = $validatedData['name'];
            $permission->descripcion = $validatedData['descripcion'] ?? null;
            $permission->save();

            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('permissions.index')->with('error', 'Error updating the permission.');
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('permissions.index')->with('error', 'Error deleting the permission.');
    }
}

