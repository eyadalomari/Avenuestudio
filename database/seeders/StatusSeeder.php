<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusI18n;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

    }
}
