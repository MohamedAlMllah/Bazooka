<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('abcd@1234'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('987654321'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('123456789'),
            'role_id' => 4,
        ]);
        User::create([
            'name' => 'employee2',
            'email' => 'employee2@gmail.com',
            'password' => bcrypt('123456789'),
            'role_id' => 5,
        ]);
        User::create([
            'name' => 'employee3',
            'email' => 'employee3@gmail.com',
            'password' => bcrypt('123456789'),
            'role_id' => 5,
        ]);
    }
}
