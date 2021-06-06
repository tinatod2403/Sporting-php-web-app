<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['type' => 'Bilijar'],
            ['type' => 'Fudbal'],
            ['type' => 'Jahanje'],
            ['type' => 'Kosarka'],
            ['type' => 'Kuglanje'],
            ['type' => 'Odbojka'],
            ['type' => 'Tenis'],
        ]);
    }
}
