<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'view_courses'],
            ['name' => 'create_courses'],
            ['name' => 'edit_courses'],
            ['name' => 'delete_courses'],
            ['name' => 'view_users'],
            ['name' => 'edit_users'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate($perm);
        }
    }
}
