<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
        ]);

        $admin->assignRole('admin');

        $admin = User::create([
            'name' => 'GA',
            'username' => 'GA',
            'email' => 'GA@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
        ]);

        $user->assignRole('user');
    }
}