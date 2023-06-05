<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = 
        [
            [
                'name' => 'Manager User',
                'NIK' => '12345',
                // 'username' => 'ManagerUser',
                'email' => 'manager@gmail.com',
                // 'password' => bcrypt('pak rudi'),
                'type' => 2,
                // 'referral_token' => 0
            ],

            [
                'name' => 'Admin User',
                'NIK' => '12355',
                // 'username' => 'AdminUser',
                'email' => 'admin@gmail.com',
                // 'password' => bcrypt('123456'),
                'type' => 1,
                // 'referral_token' => 1
            ],

            [
                'name' => 'User',
                'NIK' => '12145',
                // 'username' => 'User',
                'email' => 'user@gmail.com',
                // 'password' => bcrypt('123456'),
                'type' => 0,
                // 'referral_token' => 2
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
