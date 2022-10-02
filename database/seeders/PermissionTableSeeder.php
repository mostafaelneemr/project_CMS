<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'home-page',
            'about-page',
            'service-page',
            'blog-page',
            'contact-page',
            'permessions',
            'role-permission',
            'users',
            'settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
