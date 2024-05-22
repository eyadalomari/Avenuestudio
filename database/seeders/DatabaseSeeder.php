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

        Reservations::factory()->count(35)->create();

        // DB::table('statuses')->insert([
        //     ['code' => 'active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['code' => 'completed', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['code' => 'canceled', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['code' => 'deleted', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        // Insert type records
        // DB::table('types')->insert([
        //     ['code' => 'graduates', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['code' => 'couples', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        // DB::table('roles')->insert([
        //     ['role_id' => 1, 'code' => 'admin'],
        //     ['role_id' => 2, 'code' => 'photographer'],
        //     ['role_id' => 2, 'code' => 'social_media'],
        //     ['role_id' => 2, 'code' => 'receptionist'],
        // ]);

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
