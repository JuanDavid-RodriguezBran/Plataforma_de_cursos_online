<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Mostrar formulario de creación de usuario.
     */
    public function create()
    {
        $roles = Role::all(); // traer todos los roles dinámicos

        return view('users.create', compact('roles'));
    }

    /**
     * Guardar un usuario nuevo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
            'role_id'    => 'required|exists:roles,id',
        ]);

        try {

            User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id'  => $validated['role_id'],
            ]);

            return redirect()
                ->back()
                ->with('success', 'Usuario creado correctamente.');

        } catch (\Exception $ex) {

            Log::error($ex);

            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error'        => 'Error al crear el usuario',
                    'error_detail' => $ex->getMessage(),
                ]);
        }
    }
}

