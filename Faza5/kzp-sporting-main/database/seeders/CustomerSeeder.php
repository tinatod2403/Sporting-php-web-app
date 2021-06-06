<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'customer',
            'password' => 'secret',
            'name' => 'Customer',
            'surname' => 'Customer',
        ]);

        Customer::create([
            'contact' => '21122021',
            'email' => 'customer@kzp.sporting',
            'date_of_birth' => '21.12.2021.',
            'user_id' => $user->id,
            'date_register' => now(),
            'is_active' => true,
        ]);
    }
}
