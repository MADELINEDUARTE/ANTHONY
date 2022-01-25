<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'Marketing']);

        Permission::create(['name'=>'admin.home'])->syncRoles([$role1,$role2]);
        
        Permission::create(['name'=>'admin.category.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.category.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.category.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.category.delete'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'admin.product.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.product.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.product.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.product.delete'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'admin.slider.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.slider.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.slider.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.slider.delete'])->syncRoles([$role1,$role2]);
    }
}
