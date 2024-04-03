<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::updateOrCreate([
            'id'=>1
        ],
        [
            'name' => 'Super Admin',
            'user_type' => 'super_admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('Admin@123456789')
        ]);

        $role = Role::updateOrCreate(['id'=>1],['name' => 'Super Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $super_admin->assignRole([$role->id]);

        //Admin user and role
        $admin = User::updateOrCreate([
            'id'=>2
        ],
        [
            'name' => 'Admin',
            'user_type' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $admin_role = Role::updateOrCreate(['id'=>2],['name' => 'Admin']);

        $select_admin_permissions = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39];
        $admin_permissions = Permission::whereIn('id', $select_admin_permissions)->pluck('id','id')->all();

        $admin_role->syncPermissions($admin_permissions);

        $admin->assignRole([$admin_role->id]);

        //Vendor Role

        $vendor_role = Role::updateOrCreate(['id'=>3],['name' => 'Vendor']);
        $select_vendor_permissions = [1, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 38, 39];
        $vendor_permissions = Permission::whereIn('id', $select_vendor_permissions)->pluck('id','id')->all();

        $vendor_role->syncPermissions($vendor_permissions);

    }
}
