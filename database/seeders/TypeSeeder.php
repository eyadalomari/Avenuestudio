<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\TypeI18n;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

    }
}
