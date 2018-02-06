<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->assignRole('admin');

        $manager = new User;
        $manager->name = 'Manager';
        $manager->email = 'manager@gmail.com';
        $manager->password = bcrypt('secret');
        $manager->save();
        $manager->assignRole('manager');

        $user = new User;
        $user->name = 'John Doe';
        $user->email = 'johndoe@gmail.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->givePermissionTo('apply job');
    }
}
