<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class AddRoleToUser extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'user')->first();
        $user = User::where('name', 'Test Man')->first();
        $user->assignRole($role);
    }
}