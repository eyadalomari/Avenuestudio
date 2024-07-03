<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleI18n;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

    }
}
