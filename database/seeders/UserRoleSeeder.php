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
        // ===============================
        //        ROLES
        // ===============================
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $profesorRole = Role::firstOrCreate(['name' => 'Profesor']);
        $estudianteRole = Role::firstOrCreate(['name' => 'Estudiante']);

        // ===============================
        //       PERMISOS
        // ===============================

        // ADMIN: todos los permisos
        foreach (Permission::all() as $perm) {
            RolePermission::firstOrCreate([
                'role_id' => $adminRole->id,
                'permission_id' => $perm->id,
            ]);
        }

        // ===============================
        //          PROFESOR
        // ===============================

        // Profesor: puede gestionar secciones/cursos y ver enrollments
        // ❗ Quitamos cualquier permiso relacionado con Roles
        $profesorPermissions = Permission::whereNotIn('module', ['Users', 'Roles'])->get();

        foreach ($profesorPermissions as $perm) {

            $allowed = false;

            // Permisos de ver (menos usuarios y menos roles)
            if (str_starts_with($perm->name, 'show') && !in_array($perm->module, ['Users', 'Roles'])) {
                $allowed = true;
            }

            // Crear / editar / eliminar de Sections y Courses
            if (in_array($perm->name, [
                'createSections', 'updateSections', 'deleteSections',
                'createCourses', 'updateCourses', 'deleteCourses'
            ])) {
                $allowed = true;
            }

            // Enrollments: show y update
            if (in_array($perm->name, ['showEnrollments', 'updateEnrollments'])) {
                $allowed = true;
            }

            if ($allowed) {
                RolePermission::firstOrCreate([
                    'role_id' => $profesorRole->id,
                    'permission_id' => $perm->id,
                ]);
            }
        }

        // ===============================
        //          ESTUDIANTE
        // ===============================

        $studentAllowed = Permission::whereIn('name', [
            'showSections',
            'showCourses',
            'createUsers',
            'showEnrollments',
            'createEnrollments',
        ])->get();

        foreach ($studentAllowed as $perm) {
            RolePermission::firstOrCreate([
                'role_id' => $estudianteRole->id,
                'permission_id' => $perm->id,
            ]);
        }

        // ===============================
        //        USUARIOS DEMO
        // ===============================

        User::firstOrCreate(
            ['email' => 'admin@plataforma.com'],
            [
                'name' => 'Admin Principal',
                'email_verified_at' => now(),
                'password' => Hash::make('1234'),
                'role_id' => $adminRole->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'profesor@plataforma.com'],
            [
                'name' => 'Profesor Ejemplo',
                'email_verified_at' => now(),
                'password' => Hash::make('1234'),
                'role_id' => $profesorRole->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'estudiante@plataforma.com'],
            [
                'name' => 'Estudiante Ejemplo',
                'email_verified_at' => now(),
                'password' => Hash::make('1234'),
                'role_id' => $estudianteRole->id,
            ]
        );
    }
}

