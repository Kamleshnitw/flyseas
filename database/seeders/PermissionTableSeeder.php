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
            'dashboard',

            'bakery-category-index', 'bakery-category-create', 'bakery-category-edit', 'bakery-category-delete',

            'bakery-attribute-index', 'bakery-attribute-create', 'bakery-attribute-edit', 'bakery-attribute-delete',

            'bakery-product-index', 'bakery-product-create', 'bakery-product-edit', 'bakery-product-delete',

            'city-index', 'city-create', 'city-edit', 'city-delete',

            'vendor-product-index', 'vendor-product-create', 'vendor-product-edit', 'vendor-product-delete',

            'vendor-slider-index', 'vendor-slider-create', 'vendor-slider-delete',

            'vendor-banner-index', 'vendor-banner-create', 'vendor-banner-delete',
            
            'user-index', 'user-create', 'user-show', 'user-edit', 'user-delete',

            'role-index', 'role-create', 'role-show', 'role-edit', 'role-delete',

            'retailers-index',

            'orders-index'
        ];

        $parent_id = [
            1,

            2, 2, 2, 2,

            3, 3, 3, 3,

            4, 4, 4, 4,

            5, 5, 5, 5,

            6, 6, 6, 6,

            7, 7, 7,
            
            8, 8, 8,

            9, 9, 9, 9, 9,

            10, 10, 10, 10, 10,

            11,

            12,
        ];

        $parent_name = [
            'Dashboard',

            'Bakery Category', 'Bakery Category', 'Bakery Category', 'Bakery Category',

            'Bakery Attribute', 'Bakery Attribute', 'Bakery Attribute', 'Bakery Attribute',

            'Bakery Product', 'Bakery Product', 'Bakery Product', 'Bakery Product',

            'City', 'City', 'City', 'City',

            'Vendor Product', 'Vendor Product', 'Vendor Product', 'Vendor Product',

            'Vendor Slider', 'Vendor Slider', 'Vendor Slider',

            'Vendor Banner', 'Vendor Banner', 'Vendor Banner',

            'User', 'User', 'User', 'User', 'User',

            'Role', 'Role', 'Role', 'Role', 'Role',

            'Retailers',

            'Orders',
        ];

        foreach ($permissions as $key=>$permission) {
            $per=Permission::where('name',$permission)->first();
            if($per)
            {
                $permission_data = Permission::find($per->id);
            }
            else
            {
                $permission_data = new Permission;
            }
            $permission_data->name = $permission;
            $permission_data->parent_id = $parent_id[$key];
            $permission_data->parent_name = $parent_name[$key];
            $permission_data->guard_name = 'web';
            $permission_data->save();
        }
    }
}
