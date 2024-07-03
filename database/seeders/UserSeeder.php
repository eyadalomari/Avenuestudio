<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'mobile' => '079999999', 'email' => 'admin@avenue.com', 'role_id' => 1, 'is_active' => 1, 'password' => bcrypt('Demo@123')],
            ['name' => 'Eyad', 'mobile' => '0795473804', 'email' => 'eyad@avenue.com', 'role_id' => 1, 'is_active' => 1, 'password' => bcrypt('Demo@123')],
            ['name' => 'Osaid', 'mobile' => '0798527381', 'email' => 'osaid@avenue.com', 'role_id' => 2, 'is_active' => 1, 'password' => bcrypt('Demo@123')],
            ['name' => 'Ashraf', 'mobile' => '0798527382', 'email' => 'ashraf@avenue.com', 'role_id' => 2, 'is_active' => 1, 'password' => bcrypt('Demo@123')],
        ];

        User::insert($users);
    }
}
