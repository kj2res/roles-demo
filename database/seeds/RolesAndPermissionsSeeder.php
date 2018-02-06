<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'create job']);
        Permission::create(['name' => 'apply job']);
        Permission::create(['name' => 'approve job']);
        Permission::create(['name' => 'revoke user rights']);
        Permission::create(['name' => 'revoke manager rights']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'manager']);
        $role->givePermissionTo('create job');
        $role->givePermissionTo('revoke user rights');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('approve job');
        $role->givePermissionTo('revoke manager rights');
    }
}
