<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;        // Nombre del modelo de roles
use App\Models\Permission;  // Modelo de permisos
use App\Models\User;        // Modelo de usuario

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $rolesData = [
            ['name' => 'admin'],
            ['name' => 'instructor'],
            ['name' => 'student'],
        ];
        foreach ($rolesData as $roleData) {
            Role::firstOrCreate($roleData);
        }

        // Asignar permisos al rol admin
        $adminRole = Role::where('name', 'admin')->first();
        $allPermissions = Permission::all();
        if ($adminRole) {
            $adminRole->permissions()->sync($allPermissions->pluck('id')->toArray());
        }

        // Crear un usuario admin y asignarlo
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin',
                'password' => bcrypt('password')  // Ajusta contraseña segura
            ]
        );
        if ($adminUser && $adminRole) {
            $adminUser->roles()->sync([$adminRole->id]);
        }
    }
}
