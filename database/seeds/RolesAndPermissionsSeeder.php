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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'add users']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'SUPERADMIN']);
        $role->givePermissionTo(Permission::all());

        // or may be done by chaining
        Role::create(['name' => 'STAFF']);
        Role::create(['name' => 'GUEST']);
    }
}
