<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Super Admin role; see AuthServiceProvider
        Role::create(['name' => 'Super Admin']);

        $permissions = [
            'user_show',
            'user_edit',
            'user_activate',
            'user_delete',
            'ship_verify',
            'ship_delete',
            'ship_register',
            'ship_edit',
            'profile_edit',
        ];

        collect($permissions)->each(fn ($permission) => Permission::create(['name' => $permission]));

        $this->createAdminRole();

        $this->createUserRole();
    }

    protected function createAdminRole()
    {
        $role = Role::create(['name' => 'Admin']);

        $permissions = [
            'user_edit',
            'user_activate',
            'user_delete',
            'ship_verify',
            'ship_delete',
            'ship_edit',
        ];

        collect($permissions)->each(fn ($permission) => $role->givePermissionTo($permission));
    }

    protected function createUserRole()
    {
        $role = Role::create(['name' => 'User']);

        $permissions = [
            'ship_register',
            'ship_edit',
            'profile_edit',
        ];

        collect($permissions)->each(fn ($permission) => $role->givePermissionTo($permission));
    }
}
