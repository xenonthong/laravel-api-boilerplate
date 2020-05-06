<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function($u) {
            if ($u->id === 1) {
                $u->update([
                    'username' => 'superadmin',
                    'email' => 'superadmin@mailinator.com'
                ]);
                $u->assignRole(Role::findByName('SUPERADMIN', 'api'));
            } else {
                $u->assignRole(Role::findByName('STAFF', 'api'));
            }
        });
    }
}
