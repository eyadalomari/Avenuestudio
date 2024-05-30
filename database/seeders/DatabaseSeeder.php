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

        // Insert status records
        DB::table('statuses')->insert([
            ['status_id' => 1, 'code' => 'active', 'sort' => 1],
            ['status_id' => 2, 'code' => 'completed', 'sort' => 2],
            ['status_id' => 3, 'code' => 'canceled', 'sort' => 3],
            ['status_id' => 4, 'code' => 'deleted', 'sort' => 4],
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
            ['type_id' => 1, 'code' => 'graduates', 'sort' => 1],
            ['type_id' => 2, 'code' => 'couples', 'sort' => 2],
            ['type_id' => 3, 'code' => 'products', 'sort' => 3],
            ['type_id' => 4, 'code' => 'fashion', 'sort' => 3],
        ]);
        DB::table('types_labels')->insert([
            ['type_id' => 1, 'name' => 'Graduates', 'language_id' => 1],
            ['type_id' => 1, 'name' => 'خريجين', 'language_id' => 2],
            ['type_id' => 2, 'name' => 'Couples', 'language_id' => 1],
            ['type_id' => 2, 'name' => 'ازواج', 'language_id' => 2],
            ['type_id' => 3, 'name' => 'Products', 'language_id' => 1],
            ['type_id' => 3, 'name' => 'منتجات', 'language_id' => 2],
            ['type_id' => 4, 'name' => 'Fashion', 'language_id' => 1],
            ['type_id' => 4, 'name' => 'أزياء', 'language_id' => 2],
        ]);

        // Insert roles records
        DB::table('roles')->insert([
            ['role_id' => 1, 'code' => 'admin', 'sort' => 1],
            ['role_id' => 2, 'code' => 'photographer', 'sort' => 2],
            ['role_id' => 3, 'code' => 'social_media', 'sort' => 3],
            ['role_id' => 4, 'code' => 'receptionist', 'sort' => 4],
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
            ['name' => 'Admin', 'mobile' => '0795473804', 'email' => 'admin@avenue.com', 'role_id' => 1, 'is_active' => 1, 'password' => Hash::make('Demo@123')],
            ['name' => 'Osaid', 'mobile' => '0798527381', 'email' => 'osaid@avenue.com', 'role_id' => 2, 'is_active' => 1, 'password' => Hash::make('Demo@123')],
            ['name' => 'Ashraf', 'mobile' => '0798527382', 'email' => 'ashraf@avenue.com', 'role_id' => 2, 'is_active' => 1, 'password' => Hash::make('Demo@123')],
        ]);

        DB::table('languages')->insert([
            ['language_id' => 1, 'name' => 'English'],
            ['language_id' => 2, 'name' => 'Arabic'],
        ]);

        Reservations::factory()->count(1000)->create();
    }
}
