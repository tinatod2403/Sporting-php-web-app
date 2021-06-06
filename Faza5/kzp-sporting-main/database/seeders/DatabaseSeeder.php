<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(ModeratorSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ComplexSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
