<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Language::insert([
            ['id' => 1, 'name' => 'English', 'status' => 1, 'is_rtl' => 0],
            ['id' => 2, 'name' => 'Arabic', 'status' => 1, 'is_rtl' => 1],
        ]);

        $this->call([
            StatusSeeder::class,
            TypeSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            ReservationSeeder::class,
        ]);


    }
}
