<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservations;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Reservations::factory()->count(15)->create();

        // Insert status records
        DB::table('statuses')->insert([
            ['status_id' => 1, 'code' => 'active'],
            ['status_id' => 2, 'code' => 'completed'],
            ['status_id' => 3, 'code' => 'canceled'],
            ['status_id' => 4, 'code' => 'deleted'],
        ]);
        DB::table('statuses_labels')->insert([
            ['status_id' => 1, 'name' => 'Active', 'language_id' => 1],
            ['status_id' => 1, 'name' => 'فعال', 'language_id' => 2],
            ['status_id' => 2, 'name' => 'Completed', 'language_id' => 1],
            ['status_id' => 2, 'name' => 'مكتمل', 'language_id' => 2],
            ['status_id' => 3, 'name' => 'Canceled', 'language_id' => 1],
            ['status_id' => 3, 'name' => 'ملغي', 'language_id' => 2],
            ['status_id' => 4, 'name' => 'Deleted', 'language_id' => 1],
            ['status_id' => 4, 'name' => 'محذوف', 'language_id' => 2],
        ]);

        // Insert type records
        DB::table('types')->insert([
            ['type_id' => 1, 'code' => 'graduates'],
            ['type_id' => 2, 'code' => 'couples'],
        ]);
        DB::table('types_labels')->insert([
            ['type_id' => 1, 'name' => 'Graduates', 'language_id' => 1],
            ['type_id' => 1, 'name' => 'خريجين', 'language_id' => 2],
            ['type_id' => 2, 'name' => 'Couples', 'language_id' => 1],
            ['type_id' => 2, 'name' => 'ازواج', 'language_id' => 2],
        ]);

        // Insert roles records
        DB::table('roles')->insert([
            ['role_id' => 1, 'code' => 'admin'],
            ['role_id' => 2, 'code' => 'photographer'],
            ['role_id' => 3, 'code' => 'social_media'],
            ['role_id' => 4, 'code' => 'receptionist'],
        ]);
        DB::table('roles_labels')->insert([
            ['role_id' => 1, 'name' => 'Admin', 'language_id' => 1],
            ['role_id' => 1, 'name' => 'مدير', 'language_id' => 2],
            ['role_id' => 2, 'name' => 'Photographer', 'language_id' => 1],
            ['role_id' => 2, 'name' => 'مصور', 'language_id' => 2],
            ['role_id' => 3, 'name' => 'Social Media', 'language_id' => 1],
            ['role_id' => 3, 'name' => 'سوشال ميديا', 'language_id' => 2],
            ['role_id' => 4, 'name' => 'Receptionist', 'language_id' => 1],
            ['role_id' => 4, 'name' => 'استقبال', 'language_id' => 2],
        ]);

        DB::table('users')->insert([
            ['name' => 'Admin', 'mobile' => '0795473804', 'email' => 'admin@avenue.com', 'role_id' => 1, 'is_active' => 1, 'password' => Hash::make('Demo@123')]
        ]);

        DB::table('languages')->insert([
            ['language_id' => 1, 'name' => 'English'],
            ['language_id' => 2, 'name' => 'Arabic'],
        ]);

        // Update reservations table
        DB::statement('UPDATE reservations SET status_id = 1');
        DB::statement('UPDATE reservations SET type_id = 1');
    }
}
