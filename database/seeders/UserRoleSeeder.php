<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // ====== ROLES ======
        $adminRole = Role::create(['name' => 'Administrador']);
        $profesorRole = Role::create(['name' => 'Profesor']);
        $estudianteRole = Role::create(['name' => 'Estudiante']);

        // ====== PERMISOS ======

        // Admin: todos los permisos
        $allPermissions = Permission::all();
        foreach ($allPermissions as $perm) {
            RolePermission::create([
                'role_id' => $adminRole->id,
                'permission_id' => $perm->id,
            ]);
        }

        // Profesor: ver todo
        $profesorPermissions = Permission::whereNot('module', 'Users')->get();

        foreach ($profesorPermissions as $perm) {

            // permisos específicos
            $allowCreate = in_array($perm->name, ['createSections', 'createCourses']);
            $allowUpdate = in_array($perm->name, ['updateSections', 'updateCourses']);
            $allowDelete = in_array($perm->name, ['deleteSections', 'deleteCourses']);
            $allowShow = str_starts_with($perm->name, 'show') && $perm->module !== 'Users';

            if ($allowCreate || $allowUpdate || $allowDelete || $allowShow) {
                RolePermission::create([
                    'role_id' => $profesorRole->id,
                    'permission_id' => $perm->id,
                ]);
            }
        }

        // Estudiante: solo puede ver todo, y crear usuario
        $studentPermissions = Permission::where(function ($q) {
            $q->where('name', 'showSections')
              ->orWhere('name', 'showCourses')
              ->orWhere('name', 'showRoles')
              ->orWhere(function ($sub) {
                  $sub->where('module', 'Users')
                      ->where('name', 'createUsers');
              });
        })->get();

        foreach ($studentPermissions as $perm) {
            RolePermission::create([
                'role_id' => $estudianteRole->id,
                'permission_id' => $perm->id,
            ]);
        }

        // ====== USUARIOS DE EJEMPLO ======
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@plataforma.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Profesor Ejemplo',
            'email' => 'profesor@plataforma.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'role_id' => $profesorRole->id,
        ]);

        User::create([
            'name' => 'Estudiante Ejemplo',
            'email' => 'estudiante@plataforma.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'role_id' => $estudianteRole->id,
        ]);
    }
}


