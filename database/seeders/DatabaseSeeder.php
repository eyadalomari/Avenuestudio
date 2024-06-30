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
use App\Models\Role;
use App\Models\RoleI18n;
use App\Models\Language;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

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

        // Insert roles records
        Role::insert([
            ['id' => 1, 'code' => 'admin', 'sort' => 1],
            ['id' => 2, 'code' => 'photographer', 'sort' => 2],
            ['id' => 3, 'code' => 'social_media', 'sort' => 3],
            ['id' => 4, 'code' => 'receptionist', 'sort' => 4],
        ]);
        RoleI18n::insert([
            ['role_id' => 1, 'name' => 'Admin', 'language_id' => 1],
            ['role_id' => 1, 'name' => 'مدير', 'language_id' => 2],
            ['role_id' => 2, 'name' => 'Photographer', 'language_id' => 1],
            ['role_id' => 2, 'name' => 'مصور', 'language_id' => 2],
            ['role_id' => 3, 'name' => 'Social Media', 'language_id' => 1],
            ['role_id' => 3, 'name' => 'سوشال ميديا', 'language_id' => 2],
            ['role_id' => 4, 'name' => 'Receptionist', 'language_id' => 1],
            ['role_id' => 4, 'name' => 'استقبال', 'language_id' => 2],
        ]);

        User::insert([
            ['name' => 'Admin', 'mobile' => '0799999990', 'email' => 'admin@avenue.com', 'is_active' => true, 'is_admin' => true, 'password' => bcrypt('Demo@123')],
            ['name' => 'Eyad', 'mobile' => '0795473804', 'email' => 'eyad@avenue.com', 'is_active' => true, 'is_admin' => false, 'password' => bcrypt('Demo@123')],
            ['name' => 'Osaid', 'mobile' => '0798527381', 'email' => 'osaid@avenue.com', 'is_active' => true, 'is_admin' => false, 'password' => bcrypt('Demo@123')],
            ['name' => 'Ashraf', 'mobile' => '0798527382', 'email' => 'ashraf@avenue.com', 'is_active' => true, 'is_admin' => false, 'password' => bcrypt('Demo@123')],
        ]);

        DB::table('user_roles')->insert(
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 1, 'role_id' => 2],
            ['user_id' => 2, 'role_id' => 1],
            ['user_id' => 2, 'role_id' => 2],
        );


        Language::insert([
            ['id' => 1, 'name' => 'English', 'status' => 1, 'is_rtl' => 0],
            ['id' => 2, 'name' => 'Arabic', 'status' => 1, 'is_rtl' => 1],
        ]);

        Permission::insert([
            ['name' => 'Reservations-index'],
            ['name' => 'Reservations-create'],
            ['name' => 'Reservations-edit'],
            ['name' => 'Reservations-show'],
            ['name' => 'Reservations-store'],
            ['name' => 'Roles-index'],
            ['name' => 'Roles-create'],
            ['name' => 'Roles-edit'],
            ['name' => 'Roles-show'],
            ['name' => 'Roles-store'],
            ['name' => 'Staffs-index'],
            ['name' => 'Staffs-create'],
            ['name' => 'Staffs-edit'],
            ['name' => 'Staffs-show'],
            ['name' => 'Staffs-store'],
            ['name' => 'Status-index'],
            ['name' => 'Status-create'],
            ['name' => 'Status-edit'],
            ['name' => 'Status-show'],
            ['name' => 'Status-store'],
            ['name' => 'Types-index'],
            ['name' => 'Types-create'],
            ['name' => 'Types-edit'],
            ['name' => 'Types-show'],
            ['name' => 'Types-store'],
        ]);

        $role = Role::find(1);
        $permissions = Permission::all();
        $role->permissions()->attach($permissions);

        Reservation::factory()->count(50)->create();
    }
}
