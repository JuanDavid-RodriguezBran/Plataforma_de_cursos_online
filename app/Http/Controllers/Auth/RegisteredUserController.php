<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar vista de registro
     */
    public function show()
    {
        // Traer todos los roles creados en el CRUD
        $roles = Role::all();

        return view('auth.register', compact('roles'));
    }

    /**
     * Registrar nuevo usuario
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|confirmed|min:6',
            'role_id'   => 'required|exists:roles,id', // <-- AGREGADO
        ]);

        // Crear usuario con rol seleccionado
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id, // <-- AHORA VIENE DEL FORM
        ]);

        return redirect()->route('login')
            ->with('success', 'Cuenta creada exitosamente. Inicia sesión.');
    }
}


