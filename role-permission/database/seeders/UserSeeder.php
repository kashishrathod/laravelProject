<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'role_id' => '1',
                'name' => 'Superadmin',
                'email' => 'kashish123@gmail.com',
                'password' => Hash::make('kashish@123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
