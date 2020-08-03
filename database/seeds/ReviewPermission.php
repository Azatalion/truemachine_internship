<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class ReviewPermission extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'add review']);
        $role = Role::where('name', 'user')->first();
        $role->givePermissionTo('show profile', 'add review');
    }
}