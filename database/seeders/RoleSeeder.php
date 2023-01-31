<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $role2 = Role::create(['name' => 'Admin']);
        $role1 = Role::create(['name' => 'SuperAdmin']);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'capitulos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);

        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'indexadmin'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mostrarponentes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mostrarparticipantes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'matricularnew'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'newmatri'])->syncRoles([$role1, $role2]);
    }
}
