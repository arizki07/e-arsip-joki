<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('admin'),
            ],

            [
                'name' => 'Bp',
                'email' => 'bp@gmail.com',
                'role' => 'bp',
                'password' => bcrypt('bp'),
            ],

            [
                'name' => 'Bpp',
                'email' => 'bpp@gmail.com',
                'role' => 'bpp',
                'password' => bcrypt('bpp'),
            ],

            [
                'name' => 'Kpa',
                'email' => 'kpa@gmail.com',
                'role' => 'kpa',
                'password' => bcrypt('kpa'),
            ],

            [
                'name' => 'Pa',
                'email' => 'pa@gmail.com',
                'role' => 'pa',
                'password' => bcrypt('pa'),
            ],

            [
                'name' => 'Ppk',
                'email' => 'ppk@gmail.com',
                'role' => 'ppk',
                'password' => bcrypt('ppk'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
