<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            ['name' => 'view_courses', 'description' => 'Ver cursos'],
            ['name' => 'create_courses', 'description' => 'Crear cursos'],
            ['name' => 'edit_courses', 'description' => 'Editar cursos'],
            ['name' => 'delete_courses', 'description' => 'Eliminar cursos'],
            ['name' => 'view_users', 'description' => 'Ver usuarios'],
            ['name' => 'create_users', 'description' => 'Crear usuarios'],
            ['name' => 'edit_users', 'description' => 'Editar usuarios'],
            ['name' => 'delete_users', 'description' => 'Eliminar usuarios'],
            ['name' => 'manage_roles', 'description' => 'Gestionar roles'],
            ['name' => 'view_sections', 'description' => 'Ver secciones'],
            ['name' => 'create_sections', 'description' => 'Crear secciones'],
            ['name' => 'edit_sections', 'description' => 'Editar secciones'],
            ['name' => 'delete_sections', 'description' => 'Eliminar secciones'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'Profesor']);
        $studentRole = Role::firstOrCreate(['name' => 'Estudiante']);

        // Asignar permisos a Admin (todos los permisos)
        $adminRole->permissions()->sync(Permission::pluck('id'));

        // Asignar permisos a Profesor
        $teacherPermissions = Permission::whereIn('name', [
            'view_courses',
            'create_courses',
            'edit_courses',
            'view_sections',
            'create_sections',
            'edit_sections',
            'view_users',
        ])->pluck('id');
        $teacherRole->permissions()->sync($teacherPermissions);

        // Asignar permisos a Estudiante
        $studentPermissions = Permission::whereIn('name', [
            'view_courses',
            'view_sections',
        ])->pluck('id');
        $studentRole->permissions()->sync($studentPermissions);
    }
}
