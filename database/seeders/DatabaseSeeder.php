<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Status;
use App\Models\StatusI18n;
use App\Models\Type;
use App\Models\TypeI18n;
use App\Models\Language;

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
        Status::insert([
            ['id' => 1, 'code' => 'active', 'sort' => 1],
            ['id' => 2, 'code' => 'completed', 'sort' => 2],
            ['id' => 3, 'code' => 'canceled', 'sort' => 3],
            ['id' => 4, 'code' => 'deleted', 'sort' => 4],

        ]);
        StatusI18n::insert([
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
        Type::insert([
            ['id' => 1, 'code' => 'graduates', 'sort' => 1],
            ['id' => 2, 'code' => 'couples', 'sort' => 2],
            ['id' => 3, 'code' => 'products', 'sort' => 3],
            ['id' => 4, 'code' => 'fashion', 'sort' => 3],
        ]);
        TypeI18n::insert([
            ['type_id' => 1, 'name' => 'Graduates', 'language_id' => 1],
            ['type_id' => 1, 'name' => 'خريجين', 'language_id' => 2],
            ['type_id' => 2, 'name' => 'Couples', 'language_id' => 1],
            ['type_id' => 2, 'name' => 'ازواج', 'language_id' => 2],
            ['type_id' => 3, 'name' => 'Products', 'language_id' => 1],
            ['type_id' => 3, 'name' => 'منتجات', 'language_id' => 2],
            ['type_id' => 4, 'name' => 'Fashion', 'language_id' => 1],
            ['type_id' => 4, 'name' => 'أزياء', 'language_id' => 2],
        ]);

        User::insert([
            ['name' => 'Admin', 'mobile' => '079999999', 'email' => 'admin@avenue.com', 'is_active' => 1, 'password' => bcrypt('Demo@123')],
            ['name' => 'Eyad', 'mobile' => '0795473804', 'email' => 'eyad@avenue.com', 'is_active' => 1, 'password' => bcrypt('Demo@123')],
            ['name' => 'Osaid', 'mobile' => '0798527381', 'email' => 'osaid@avenue.com', 'is_active' => 1, 'password' => bcrypt('Demo@123')],
            ['name' => 'Ashraf', 'mobile' => '0798527382', 'email' => 'ashraf@avenue.com', 'is_active' => 1, 'password' => bcrypt('Demo@123')],
        ]);

        Language::insert([
            ['id' => 1, 'name' => 'English', 'status' => 1, 'is_rtl' => 0],
            ['id' => 2, 'name' => 'Arabic', 'status' => 1, 'is_rtl' => 1],
        ]);

        Reservation::factory()->count(1000)->create();
    }
}
