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
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:student,teacher,admin',
        ]);

        try {
            // Asignar ID según el rol seleccionado
            $roleId = match ($validated['role']) {
                'admin' => 1,
                'teacher' => 2,
                'student' => 3,
                default => throw new \Exception('Rol no válido')
            };

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => $roleId,
            ]);

            return redirect()->back()->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $ex) {
            Log::error($ex);
            // Mostrar el mensaje de error exacto en la vista
            return redirect()->back()->withInput()->with(['error' => 'Error al crear el usuario', 'error_detail' => $ex->getMessage()]);
        }
    }
}
