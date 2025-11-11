<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $roles = [
            ['name' => 'admin'],
            ['name' => 'instructor'],
            ['name' => 'student'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate($roleData);
        }

        // Asignar permisos al rol admin
        $adminRole = Role::where('name', 'admin')->first();
        $allPermissions = Permission::all();

        if ($adminRole) {
            $adminRole->permissions()->sync($allPermissions->pluck('id'));
        }

        // Crear usuario admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        if ($adminRole && $adminUser) {
            $adminUser->roles()->sync([$adminRole->id]);
        }
    }
}

