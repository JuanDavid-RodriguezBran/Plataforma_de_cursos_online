<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // Sections
            ['name' => 'showSections', 'description' => 'Ver Secciones', 'module' => 'Sections'],
            ['name' => 'createSections', 'description' => 'Crear Secciones', 'module' => 'Sections'],
            ['name' => 'updateSections', 'description' => 'Editar Secciones', 'module' => 'Sections'],
            ['name' => 'deleteSections', 'description' => 'Eliminar Secciones', 'module' => 'Sections'],

            // Courses
            ['name' => 'showCourses', 'description' => 'Ver Cursos', 'module' => 'Courses'],
            ['name' => 'createCourses', 'description' => 'Crear Cursos', 'module' => 'Courses'],
            ['name' => 'updateCourses', 'description' => 'Editar Cursos', 'module' => 'Courses'],
            ['name' => 'deleteCourses', 'description' => 'Eliminar Cursos', 'module' => 'Courses'],

            // Users
            ['name' => 'showUsers', 'description' => 'Ver Usuarios', 'module' => 'Users'],
            ['name' => 'createUsers', 'description' => 'Crear Usuarios', 'module' => 'Users'],
            ['name' => 'updateUsers', 'description' => 'Editar Usuarios', 'module' => 'Users'],
            ['name' => 'deleteUsers', 'description' => 'Eliminar Usuarios', 'module' => 'Users'],

            // Roles
            ['name' => 'showRoles', 'description' => 'Ver Roles', 'module' => 'Roles'],
            ['name' => 'createRoles', 'description' => 'Crear Roles', 'module' => 'Roles'],
            ['name' => 'updateRoles', 'description' => 'Editar Roles', 'module' => 'Roles'],
            ['name' => 'deleteRoles', 'description' => 'Eliminar Roles', 'module' => 'Roles'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'module' => $permission['module'],
            ], $permission);
        }
    }
}
