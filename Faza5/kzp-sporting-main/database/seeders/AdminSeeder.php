<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => 'secret',
            'name' => 'Admin',
            'surname' => 'Admin',
        ]);

        Admin::create(['user_id' => $user->id]);
    }
}
