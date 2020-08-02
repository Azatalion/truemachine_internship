<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class CreateRoles extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {

        // create permissions
        Permission::create(['name' => 'show profile']);
        Permission::create(['name' => 'show admin panel']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('show profile');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('show profile', 'create products', 'edit products', 'delete products', 'show admin panel');
    }
}