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
        $admin = new User();
        $admin->name = 'MD. RASHEDUL ISLAM';
        $admin->email = 'rashed@gmail.com';
        $admin->password = bcrypt('1234');
        $admin->role = 'admin';
        $admin->save();
    }
}
