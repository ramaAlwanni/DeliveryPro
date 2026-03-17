<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $productManager = Role::create(['name' => 'Product Manager']);
        $user = Role::create(['name' => 'User']);

        // $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'api']);
        // $admin = Role::create(['name' => 'Admin' , 'guard_name' => 'api']);
        // $productManager = Role::create(['name' => 'Product Manager' , 'guard_name' => 'api']);
        // $user = Role::create(['name' => 'User' , 'guard_name' => 'api']);

        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
           // 'create-user',
           // 'edit-user',
           // 'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'view-product',
            'search-product',
            'view-store',

        ]);

        $productManager->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product',
            'view-product',
            'search-product',
            'view-store',

        ]);

        $user->givePermissionTo([
            // 'view-product',
            //'view-store',
            'search-product',
        ]);
    }
}
