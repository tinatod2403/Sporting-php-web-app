<?php

namespace Database\Seeders;

use App\Models\Complex;
use App\Models\Moderator;
use App\Models\User;
use Illuminate\Database\Seeder;

class ModeratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'moderator',
            'password' => 'secret',
            'name' => 'Moderator',
            'surname' => 'Moderator',
        ]);

        Moderator::create([
            'contact' => '21122021',
            'email' => 'moderator@kzp.sporting',
            'date_of_birth' => '21.12.2021.',
            'user_id' => $user->id,
            'date_register' => now(),
        ]);
    }
}
