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
            // role permission
            'permessions',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            // user permission
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            // slider section
            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',
            // help section
            'home-list',
            'home-create',
            'home-edit',
            'home-delete',
            // page links
            'page-list',
            'page-create',
            'page-edit',
            'page-delete',
            // service 
            'service-list',
            'service-create',
            'service-edit',
            'service-delete',
            //about
            'about-list',
            'about-create',
            'about-edit',
            'about-delete',
            //about
            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',
            // setting
            'setting',
            'role-permission',
            'users',
            'settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
